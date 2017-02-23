<?php

namespace App\Integrations\Stripe;

use App\Models\Business\Business;
use App\Services\Api\BaseApi;
use Stripe\Plan;

class Api extends BaseApi
{
    /**
     * The Credentials used for this API
     * @var StripeCredentials
     */
    protected $credentials;

    public function __construct(Business $business = null)
    {
        $business = $business ?: Business::current();
        $this->credentials = $business->getStripeCredentials();
    }

    /**
     * Get the Key for our current API method
     * @param  string $method
     * @return string
     */
    public function getCacheKey($method)
    {
        $credentials_hash = md5(implode('.', $this->credentials->toArray()));
        return ('stripe.' . $credentials_hash . '.' . $method);
    }

    public function getAllSubscriptionPlans()
    {
        $method = 'plans.all';
        if ($this->checkCache($method)) {
            return $this->getCacheValue($method);
        }

        try {
            $plans = Plan::all();
            $plans = collect($plans['data']);
        } catch (\Exception $e) {
            $plans = collect();
        }

        $this->setCacheValue($method, $plans);

        return $plans;
    }
}