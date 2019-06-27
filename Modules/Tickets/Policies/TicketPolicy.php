<?php

namespace Modules\Tickets\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Tickets\Entities\Ticket;
use Modules\Users\Entities\User;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before()
    {
        if (isAdmin()) {
            return true;
        }
    }

    /**
     * Determine if user can view ticket
     *
     * @param  \Modules\Users\Entities\User     $user
     * @param  \Modules\Tickets\Entities\Ticket $ticket
     * @return bool
     */
    public function show(User $user, Ticket $ticket)
    {
        return $user->id == $ticket->user_id || $ticket->isAgent() || $ticket->user->profile->company == $user->profile->company;
    }

    /**
     * Determine if user can update ticket
     *
     * @param  \Modules\Users\Entities\User     $user
     * @param  \Modules\Tickets\Entities\Ticket $ticket
     * @return bool
     */
    public function update(User $user, Ticket $ticket)
    {
        return $user->id == $ticket->user_id || can('tickets_update') || $ticket->isAgent();
    }
    /**
     * Determine if user can delete ticket
     *
     * @param  \Modules\Users\Entities\User     $user
     * @param  \Modules\Tickets\Entities\Ticket $ticket
     * @return bool
     */
    public function delete(User $user, Ticket $ticket)
    {
        return $user->id == $ticket->user_id || can('tickets_delete') || $ticket->isAgent();
    }
}
