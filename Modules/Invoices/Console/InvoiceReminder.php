<?php

namespace Modules\Invoices\Console;

use Illuminate\Console\Command;
use Modules\Invoices\Emails\FinalReminder;
use Modules\Invoices\Emails\FirmReminder;
use Modules\Invoices\Emails\PoliteReminder;
use Modules\Invoices\Entities\Invoice;
use Modules\Invoices\Events\InvoiceFinalReminder;
use Modules\Invoices\Events\InvoiceFirmReminder;
use Modules\Invoices\Events\InvoicePoliteReminder;
use Modules\Webhook\Jobs\Xrun;

class InvoiceReminder extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'invoices:reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to send invoice reminders.';

    protected $invoice;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->invoice = new Invoice;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (settingEnabled('autoremind_invoices')) {
            $overdues = $this->invoice->apply(['overdue' => 1])->where('alert_overdue', 1)->whereNull('archived_at')->get();
            foreach ($overdues as $invoice) {
                $daysOverdue = $invoice->due_date->diffInDays(now());
                if ($daysOverdue > get_option('invoices_overdue_reminder3') && is_null($invoice->reminder3)) {
                    // Should we apply late fee on last reminder
                    if (settingEnabled(get_option('final_reminder_late_fee'))) {
                        // Check if invoice has late fee already applied
                        if ($invoice->late_fee <= 0) {
                            $invoice->update(['late_fee' => get_option('late_fee'), 'late_fee_percent' => 1]);
                        }
                    }
                    // Send last invoice reminder
                    \Mail::to($invoice->company)->send(new FinalReminder($invoice));
                    event(new InvoiceFinalReminder($invoice));
                    return $invoice->update(['reminder3' => now()->toDateTimeString()]);
                } elseif ($daysOverdue >= get_option('invoices_overdue_reminder2') && is_null($invoice->reminder2)) {
                    // Send second firm reminder
                    \Mail::to($invoice->company)->send(new FirmReminder($invoice));
                    event(new InvoiceFirmReminder($invoice));
                    return $invoice->update(['reminder2' => now()->toDateTimeString()]);
                } elseif ($daysOverdue >= get_option('invoices_overdue_reminder1') && is_null($invoice->reminder1)) {
                    // Send normal polite reminder
                    \Mail::to($invoice->company)->send(new PoliteReminder($invoice));
                    event(new InvoicePoliteReminder($invoice));
                    return $invoice->update(['reminder1' => now()->toDateTimeString()]);
                } else {
                    return;
                }
            }
        }
        Xrun::dispatch()->onQueue('low');
    }
}
