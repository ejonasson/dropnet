<?php

namespace App\Http\Middleware;

use App\Models\Business\Business;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserIsPartOfBusiness
{
    /**
     * Check if the User is a part of the current site's business
     * If not, redirect to our site homepage
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $businesses = Auth::user()->businesses()->get();
        $current_business = $businesses->filter(function ($business) {
            $current_business = Business::current();
            return $current_business->id === $business->id;
        });

        return $current_business->isEmpty() ? redirect('/') : $next($request);
    }
}
