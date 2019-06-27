<?php

namespace Modules\Settings\Observers;

use Cache;
use Modules\Settings\Entities\Options;

class SetupObserver
{
    /**
     * Listen to the settings update events.
     *
     * @param Options $option
     */
    public function updated(Options $option)
    {
        // Re-cache settings
        Cache::forget(settingsCacheName());
        Cache::remember(
            settingsCacheName(),
            now()->addDays(30),
            function () {
                return Options::select('value', 'config_key')->get()->toArray();
            }
        );
        Cache::forever('editorLocale', get_option('locale'));
        Cache::forever('datepickerLocale', get_option('locale'));
        Cache::forever('calendarLocale', get_option('locale'));
    }
}
