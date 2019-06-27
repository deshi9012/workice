<?php

namespace Modules\Analytics\Console;

use Illuminate\Console\Command;
use Modules\Invoices\Entities\Invoice;

class ComputeInvoices extends Command
{
    protected $invoice;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'analytics:invoices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to calculate invoice reports.';

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
        $this->invoiced();
        $this->outstanding();
        $this->invoicedToday();
        $this->invoicedWeek();
        $this->thisYear();
        $this->thisMonth();
        $this->lastMonth();
        $this->calcQuaters();
        $this->info('Invoice reports calculated successfully');
    }
    protected function invoiced()
    {
        $amount = 0;
        $this->invoice->whereNull('cancelled_at')->whereNull('archived_at')->chunk(
            200,
            function ($invoices) use (&$amount) {
                foreach ($invoices as $key => $invoice) {
                    if ($invoice->currency != get_option('default_currency')) {
                        $amount += convertCurrency($invoice->currency, $invoice->payable, null, $invoice->exchange_rate);
                    } else {
                        $amount += $invoice->payable;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'invoiced_total'],
            ['value' => $amount]
        );
    }
    protected function invoicedToday()
    {
        $amount = 0;
        $this->invoice->whereNull('cancelled_at')->whereNull('archived_at')->whereDate('created_at', today())->chunk(
            200,
            function ($invoices) use (&$amount) {
                foreach ($invoices as $key => $invoice) {
                    if ($invoice->currency != get_option('default_currency')) {
                        $amount += convertCurrency($invoice->currency, $invoice->payable, null, $invoice->exchange_rate);
                    } else {
                        $amount += $invoice->payable;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'invoiced_today'],
            ['value' => $amount]
        );
    }
    protected function invoicedWeek()
    {
        $amount = 0;
        $this->invoice->whereNull('cancelled_at')->whereNull('archived_at')->whereBetween('created_at', [now()->startOfWeek(),now()->endOfWeek()])->chunk(
            200,
            function ($invoices) use (&$amount) {
                foreach ($invoices as $key => $invoice) {
                    if ($invoice->currency != get_option('default_currency')) {
                        $amount += convertCurrency($invoice->currency, $invoice->payable, null, $invoice->exchange_rate);
                    } else {
                        $amount += $invoice->payable;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'invoiced_this_week'],
            ['value' => $amount]
        );
    }
    protected function outstanding()
    {
        $amount = 0;
        $this->invoice->whereNull('cancelled_at')->whereNull('archived_at')->where('balance', '>', 0)->chunk(
            200,
            function ($invoices) use (&$amount) {
                foreach ($invoices as $key => $invoice) {
                    if ($invoice->currency != get_option('default_currency')) {
                        $amount += convertCurrency($invoice->currency, $invoice->balance, null, $invoice->exchange_rate);
                    } else {
                        $amount += $invoice->balance;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'outstanding_balance'],
            ['value' => $amount]
        );
    }
    protected function thisYear()
    {
        $amount = 0;
        $this->invoice->whereNull('cancelled_at')->whereNull('archived_at')->whereYear('created_at', chartYear())->chunk(
            200,
            function ($invoices) use (&$amount) {
                foreach ($invoices as $key => $invoice) {
                    if ($invoice->currency != get_option('default_currency')) {
                        $amount += convertCurrency($invoice->currency, $invoice->payable, null, $invoice->exchange_rate);
                    } else {
                        $amount += $invoice->payable;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'invoiced_year_' . chartYear()],
            ['value' => $amount]
        );
    }
    protected function thisMonth()
    {
        $amount = 0;
        $this->invoice->whereNull('cancelled_at')->whereNull('archived_at')->whereYear('created_at', now()->format('Y'))->whereMonth('created_at', now()->format('n'))->chunk(
            200,
            function ($invoices) use (&$amount) {
                foreach ($invoices as $key => $invoice) {
                    if ($invoice->currency != get_option('default_currency')) {
                        $amount += convertCurrency($invoice->currency, $invoice->payable, null, $invoice->exchange_rate);
                    } else {
                        $amount += $invoice->payable;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'invoiced_this_month'],
            ['value' => $amount]
        );
    }
    protected function lastMonth()
    {
        $amount = 0;
        $dt     = now()->subMonth(1);
        $this->invoice->whereNull('cancelled_at')->whereNull('archived_at')->whereYear('created_at', $dt->format('Y'))->whereMonth('created_at', $dt->format('n'))->chunk(
            200,
            function ($invoices) use (&$amount) {
                foreach ($invoices as $key => $invoice) {
                    if ($invoice->currency != get_option('default_currency')) {
                        $amount += convertCurrency($invoice->currency, $invoice->payable, null, $invoice->exchange_rate);
                    } else {
                        $amount += $invoice->payable;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'invoiced_last_month'],
            ['value' => $amount]
        );
    }
    protected function calcQuaters()
    {
        $year = chartYear();
        for ($i = 1; $i < 13; $i++) {
            $amount = 0;
            $this->invoice->whereNull('cancelled_at')->whereNull('archived_at')->whereYear('created_at', $year)->whereMonth('created_at', $i)->chunk(
                200,
                function ($invoices) use (&$amount) {
                    foreach ($invoices as $key => $invoice) {
                        if ($invoice->currency != get_option('default_currency')) {
                            $amount += convertCurrency($invoice->currency, $invoice->payable, null, $invoice->exchange_rate);
                        } else {
                            $amount += $invoice->payable;
                        }
                    };
                }
            );
            \App\Entities\Computed::updateOrCreate(
                ['key' => 'invoiced_' . $i . '_' . $year],
                ['value' => $amount]
            );
        }
    }
}
