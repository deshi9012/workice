<?php

namespace Modules\Users\Observers;

use App\Entities\Vault;
use Auth;

class VaultObserver
{
    /**
     * Listen to vault creating event.
     *
     * @param Vault $vault
     */
    public function creating(Vault $vault)
    {
        $vault->user_id = empty($vault->user_id) ? Auth::id() : $vault->user_id;
    }
}
