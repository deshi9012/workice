<?php

namespace App\Traits;

use App\Entities\Vault;

trait Vaultable
{
    public function vault()
    {
        return $this->morphMany(Vault::class, 'vaultable');
    }
}
