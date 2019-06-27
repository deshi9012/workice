<?php

namespace Modules\Analytics\Console;

use Illuminate\Console\Command;
use Modules\Deals\Entities\Deal;

class ComputeDeals extends Command
{
    protected $deal;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'analytics:deals';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to calculate deals reports.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->deal = new Deal;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->won();
        $this->lost();
        $this->dealsToday();
        $this->dealsThisWeek();
        $this->thisMonth();
        $this->lastMonth();
        $this->yearlyWon();
        $this->yearlyLost();
        $this->yearlyTotal();
        $this->forecast();
        $this->info('Deals reports calculated successfully');
    }

    protected function won()
    {
        $amount = 0;
        $this->deal->won()->chunk(
            200,
            function ($deals) use (&$amount) {
                foreach ($deals as $key => $deal) {
                    if ($deal->currency != get_option('default_currency')) {
                        $amount += convertCurrency($deal->currency, $deal->deal_value);
                    } else {
                        $amount += $deal->deal_value;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'deals_won'],
            ['value' => $amount]
        );
    }
    protected function lost()
    {
        $amount = 0;
        $this->deal->lost()->chunk(
            200,
            function ($deals) use (&$amount) {
                foreach ($deals as $key => $deal) {
                    if ($deal->currency != get_option('default_currency')) {
                        $amount += convertCurrency($deal->currency, $deal->deal_value);
                    } else {
                        $amount += $deal->deal_value;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'deals_lost'],
            ['value' => $amount]
        );
    }

    protected function dealsToday()
    {
        $amount = 0;
        $this->deal->whereDate('created_at', today())->chunk(
            200,
            function ($deals) use (&$amount) {
                foreach ($deals as $key => $deal) {
                    if ($deal->currency != get_option('default_currency')) {
                        $amount += convertCurrency($deal->currency, $deal->deal_value);
                    } else {
                        $amount += $deal->deal_value;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'deals_today'],
            ['value' => $amount]
        );
    }
    protected function dealsThisWeek()
    {
        $amount = 0;
        $this->deal->whereBetween('created_at', [now()->startOfWeek(),now()->endOfWeek()])->chunk(
            200,
            function ($deals) use (&$amount) {
                foreach ($deals as $key => $deal) {
                    if ($deal->currency != get_option('default_currency')) {
                        $amount += convertCurrency($deal->currency, $deal->deal_value);
                    } else {
                        $amount += $deal->deal_value;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'deals_this_week'],
            ['value' => $amount]
        );
    }

    protected function thisMonth()
    {
        $amount = 0;
        $this->deal->whereYear('created_at', now()->format('Y'))->whereMonth('created_at', now()->format('n'))->chunk(
            200,
            function ($deals) use (&$amount) {
                foreach ($deals as $key => $deal) {
                    if ($deal->currency != get_option('default_currency')) {
                        $amount += convertCurrency($deal->currency, $deal->deal_value);
                    } else {
                        $amount += $deal->deal_value;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'deals_this_month'],
            ['value' => $amount]
        );
    }

    protected function lastMonth()
    {
        $amount = 0;
        $dt     = now()->subMonth(1);
        $this->deal->whereYear('created_at', $dt->format('Y'))->whereMonth('created_at', $dt->format('n'))->chunk(
            200,
            function ($deals) use (&$amount) {
                foreach ($deals as $key => $deal) {
                    if ($deal->currency != get_option('default_currency')) {
                        $amount += convertCurrency($deal->currency, $deal->deal_value);
                    } else {
                        $amount += $deal->deal_value;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'deals_last_month'],
            ['value' => $amount]
        );
    }

    protected function yearlyWon()
    {
        $year = chartYear();
        for ($i = 1; $i < 13; $i++) {
            $amount = 0;
            $this->deal->whereYear('created_at', $year)->whereMonth('created_at', $i)->won()->chunk(
                200,
                function ($deals) use (&$amount) {
                    foreach ($deals as $key => $deal) {
                        if ($deal->currency != get_option('default_currency')) {
                            $amount += convertCurrency($deal->currency, $deal->deal_value);
                        } else {
                            $amount += $deal->deal_value;
                        }
                    };
                }
            );
            \App\Entities\Computed::updateOrCreate(
                ['key' => 'deals_won_' . $i . '_' . $year],
                ['value' => $amount]
            );

            \App\Entities\Computed::updateOrCreate(
                ['key' => 'num_deals_won_' . $i . '_' . $year],
                ['value' => $this->deal->whereYear('created_at', $year)->whereMonth('created_at', $i)->won()->count()]
            );
        }
    }
    protected function yearlyLost()
    {
        $year = chartYear();
        for ($i = 1; $i < 13; $i++) {
            $amount = 0;
            $this->deal->whereYear('created_at', $year)->whereMonth('created_at', $i)->lost()->chunk(
                200,
                function ($deals) use (&$amount) {
                    foreach ($deals as $key => $deal) {
                        if ($deal->currency != get_option('default_currency')) {
                            $amount += convertCurrency($deal->currency, $deal->deal_value);
                        } else {
                            $amount += $deal->deal_value;
                        }
                    };
                }
            );
            \App\Entities\Computed::updateOrCreate(
                ['key' => 'deals_lost_' . $i . '_' . $year],
                ['value' => $amount]
            );

            \App\Entities\Computed::updateOrCreate(
                ['key' => 'num_deals_lost_' . $i . '_' . $year],
                ['value' => $this->deal->whereYear('created_at', $year)->whereMonth('created_at', $i)->lost()->count()]
            );
        }
    }
    protected function yearlyTotal()
    {
        $year = chartYear();
        for ($i = 1; $i < 13; $i++) {
            \App\Entities\Computed::updateOrCreate(
                ['key' => 'deals_' . $i . '_' . $year],
                ['value' => $this->deal->whereYear('created_at', $year)->whereMonth('created_at', $i)->count()]
            );
        }
    }

    protected function forecast()
    {
        $amount = 0;
        $this->deal->open()->whereDate('due_date', '>', now())->chunk(
            200,
            function ($deals) use (&$amount) {
                foreach ($deals as $key => $deal) {
                    if ($deal->currency != get_option('default_currency')) {
                        $amount += convertCurrency($deal->currency, $deal->deal_value);
                    } else {
                        $amount += $deal->deal_value;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'deals_forecast'],
            ['value' => $amount]
        );
    }
}
