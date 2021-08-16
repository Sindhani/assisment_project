<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $respnse = $next($request);

        if(auth()->check() && auth()->user()->is_admin === 2){
            return redirect()->route('superadmin');
        }
        if(auth()->check() && auth()->user()->is_admin != 2){
            $subdomain = auth()->user()->sub_domain;
            return redirect("http://".$subdomain.".".config('app.short_url').'/home');
        }
        return $respnse;

    }
}
