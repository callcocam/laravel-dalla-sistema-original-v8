<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserStatusPublished
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

        if(auth()->check() && auth()->user()->status == 'published')
             return $next($request);

             return redirect()->route('home-aguardando-aprovacao');
    }
}
