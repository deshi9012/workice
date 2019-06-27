<?php

namespace App\Traits;

use Modules\Teams\Entities\Assignment;

trait Assignable
{
    public function assignees()
    {
        return $this->morphMany(Assignment::class, 'assignable')->with('user:id,username,email,name')->orderBy('id', 'desc');
    }
    public function assignTeam($team)
    {
        if (count((array) $team) > 0) {
            $this->assignees()->delete();
            foreach ($team as $key => $member) {
                $this->assignees()->create(['user_id' => $member]);
            }
        }
    }
}
