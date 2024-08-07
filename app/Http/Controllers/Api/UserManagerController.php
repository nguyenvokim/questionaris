<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Api\InviteUserRequest;
use App\Models\UserInvite;
use App\Notifications\InviteUserEmail;

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
}
