<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->segment(1) === 'en') {
            $locale = 'en';
        } elseif ($request->has('lang') && in_array($request->query('lang'), ['id', 'en'], true)) {
            $locale = $request->query('lang');
        } else {
            // Default public routes (without /en prefix) are Indonesian
            $locale = 'id';
        }

        session(['locale' => $locale]);
        App::setLocale($locale);

        return $next($request);
    }
}
