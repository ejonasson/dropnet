<?php

namespace App\ValueObjects;

use App\Http\Requests\BusinessSettingsRequest;
use Illuminate\Contracts\Support\Arrayable;
use Stripe\Stripe;

class StripeCredentials implements Arrayable
{
    protected $secret_key;
    protected $publishable_key;
    protected $mode;

    public static function fromRequest(BusinessSettingsRequest $request)
    {
        return new self($request->get('secret_key'), $request->get('publishable_key'));
    }

    public function __construct($secret_key, $publishable_key)
    {
        $this->secret_key           = $secret_key;
        $this->publishable_key      = $publishable_key;

        $this->mode = $this->getModeFromApiKey();
    }

    /**
     * Gets the most of the API Key
     * Based on if "Test" is in the key name
     * @return string
     */
    protected function getModeFromApiKey()
    {
        if (strpos($this->secret_key, 'test') > -1) {
            return 'test';
        }

        return 'live';
    }

    /**
     * Gets the value of secret_key.
     *
     * @return mixed
     */
    public function getSecretKey()
    {
        return $this->secret_key;
    }

    /**
     * Sets the value of secret_key.
     *
     * @param mixed $secret_key the api key
     *
     * @return self
     */
    public function setSecretKey($secret_key)
    {
        $this->secret_key = $secret_key;

        return $this;
    }

    /**
     * Gets the value of publishable_key.
     *
     * @return mixed
     */
    public function getPublishableKey()
    {
        return $this->publishable_key;
    }

    /**
     * Sets the value of publishable_key.
     *
     * @param mixed $publishable_key the api secret
     *
     * @return self
     */
    public function setPublishableKey($publishable_key)
    {
        $this->publishable_key = $publishable_key;

        return $this;
    }

    /**
     * Gets the value of mode.
     *
     * @return mixed
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Sets the value of mode.
     *
     * @param mixed $mode the mode
     *
     * @return self
     */
    public function setMode($mode)
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * Authenticate these keys with the Stripe SDk
     * @return void
     */
    public function authenticate()
    {
        Stripe::setApiKey($this->secret_key);
    }

    public function toArray()
    {
        return [
            'secret_key'        => $this->getSecretKey(),
            'publishable_key'   => $this->getPublishableKey(),
            'mode'              => $this->getMode()
        ];
    }
}
