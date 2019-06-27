<?php

namespace Modules\Analytics\Console;

use Illuminate\Console\Command;
use Modules\Payments\Entities\Payment;

class ComputePayments extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'analytics:payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to calculate payment reports.';

    /**
     * Payment model
     *
     * @var \Modules\Payments\Entities\Payment
     */
    protected $payment;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Payment $payment)
    {
        parent::__construct();
        $this->payment = $payment;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->totalReceipts();
        $this->paidToday();
        $this->thisWeek();
        $this->thisYear();
        $this->thisMonth();
        $this->lastMonth();
        $this->calcQuaters();
        $this->info('Payment reports calculated successfully');
    }

    protected function totalReceipts()
    {
        $amount = 0;
        $this->payment->where('is_refunded', 0)->chunk(
            200,
            function ($payments) use (&$amount) {
                foreach ($payments as $key => $payment) {
                    if ($payment->currency != get_option('default_currency')) {
                        $amount += convertCurrency($payment->currency, $payment->amount, null, $payment->exchange_rate);
                    } else {
                        $amount += $payment->amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'total_receipts'],
            ['value' => $amount]
        );
    }
    protected function paidToday()
    {
        $amount = 0;
        $this->payment->where('is_refunded', 0)->whereDate('payment_date', today())->chunk(
            200,
            function ($payments) use (&$amount) {
                foreach ($payments as $key => $payment) {
                    if ($payment->currency != get_option('default_currency')) {
                        $amount += convertCurrency($payment->currency, $payment->amount, null, $payment->exchange_rate);
                    } else {
                        $amount += $payment->amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'paid_today'],
            ['value' => $amount]
        );
    }
    protected function thisWeek()
    {
        $amount = 0;
        $this->payment->where('is_refunded', 0)->whereBetween('payment_date', [now()->startOfWeek(),now()->endOfWeek()])->chunk(
            200,
            function ($payments) use (&$amount) {
                foreach ($payments as $key => $payment) {
                    if ($payment->currency != get_option('default_currency')) {
                        $amount += convertCurrency($payment->currency, $payment->amount, null, $payment->exchange_rate);
                    } else {
                        $amount += $payment->amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'paid_this_week'],
            ['value' => $amount]
        );
    }

    protected function thisYear()
    {
        $amount = 0;
        $this->payment->where('is_refunded', 0)->whereYear('payment_date', chartYear())->chunk(
            200,
            function ($payments) use (&$amount) {
                foreach ($payments as $key => $payment) {
                    if ($payment->currency != get_option('default_currency')) {
                        $amount += convertCurrency($payment->currency, $payment->amount, null, $payment->exchange_rate);
                    } else {
                        $amount += $payment->amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'revenue_year_' . chartYear()],
            ['value' => $amount]
        );
    }

    protected function thisMonth()
    {
        $amount = 0;
        $this->payment->where('is_refunded', 0)->whereYear('payment_date', now()->format('Y'))->whereMonth('payment_date', now()->format('n'))->chunk(
            200,
            function ($payments) use (&$amount) {
                foreach ($payments as $key => $payment) {
                    if ($payment->currency != get_option('default_currency')) {
                        $amount += convertCurrency($payment->currency, $payment->amount, null, $payment->exchange_rate);
                    } else {
                        $amount += $payment->amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'revenue_this_month'],
            ['value' => $amount]
        );
    }

    protected function lastMonth()
    {
        $amount = 0;
        $dt     = now()->subMonth(1);
        $this->payment->where('is_refunded', 0)->whereYear('payment_date', $dt->format('Y'))->whereMonth('payment_date', $dt->format('n'))->chunk(
            200,
            function ($payments) use (&$amount) {
                foreach ($payments as $key => $payment) {
                    if ($payment->currency != get_option('default_currency')) {
                        $amount += convertCurrency($payment->currency, $payment->amount, null, $payment->exchange_rate);
                    } else {
                        $amount += $payment->amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'revenue_last_month'],
            ['value' => $amount]
        );
    }

    protected function calcQuaters()
    {
        $year = chartYear();
        for ($i = 1; $i < 13; $i++) {
            $amount = 0;
            $this->payment->where('is_refunded', 0)->whereYear('payment_date', $year)->whereMonth('payment_date', (string) $i)->chunk(
                200,
                function ($payments) use (&$amount) {
                    foreach ($payments as $key => $payment) {
                        if ($payment->currency != get_option('default_currency')) {
                            $amount += convertCurrency($payment->currency, $payment->amount, null, $payment->exchange_rate);
                        } else {
                            $amount += $payment->amount;
                        }
                    };
                }
            );
            \App\Entities\Computed::updateOrCreate(
                ['key' => 'payments_' . $i . '_' . $year],
                ['value' => $amount]
            );
        }
    }
}
