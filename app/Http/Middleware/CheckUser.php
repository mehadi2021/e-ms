<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->has('reg') && $request->has('email')){
            $user= User::where('email', $request->get('email'))->first();
            
            if(isset($user) && $user!=null){
                return redirect()->back()->with('error', 'email already taken!');
            }
        }
        return $next($request);
    }
}
