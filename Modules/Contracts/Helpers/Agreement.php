<?php

namespace Modules\Contracts\Helpers;

use Illuminate\Support\Facades\Storage;

class Agreement
{
    /**
     * Read a clause from the agreement
     *
     * @param  string $clause
     * @return mixed
     */
    public function readClause($clause)
    {
        if (Storage::disk('local')->exists('agreements/'.$clause.'.json')) {
            return json_decode(Storage::disk('local')->get('agreements/'.$clause.'.json'), true);
        }

        return false;
    }
}
