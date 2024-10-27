<?php
namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class RefreshTokenMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($user = JWTAuth::parseToken()->authenticate()) {
            $newToken = JWTAuth::refresh();
            $request->headers->set('Authorization', 'Bearer ' . $newToken);
        }

        return $next($request);
    }
}
