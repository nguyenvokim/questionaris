<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (\Auth::id()) {
            return redirect(route('frontend.user.dashboard'));
        } else {
            return redirect(route('frontend.auth.login'));
        }
    }
}
