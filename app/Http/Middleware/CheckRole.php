<?php

namespace App\Http\Middleware;

use Closure;
use APP\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     */
    public function handle(Request $request, Closure $next, $access): Response
    {
        $access = explode('|', $access);
        $user = User::find(auth()->user()->id);
        $roleUser = [];
        foreach ($user->roles as $item) {
            array_push($roleUser, $item->kode_role);
        }

        $allow = array_intersect($access, $roleUser) ? true : false;

        if (!$allow) {
            return abort(403);
        }

        return $next($request);
    }
}
