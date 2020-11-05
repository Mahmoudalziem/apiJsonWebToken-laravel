<?php

namespace App\Http\Middleware;

use Closure;

class lang
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

        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';

        app()->setLocale($lang);

        return $next($request);
    }
}
