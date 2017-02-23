<?php

namespace App\Contracts;

interface UsesCache
{
    public function checkCache($method);
    public function getCacheKey($method);
    public function getCacheValue($method);
    public function setCacheValue($method, $value);
}
