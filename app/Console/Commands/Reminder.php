<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Calendar\Jobs\AppointmentReminderJob;
use Modules\Calendar\Jobs\EventReminderJob;
use Modules\Contracts\Jobs\ContractReminderJob;
use Modules\Estimates\Jobs\EstimateReminderJob;
use Modules\Invoices\Jobs\InvoiceReminderJob;
use Modules\Settings\Jobs\SetupChk;
use Modules\Tasks\Jobs\TaskReminderJob;
use Modules\Todos\Jobs\TodoReminderJob;

class Reminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        AppointmentReminderJob::dispatch();
        if (settingEnabled('automatic_reminders')) {
            TodoReminderJob::dispatch();
            EventReminderJob::dispatch();
            TaskReminderJob::dispatch();
            InvoiceReminderJob::dispatch();
            EstimateReminderJob::dispatch();
            ContractReminderJob::dispatch();
        }
        SetupChk::dispatch()->onQueue('low');
        $this->info('Reminders sent successfully');
    }
}
