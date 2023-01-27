<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Language
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
        //logger('Lang session: '.Session()->get('applocale'));
        if (Session()->has('applocale') and array_key_exists(Session()->get('applocale'), config('languages'))) {
            App::setLocale(Session()->get('applocale'));
            Carbon::setLocale(Session()->get('applocale'));
        } else {
            $browserLanguage = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2); //read browser language
            //logger('Lang received: '.$browserLanguage);
            if (array_key_exists($browserLanguage, config('languages'))) {
                Session::put('applocale', $browserLanguage);
            } else {
                Session::put('applocale', 'en');
            }

            App::setLocale(Session()->get('applocale'));
            Carbon::setLocale(Session()->get('applocale'));
        }
        return $next($request);
    }
}
