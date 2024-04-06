<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request,Closure $next, string ...$guards): Response
    {
        DD(request());
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user =auth()->user();
                session()->flash('user', [
                    'name' => $user->name,
                    'email' => $user->email,
                    'id' => $user->id
                ]);
                // $data = compact('name', 'email', 'id');
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}