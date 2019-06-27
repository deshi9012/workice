<?php

namespace Modules\Analytics\Console;

use Illuminate\Console\Command;
use Modules\Estimates\Entities\Estimate;

class ComputeEstimates extends Command
{
    protected $estimate;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'analytics:estimates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to calculate estimates reports.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->estimate = new Estimate;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->accepted();
        $this->rejected();
        $this->thisMonth();
        $this->lastMonth();
        $this->yearlyAccepted();
        $this->yearlyRejected();
        $this->yearlyTotal();
        $this->info('Estimate reports calculated successfully');
    }
    /**
     * Accepted estimates
     */
    protected function accepted()
    {
        $amount = 0;
        $this->estimate->accepted()->chunk(
            200,
            function ($estimates) use (&$amount) {
                foreach ($estimates as $key => $estimate) {
                    if ($estimate->currency != get_option('default_currency')) {
                        $amount += convertCurrency($estimate->currency, $estimate->amount, null, $estimate->exchange_rate);
                    } else {
                        $amount += $estimate->amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'estimates_accepted'],
            ['value' => $amount]
        );
    }
    /**
     * Rejected estimates
     */
    protected function rejected()
    {
        $amount = 0;
        $this->estimate->rejected()->chunk(
            200,
            function ($estimates) use (&$amount) {
                foreach ($estimates as $key => $estimate) {
                    if ($estimate->currency != get_option('default_currency')) {
                        $amount += convertCurrency($estimate->currency, $estimate->amount, null, $estimate->exchange_rate);
                    } else {
                        $amount += $estimate->amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'estimates_rejected'],
            ['value' => $amount]
        );
    }
    /**
     * Estimates created in the current month
     */
    protected function thisMonth()
    {
        $amount = 0;
        $this->estimate->whereMonth('created_at', now()->format('n'))->chunk(
            200,
            function ($estimates) use (&$amount) {
                foreach ($estimates as $key => $estimate) {
                    if ($estimate->currency != get_option('default_currency')) {
                        $amount += convertCurrency($estimate->currency, $estimate->amount, null, $estimate->exchange_rate);
                    } else {
                        $amount += $estimate->amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'estimates_this_month'],
            ['value' => $amount]
        );
    }
    /**
     * Estimates created last month
     */
    protected function lastMonth()
    {
        $amount = 0;
        $dt     = now()->subMonth(1);
        $this->estimate->whereYear('created_at', $dt->format('Y'))->whereMonth('created_at', $dt->format('n'))->chunk(
            200,
            function ($estimates) use (&$amount) {
                foreach ($estimates as $key => $estimate) {
                    if ($estimate->currency != get_option('default_currency')) {
                        $amount += convertCurrency($estimate->currency, $estimate->amount, null, $estimate->exchange_rate);
                    } else {
                        $amount += $estimate->amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'estimates_last_month'],
            ['value' => $amount]
        );
    }
    /**
     * Yearly accepted estimates
     */
    protected function yearlyAccepted()
    {
        $year = chartYear();
        for ($i = 1; $i < 13; $i++) {
            $amount = 0;
            $this->estimate->accepted()->whereYear('created_at', $year)->whereMonth('created_at', $i)->chunk(
                200,
                function ($estimates) use (&$amount) {
                    foreach ($estimates as $key => $estimate) {
                        if ($estimate->currency != get_option('default_currency')) {
                            $amount += convertCurrency($estimate->currency, $estimate->amount, null, $estimate->exchange_rate);
                        } else {
                            $amount += $estimate->amount;
                        }
                    };
                }
            );
            \App\Entities\Computed::updateOrCreate(
                ['key' => 'estimates_accepted_' . $i . '_' . $year],
                ['value' => $amount]
            );
        }
    }
    /**
     * Yearly Rejected estimates
     */
    protected function yearlyRejected()
    {
        $year = chartYear();
        for ($i = 1; $i < 13; $i++) {
            $amount = 0;
            $this->estimate->rejected()->whereYear('created_at', $year)->whereMonth('created_at', $i)->chunk(
                200,
                function ($estimates) use (&$amount) {
                    foreach ($estimates as $key => $estimate) {
                        if ($estimate->currency != get_option('default_currency')) {
                            $amount += convertCurrency($estimate->currency, $estimate->amount, null, $estimate->exchange_rate);
                        } else {
                            $amount += $estimate->amount;
                        }
                    };
                }
            );
            \App\Entities\Computed::updateOrCreate(
                ['key' => 'estimates_rejected_' . $i . '_' . $year],
                ['value' => $amount]
            );
        }
    }
    /**
     * Calculate yearly estimates total
     */
    protected function yearlyTotal()
    {
        $year = chartYear();
        for ($i = 1; $i < 13; $i++) {
            $amount = 0;
            $this->estimate->whereYear('created_at', $year)->whereMonth('created_at', $i)->chunk(
                200,
                function ($estimates) use (&$amount) {
                    foreach ($estimates as $key => $estimate) {
                        if ($estimate->currency != get_option('default_currency')) {
                            $amount += convertCurrency($estimate->currency, $estimate->amount, null, $estimate->exchange_rate);
                        } else {
                            $amount += $estimate->amount;
                        }
                    };
                }
            );
            \App\Entities\Computed::updateOrCreate(
                ['key' => 'estimates_' . $i . '_' . $year],
                ['value' => $amount]
            );
        }
    }
}
