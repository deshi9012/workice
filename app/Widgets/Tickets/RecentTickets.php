<?php

namespace App\Widgets\Tickets;

use Arrilot\Widgets\AbstractWidget;

class RecentTickets extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        return view(
            'widgets.tickets.recent_tickets', [
            'config' => $this->config,
            ]
        );
    }
}
