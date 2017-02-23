<?php

namespace App\Http\Middleware;

use App\Models\Business\Business;
use Closure;

class AuthenticateStripeByBusiness
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
        $business       = Business::current();
        $credentials    = $business->getStripeCredentials();
        if ($credentials) {
            $credentials->authenticate();
        }

        return $next($request);
    }
}
