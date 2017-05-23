<?php

use App\Models\Business\Business;

/**
 * Our Helper Functions
 * These should mostly be things used as shorthand getters in the view,
 * and shouldn't change object state
 */

/**
 * Return a URL for a business
 * @param  string        $endpoint an endpoint (without leading/trailing slashes)
 * @param  Business|null $business
 * @return string URL
 */
function businessUrl($endpoint, Business $business = null)
{
    $business = $business ?: Business::current();
    return env('APP_URL') . '/' . $business->slug . '/' . $endpoint;
}
