<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Events\Frontend\Auth\UserRegistered;
use App\Models\Auth\User;
use App\Models\Battery;
use App\Models\UserInvite;
use App\Models\UserOrg;
use App\Models\UserOrgRole;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Repositories\Frontend\Auth\UserRepository;
use Illuminate\Http\Request;

/**
 * Class RegisterController.
 */
class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * RegisterController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route(home_route());
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm(Request $request)
    {
        abort_unless(config('access.registration'), 404);

        $code = $request->get('code');
        $data = [
            'preFirstName' => '',
            'preLastName' => '',
            'preEmail' => '',
            'code' => ''
        ];
        if ($code) {
            $userInvite = UserInvite::whereInviteKey($code)->first();
            if ($userInvite) {
                $data = [
                    'preFirstName' => $userInvite->first_name,
                    'preLastName' => $userInvite->last_name,
                    'preEmail' => $userInvite->email,
                    'code' => $userInvite->invite_key
                ];
            }
        }

        return view('frontend.auth.register', $data);
    }

    /**
     * @param RegisterRequest $request
     *
     * @throws \Throwable
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(RegisterRequest $request)
    {
        abort_unless(config('access.registration'), 404);

        $params = $request->only('first_name', 'last_name', 'email', 'password', 'country', 'profession');
        $code = $request->get('code');
        $userInvite = null;
        if ($code) {
            $userInvite = UserInvite::whereInviteKey($code)->first();
        }

        if ($userInvite) {
            $inviter = User::find($userInvite->inviter_id);
            $params['first_name'] = $userInvite->first_name;
            $params['last_name'] = $userInvite->last_name;
            $params['email'] = $userInvite->email;
            $user = $this->userRepository->create($params);

            $inviteOrg = $inviter->getUserOrg();
            UserOrgRole::create([
                'user_id' => $user->id,
                'org_id' => $inviteOrg->id,
                'role' => $userInvite->role,
            ]);

            $userInvite->status = UserInvite::STATUS_APPROVED;
            $userInvite->save();
        } else {
            $user = $this->userRepository->create($params);
            $userOrg = UserOrg::create([
                'user_id' => $user->id,
                'name' => $user->first_name . ' ' . $user->last_name
            ]);
            UserOrgRole::create([
                'user_id' => $userOrg->user_id,
                'org_id' => $userOrg->id,
                'role' => \App\Models\UserOrgRole::ROLE_MASTER
            ]);
            Battery::createDefaultBatteryForUser($user);
        }
        // If the user must confirm their email or their account requires approval,
        // create the account but don't log them in.
        if (config('access.users.confirm_email') || config('access.users.requires_approval')) {
            event(new UserRegistered($user));

            return redirect($this->redirectPath())->withFlashSuccess(
                config('access.users.requires_approval') ?
                    __('exceptions.frontend.auth.confirmation.created_pending') :
                    __('exceptions.frontend.auth.confirmation.created_confirm')
            );
        }

        auth()->login($user);

        event(new UserRegistered($user));

        return redirect($this->redirectPath());
    }
}
