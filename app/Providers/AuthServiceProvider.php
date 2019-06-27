<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Validator;
use App\Services\Pwned;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Modules\Tasks\Entities\Task' => 'Modules\Tasks\Policies\TaskPolicy',
        'Modules\Invoices\Entities\Invoice' => 'Modules\Invoices\Policies\InvoicePolicy',
        'Modules\Estimates\Entities\Estimate' => 'Modules\Estimates\Policies\EstimatePolicy',
        'Modules\Expenses\Entities\Expense' => 'Modules\Expenses\Policies\ExpensePolicy',
        'Modules\Creditnotes\Entities\CreditNote' => 'Modules\Creditnotes\Policies\CreditPolicy',
        'Modules\Timetracking\Entities\TimeEntry' => 'Modules\Timetracking\Policies\TimerPolicy',
        'Modules\Projects\Entities\Project' => 'Modules\Projects\Policies\ProjectPolicy',
        'Modules\Knowledgebase\Entities\Knowledgebase' => 'Modules\Knowledgebase\Policies\KnowledgebasePolicy',
        'Modules\Contracts\Entities\Contract' => 'Modules\Contracts\Policies\ContractPolicy',
        'Modules\Comments\Entities\Comment' => 'Modules\Comments\Policies\CommentPolicy',
        'Modules\Files\Entities\FileUpload' => 'Modules\Files\Policies\FilePolicy',
        'Modules\Tickets\Entities\Ticket' => 'Modules\Tickets\Policies\TicketPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Validator::extend('pwned', Pwned::class);
        Passport::withCookieSerialization();
        Passport::cookie(config('auth.passport.cookie', env('PASSPORT_COOKIE', 'workice_crm_token')));
        Passport::routes();
    }
}
