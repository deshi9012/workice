<?php

namespace App\Traits;

trait Observable
{
    public static function boot()
    {
        parent::boot();
        if (isset(static::$observer)) {
            static::observe(static::$observer);
        }
        if (!is_null(static::$scope)) {
            static::addGlobalScope(new static::$scope);
        }
    }
}
