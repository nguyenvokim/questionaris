<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Api\InviteUserRequest;
use App\Models\UserInvite;
use App\Models\UserOrg;
use App\Models\UserOrgRole;
use App\Notifications\InviteUserEmail;
use Illuminate\Http\Request;

class UserManagerController extends Controller {
    public function inviteUser(InviteUserRequest $request)
    {
        $key = \Crypt::encryptString(random_int(0, 999999) . '_' . now());
        $userInvite = UserInvite::create([
            'inviter_id' => \Auth::id(),
            'first_name' => $request->get('firstName'),
            'last_name' => $request->get('lastName'),
            'email' => $request->get('email'),
            'invite_key' => $key,
            'role' => $request->get('role'),
        ]);

        \Notification::route('mail', $userInvite->email)
            ->notifyNow(new InviteUserEmail($userInvite));

        return response()->json(['success' => 1]);
    }

    public function invites()
    {
        $userInvites = UserInvite::whereInviterId(\Auth::id())->get();

        return response()->json($userInvites);
    }

    public function users()
    {
        $userOrg = \Auth::user()->getUserOrg();
        $userOrgRoles = UserOrgRole::with(['user', 'org'])
            ->where([
                ['org_id', '=', $userOrg->id],
                ['user_id', '!=', \Auth::id()]
            ])->get();

        return response()->json($userOrgRoles);
    }

    public function resendInvite($id)
    {
        $userInvite = UserInvite::where([
            ['id', '=', $id],
            ['inviter_id', '=', \Auth::id()]
        ])->first();

        if ($userInvite) {
            \Notification::route('mail', $userInvite->email)
                ->notifyNow(new InviteUserEmail($userInvite));
        }


        return response()->json($userInvite);
    }

    public function updateUser(int $id, Request $request) {
        var_dump($id);
        $status = $request->get('status', UserOrgRole::STATUS_ACTIVE);
        $role = $request->get('role', UserOrgRole::ROLE_MEMBER);

        if (!\Auth::user()->isOrgMaster()) {
            return response()->json(['success' => false]);
        }


        $updateOrgRole = UserOrgRole::whereUserId($id)->first();
        if ($updateOrgRole) {
            $updateOrgRole->role = $role;
            $updateOrgRole->status = $status;
            $updateOrgRole->save();
        }

        return response()->json(['success' => true]);
    }
}
