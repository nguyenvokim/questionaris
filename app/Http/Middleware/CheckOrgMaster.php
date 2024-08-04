<?php

namespace App\Http\Middleware;

use Closure;

class CheckOrgMaster
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        if (!$user->isOrgMaster()) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 1])->status(403);
            } else {
                return redirect()->route('frontend.user.dashboard');
            }
        }

        return $next($request);
    }
}
