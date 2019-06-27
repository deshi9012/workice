<?php

namespace Modules\Contracts\Observers;

use Modules\Contracts\Entities\Contract;

class ContractObserver
{
    /**
     * Listen to the Contract creating event.
     *
     * @param Contract $contract
     */
    public function creating(Contract $contract)
    {
        $contract->user_id = \Auth::check() ? \Auth::id() : 1;
    }

    /**
     * Listen to the Contract deleting event.
     *
     * @param Contract $contract
     */
    public function deleting(Contract $contract)
    {
        $contract->activities()->each(
            function ($activity) {
                $activity->delete();
            }
        );
        $contract->files()->each(
            function ($file) {
                $file->delete();
            }
        );
        $contract->comments()->each(
            function ($comment) {
                $comment->delete();
            }
        );
    }
}
