<?php

namespace Modules\Expenses\Listeners;

use Auth;

class ExpenseEventSubscriber
{
    protected $user;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = Auth::check() ? Auth::id() : 1;
    }

    /**
     * Expense created listener
     */
    public function onExpenseCreated($event)
    {
        $data = [
            'action' => 'activity_create_expense', 'icon'                                            => 'fa-shopping-basket', 'user_id' => $this->user,
            'value1' => formatCurrency($event->expense->currency, $event->expense->amount), 'value2' => $event->expense->company->name,
            'url'    => $event->expense->url,
        ];
        $event->expense->activities()->create($data);
    }

    /**
     * Expense updated listener
     */
    public function onExpenseUpdated($event)
    {
        $data = [
            'action' => 'activity_update_expense', 'icon' => 'fa-pencil', 'user_id' => $this->user,
            'value1' => $event->expense->code, 'value2'   => $event->expense->company->name,
            'url'    => $event->expense->url,
        ];
        $event->expense->activities()->create($data);
    }

    /**
     * Expense deleted listener
     */
    public function onExpenseDeleted($event)
    {
        $data = [
            'action' => 'activity_delete_expense', 'icon' => 'fa-trash', 'user_id' => $this->user,
            'value1' => $event->expense->code, 'value2'   => $event->expense->amount_formatted,
            'url'    => $event->expense->url,
        ];
        $event->expense->activities()->create($data);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Modules\Expenses\Events\ExpenseCreated',
            'Modules\Expenses\Listeners\ExpenseEventSubscriber@onExpenseCreated'
        );

        $events->listen(
            'Modules\Expenses\Events\ExpenseUpdated',
            'Modules\Expenses\Listeners\ExpenseEventSubscriber@onExpenseUpdated'
        );
        $events->listen(
            'Modules\Expenses\Events\ExpenseDeleted',
            'Modules\Expenses\Listeners\ExpenseEventSubscriber@onExpenseDeleted'
        );
    }
}
