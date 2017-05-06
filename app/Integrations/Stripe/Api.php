<?php

namespace App\Integrations\Stripe;

use App\Models\Business\Business;
use App\Services\Api\BaseApi;
use Stripe\Customer;
use Stripe\Plan;
use Stripe\Subscription;

class Api extends BaseApi
{
    protected static $instance;

    /**
     * The Credentials used for this API
     * @var StripeCredentials
     */
    protected $credentials;

    public static function instance(Business $business = null)
    {
        self::$instance = self::$instance ?: new static($business);

        return self::$instance;
    }

    private function __construct(Business $business = null)
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
            $plans = collect($this->fetchPlans());
        } catch (\Exception $e) {
            $plans = collect();
        }

        $this->setCacheValue($method, $plans);

        return $plans;
    }

    private function fetchPlans($starting_after = null)
    {
        $plans = Plan::all(['limit' => 100, 'starting_after' => $starting_after]);
        $plans_data = $plans['data'];
        if ($plans['has_more']) {
            $last_item = collect($plans_data)->last();
            $plans_data = array_merge($plans_data, $this->fetchPlans($last_item->id));
        }

        return $plans_data;
    }

    public function getPlanForSubscription($subscription_id)
    {
        $method = 'subscription.plan.get.' . $subscription_id;
        if ($this->checkCache($method)) {
            return $this->getCacheValue($method);
        }

        try {
            $subscription = Subscription::retrieve($subscription_id);
            $plan = $subscription->plan;
        } catch (\Exception $e) {
            \Log::info('Error when trying to retrieve Subscription: ' . $e->getMessage());
        }

        $this->setCacheValue($method, $plan);

        return $plan;
    }


    public function getCustomer($remote_customer_id)
    {
        $method = 'customer.get.' . $remote_customer_id;
        if ($this->checkCache($method)) {
            return $this->getCacheValue($method);
        }

        try {
            $customer = Customer::retrieve($remote_customer_id);
            $customer = collect($customer);
        } catch (\Exception $e) {
            $customer = collect();
        }

        $this->setCacheValue($method, $customer);

        return $customer;
    }
}
