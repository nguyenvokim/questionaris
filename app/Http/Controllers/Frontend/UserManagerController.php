<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserOrg;
use App\Models\UserOrgRole;

class UserManagerController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $org = UserOrg::whereUserId($user->id)->first();
        if ($user->getOrgRole($org->id) != UserOrgRole::ROLE_MASTER) {
            return redirect()->route('frontend.user.dashboard');
        }

        return view('frontend.vueroute');
    }
}
