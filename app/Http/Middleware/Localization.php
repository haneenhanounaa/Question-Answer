<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $default=config('app.name');

        $accept_language = $request->header('accept-language');
        if($accept_language){
           list($default)= explode(',',$accept_language);
        }

        $lang=$request->route('lang',$default);

        //$lang=$request->query('lang',$default);
        Session::put('locale',$lang);

//        $lang=$request->query('lang',config('app.locale'));
        App::setLocale($lang);
//        dd($accept_language );

        URL::defaults([
            'lang'=> $lang,
        ]);

        Route::current()->forgetParameter('lang');

        return $next($request);
    }
}
