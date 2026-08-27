<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth('admin')->check()) {
            $user = auth('admin')->user();
            
            if (!$user->derniere_connexion || $user->derniere_connexion->diffInMinutes(now()) >= 1) {
                $user->timestamps = false;
                $user->update([
                    'derniere_connexion' => now(),
                ]);
            }
        }

        return $next($request);
    }
}
