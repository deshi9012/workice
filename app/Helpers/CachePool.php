<?php
namespace App\Helpers;

use Closure;
use Cache\Adapter\Redis\RedisCachePool;
use Cache\Bridge\SimpleCache\SimpleCacheBridge;

class CachePool
{
    /**
     * Get the cache store.
     *
     * @param mixed
     */
    public static function redis(): Closure
    {
        return function () {
            if (class_exists('Redis')) {
                $client = new \Redis();
                $client->connect('127.0.0.1', 6379);
                $pool = new RedisCachePool($client);
                return new SimpleCacheBridge($pool);
            }
            throw new \InvalidArgumentException('PHP Redis is not installed on this server');
        };
    }
}
