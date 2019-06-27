<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Modules\Installer\Events\InstallerFinished;
use Modules\Installer\Listeners\InstallerListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Illuminate\Mail\Events\MessageSending' => [
            'App\Listeners\MessageBeforeSendListener',
        ],
        \Illuminate\Auth\Events\Lockout::class  => [
            \App\Listeners\UserLockedOut::class,
        ],
        Registered::class                       => [
            SendEmailVerificationNotification::class,
        ],
        InstallerFinished::class                => [
            InstallerListener::class,
        ],
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        'Modules\Knowledgebase\Listeners\ArticleEventSubscriber',
        'Modules\Issues\Listeners\IssueEventSubscriber',
        'Modules\Comments\Listeners\CommentEventSubscriber',
        'Modules\Contracts\Listeners\ContractEventSubscriber',
        'Modules\Creditnotes\Listeners\CreditNoteEventSubscriber',
        'Modules\Deals\Listeners\DealEventSubscriber',
        'Modules\Estimates\Listeners\EstimateEventSubscriber',
        'Modules\Expenses\Listeners\ExpenseEventSubscriber',
        'Modules\Invoices\Listeners\InvoiceEventSubscriber',
        'Modules\Leads\Listeners\LeadEventSubscriber',
        'Modules\Milestones\Listeners\MilestoneEventSubscriber',
        'Modules\Payments\Listeners\PaymentEventSubscriber',
        'Modules\Projects\Listeners\ProjectEventSubscriber',
        'Modules\Settings\Listeners\SettingEventSubscriber',
        'Modules\Tasks\Listeners\TaskEventSubscriber',
        'Modules\Tickets\Listeners\TicketEventSubscriber',
        'Modules\Timetracking\Listeners\TimerEventSubscriber',
        'Modules\Todos\Listeners\TodoEventSubscriber',
        'Modules\Users\Listeners\UserEventSubscriber',
        'Modules\Teams\Listeners\AssignmentEventSubscriber',
        'Modules\Messages\Listeners\EmailEventSubscriber',
        'Modules\Updates\Listeners\UpdateEventSubscriber',
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
