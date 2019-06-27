<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Deals\Entities\Deal;
use Modules\Estimates\Entities\Estimate;
use Modules\Expenses\Entities\Expense;
use Modules\Invoices\Entities\Invoice;
use Modules\Leads\Entities\Lead;
use Modules\Payments\Entities\Payment;
use Modules\Tasks\Entities\Task;
use Modules\Tickets\Entities\Ticket;
use Modules\Timetracking\Entities\TimeEntry;
use Modules\Users\Emails\DailyDigestMail;
use Modules\Users\Entities\User;
use Modules\Webhook\Jobs\Xrun;

class SendDailyEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-digest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Daily Summary';

    protected $summary;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->summary = [];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (config('system.daily_digest.enabled')) {
            $this->summary = [
                'payment_received'   => formatCurrency(get_option('default_currency'), $this->paidToday()),
                'invoiced_amount'    => formatCurrency(get_option('default_currency'), $this->invoicedToday()),
                'estimates_accepted' => formatCurrency(get_option('default_currency'), $this->estimatesToday()),
                'hours_worked'       => $this->workedToday(),
                'deals_won'          => Deal::whereDate('won_time', today()->toDateTimeString())->count(),
                'leads_converted'    => Lead::whereDate('converted_at', today()->toDateTimeString())->count(),
                'expenses_total'     => formatCurrency(get_option('default_currency'), $this->expensesToday()),
                'closed_tickets'     => Ticket::whereDate('closed_at', today()->toDateTimeString())->count(),
                'completed_tasks'    => Task::completed()->whereDate('updated_at', today()->toDateTimeString())->count(),
            ];
            \Mail::to(User::role('admin')->get())->send(new DailyDigestMail($this->summary));
        }
        Xrun::dispatch()->onQueue('low');
        $this->info('Daily summary sent successfully');
    }
    protected function paidToday()
    {
        $amount = 0;
        foreach (Payment::whereDate('created_at', today()->toDateTimeString())->get() as $payment) {
            if ($payment->currency != get_option('default_currency')) {
                $amount += convertCurrency($payment->currency, $payment->amount, null, $payment->exchange_rate);
            } else {
                $amount += $payment->amount;
            }
        }
        return $amount;
    }
    protected function invoicedToday()
    {
        $amount = 0;
        foreach (Invoice::whereDate('created_at', today()->toDateTimeString())->get() as $invoice) {
            if ($invoice->currency != get_option('default_currency')) {
                $amount += convertCurrency($invoice->currency, $invoice->payable, null, $invoice->exchange_rate);
            } else {
                $amount += $invoice->payable;
            }
        }
        return $amount;
    }
    protected function estimatesToday()
    {
        $amount = 0;
        foreach (Estimate::whereDate('accepted_time', today()->toDateTimeString())->get() as $estimate) {
            if ($estimate->currency != get_option('default_currency')) {
                $amount += convertCurrency($estimate->currency, $estimate->amount, null, $estimate->exchange_rate);
            } else {
                $amount += $estimate->amount;
            }
        }
        return $amount;
    }
    protected function workedToday()
    {
        $total = 0;
        foreach (TimeEntry::whereDate('created_at', today()->toDateTimeString())->get() as $entry) {
            $total += $entry->worked;
        }
        return secToHours($total);
    }
    protected function expensesToday()
    {
        $amount = 0;
        foreach (Expense::whereDate('expense_date', today()->toDateTimeString())->get() as $expense) {
            if ($expense->currency != get_option('default_currency')) {
                $amount += convertCurrency($expense->currency, $expense->amount, null, $expense->exchange_rate);
            } else {
                $amount += $expense->amount;
            }
        }
        return $amount;
    }
}
