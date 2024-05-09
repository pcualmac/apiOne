<?php

namespace App\Http\Middleware;
use Illuminate\Support\Str;

use Closure;
use Config;

class SetDynamicJWTSecretKey
{
    public function handle($request, Closure $next)
    {
        $dynamicKey = $this->calculateDynamicKey();
        // Update JWT configuration dynamically
        Config::set('jwt.secret', $dynamicKey);

        return $next($request);
    }

    private function calculateDynamicKey()
    {
        return Config::get('app_tokens.jwt_secret');
    }
}
