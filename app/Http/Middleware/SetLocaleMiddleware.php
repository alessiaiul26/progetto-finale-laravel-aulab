<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $localeLanguage = session('locale', 'it');
        app()->setLocale($localeLanguage);
        return $next($request);
    }
}
