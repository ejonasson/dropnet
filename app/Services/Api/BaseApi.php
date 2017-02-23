<?php

namespace App\Services\Api;

use App\Contracts\UsesCache;
use Illuminate\Support\Facades\Cache;

abstract class BaseApi implements UsesCache
{
    const CACHE_DURATION = 20;

    /**
     * A method for generating our cache key
     * Should use something that will be unique to each individual API User
     * @return string
     */
    abstract public function getCacheKey($method);

    public function checkCache($method)
    {
        return Cache::has($this->getCacheKey($method));
    }

    public function getCacheValue($method)
    {
        return Cache::get($this->getCacheKey($method));
    }

    public function setCacheValue($method, $value)
    {
        Cache::put($this->getCacheKey($method), $value, self::CACHE_DURATION);
    }
}
