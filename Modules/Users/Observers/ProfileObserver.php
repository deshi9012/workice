<?php

namespace Modules\Users\Observers;

use Modules\Clients\Entities\Client;
use Modules\Users\Entities\Profile;

class ProfileObserver
{
    /**
     * Listen to the Profile creating event.
     *
     * @param Profile $profile
     */
    public function creating(Profile $profile)
    {
        if (!is_numeric($profile->company) && !is_null($profile->company)) {
            $profile->company = Client::firstOrCreate(
                ['name' => $profile->company],
                ['code' => generateCode('clients')]
            )->id;
        }
    }
}
