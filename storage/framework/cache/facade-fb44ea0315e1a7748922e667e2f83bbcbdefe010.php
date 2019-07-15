<?php

namespace Facades\App\Helpers;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Helpers\CurrencyConverter
 */
class CurrencyConverter extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Helpers\CurrencyConverter';
    }
}
