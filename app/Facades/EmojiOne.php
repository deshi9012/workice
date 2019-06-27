<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class EmojiOne extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'emojione';
    }
}
