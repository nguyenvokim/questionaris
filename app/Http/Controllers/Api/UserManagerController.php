<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Api\InviteUserRequest;

class UserManagerController extends Controller {
    public function inviteUser(InviteUserRequest $request)
    {
        return response()->json(['Yser' => 1]);
    }
}
