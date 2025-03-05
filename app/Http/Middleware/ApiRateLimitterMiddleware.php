<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;

class ApiRateLimitterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        $key = 'rate-limit:' . ($user ? $user->id : $request->ip());

        $maxAttempts = Gate::allows('is-admin', $user) ? 10 : 5;

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            return response()->json(['message' => 'Too many requests'], 429);
        }

        RateLimiter::hit($key, 60);

        return $next($request);
    }
}
