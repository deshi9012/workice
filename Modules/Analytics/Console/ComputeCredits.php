<?php

namespace Modules\Analytics\Console;

use Illuminate\Console\Command;
use Modules\Creditnotes\Entities\Credited;
use Modules\Creditnotes\Entities\CreditNote;

class ComputeCredits extends Command
{
    protected $credit;
    protected $credited;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'analytics:credits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to calculate credits reports.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->credit   = new CreditNote;
        $this->credited = new Credited;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->open();
        $this->closed();
        $this->thisMonth();
        $this->lastMonth();
        $this->calcQuaters();
        $this->info('Credits reports calculated successfully');
    }

    protected function open()
    {
        $amount = 0;
        $this->credit->where('is_refunded', 0)->open()->chunk(
            200,
            function ($credits) use (&$amount) {
                foreach ($credits as $key => $credit) {
                    if ($credit->currency != get_option('default_currency')) {
                        $amount += convertCurrency($credit->currency, $credit->balance, null, $credit->exchange_rate);
                    } else {
                        $amount += $credit->balance;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'credits_open'],
            ['value' => $amount]
        );
    }
    protected function closed()
    {
        $amount = 0;
        $this->credited->chunk(
            200,
            function ($credited) use (&$amount) {
                foreach ($credited as $key => $used) {
                    if ($used->credit->currency != get_option('default_currency')) {
                        $amount += convertCurrency($used->credit->currency, $used->credited_amount, null, $used->credit->exchange_rate);
                    } else {
                        $amount += $used->credited_amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'credits_closed'],
            ['value' => $amount]
        );
    }

    protected function thisMonth()
    {
        $amount = 0;
        $this->credit->where('is_refunded', 0)->whereYear('created_at', now()->format('Y'))->whereMonth('created_at', now()->format('n'))->chunk(
            200,
            function ($credits) use (&$amount) {
                foreach ($credits as $key => $credit) {
                    if ($credit->currency != get_option('default_currency')) {
                        $amount += convertCurrency($credit->currency, $credit->amount, null, $credit->exchange_rate);
                    } else {
                        $amount += $credit->amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'credits_this_month'],
            ['value' => $amount]
        );
    }

    protected function lastMonth()
    {
        $amount = 0;
        $dt     = now()->subMonth(1);
        $this->credit->where('is_refunded', 0)->whereYear('created_at', $dt->format('Y'))->whereMonth('created_at', $dt->format('n'))->chunk(
            200,
            function ($credits) use (&$amount) {
                foreach ($credits as $key => $credit) {
                    if ($credit->currency != get_option('default_currency')) {
                        $amount += convertCurrency($credit->currency, $credit->amount, null, $credit->exchange_rate);
                    } else {
                        $amount += $credit->amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'credits_last_month'],
            ['value' => $amount]
        );
    }

    protected function calcQuaters()
    {
        $year = chartYear();
        for ($i = 1; $i < 13; $i++) {
            $amount = 0;
            $this->credit->where('is_refunded', 0)->whereYear('created_at', $year)->whereMonth('created_at', $i)->chunk(
                200,
                function ($credits) use (&$amount) {
                    foreach ($credits as $key => $credit) {
                        if ($credit->currency != get_option('default_currency')) {
                            $amount += convertCurrency($credit->currency, $credit->amount, null, $credit->exchange_rate);
                        } else {
                            $amount += $credit->amount;
                        }
                    };
                }
            );
            \App\Entities\Computed::updateOrCreate(
                ['key' => 'credits_' . $i . '_' . $year],
                ['value' => $amount]
            );
        }
    }
}
