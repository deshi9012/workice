<?php

namespace Modules\Analytics\Console;

use Illuminate\Console\Command;
use Modules\Expenses\Entities\Expense;

class ComputeExpenses extends Command
{
    protected $expense;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'analytics:expenses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to calculate expense reports.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->expense = new Expense;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->billed();
        $this->unbillable();
        $this->thisYear();
        $this->today();
        $this->thisWeek();
        $this->thisMonth();
        $this->lastMonth();
        $this->yearlyBillable();
        $this->yearlyBilled();
        $this->average();
        $this->info('Expense reports calculated successfully');
    }

    protected function billed()
    {
        $amount = 0;
        $this->expense->billed()->chunk(
            200,
            function ($expenses) use (&$amount) {
                foreach ($expenses as $key => $expense) {
                    if ($expense->currency != get_option('default_currency')) {
                        $amount += convertCurrency($expense->currency, $expense->amount, null, $expense->exchange_rate);
                    } else {
                        $amount += $expense->amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'expenses_billed'],
            ['value' => $amount]
        );
    }
    protected function unbillable()
    {
        $amount = 0;
        $this->expense->unbillable()->chunk(
            200,
            function ($expenses) use (&$amount) {
                foreach ($expenses as $key => $expense) {
                    if ($expense->currency != get_option('default_currency')) {
                        $amount += convertCurrency($expense->currency, $expense->amount, null, $expense->exchange_rate);
                    } else {
                        $amount += $expense->amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'expenses_unbillable'],
            ['value' => $amount]
        );
    }

    protected function today()
    {
        $amount = 0;
        $this->expense->whereDate('expense_date', today())->chunk(
            200,
            function ($expenses) use (&$amount) {
                foreach ($expenses as $key => $expense) {
                    if ($expense->currency != get_option('default_currency')) {
                        $amount += convertCurrency($expense->currency, $expense->amount, null, $expense->exchange_rate);
                    } else {
                        $amount += $expense->amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'expenses_today'],
            ['value' => $amount]
        );
    }
    protected function thisWeek()
    {
        $amount = 0;
        $this->expense->whereBetween('expense_date', [now()->startOfWeek(),now()->endOfWeek()])->chunk(
            200,
            function ($expenses) use (&$amount) {
                foreach ($expenses as $key => $expense) {
                    if ($expense->currency != get_option('default_currency')) {
                        $amount += convertCurrency($expense->currency, $expense->amount, null, $expense->exchange_rate);
                    } else {
                        $amount += $expense->amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'expenses_this_week'],
            ['value' => $amount]
        );
    }

    protected function thisYear()
    {
        $amount = 0;
        $this->expense->whereYear('expense_date', chartYear())->chunk(
            200,
            function ($expenses) use (&$amount) {
                foreach ($expenses as $key => $expense) {
                    if ($expense->currency != get_option('default_currency')) {
                        $amount += convertCurrency($expense->currency, $expense->amount, null, $expense->exchange_rate);
                    } else {
                        $amount += $expense->amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'expenses_year_' . chartYear()],
            ['value' => $amount]
        );
    }

    protected function thisMonth()
    {
        $amount = 0;
        $this->expense->whereYear('expense_date', now()->format('Y'))->whereMonth('expense_date', now()->format('n'))->chunk(
            200,
            function ($expenses) use (&$amount) {
                foreach ($expenses as $key => $expense) {
                    if ($expense->currency != get_option('default_currency')) {
                        $amount += convertCurrency($expense->currency, $expense->amount, null, $expense->exchange_rate);
                    } else {
                        $amount += $expense->amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'expenses_this_month'],
            ['value' => $amount]
        );
    }
    protected function lastMonth()
    {
        $amount = 0;
        $dt     = now()->subMonth(1);
        $this->expense->whereYear('expense_date', $dt->format('Y'))->whereMonth('expense_date', $dt->format('n'))->chunk(
            200,
            function ($expenses) use (&$amount) {
                foreach ($expenses as $key => $expense) {
                    if ($expense->currency != get_option('default_currency')) {
                        $amount += convertCurrency($expense->currency, $expense->amount, null, $expense->exchange_rate);
                    } else {
                        $amount += $expense->amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'expenses_last_month'],
            ['value' => $amount]
        );
    }

    protected function yearlyBillable()
    {
        $year = chartYear();
        for ($i = 1; $i < 13; $i++) {
            $amount = 0;
            $this->expense->billable()->whereYear('expense_date', $year)->whereMonth('expense_date', $i)->chunk(
                200,
                function ($expenses) use (&$amount) {
                    foreach ($expenses as $key => $expense) {
                        if ($expense->currency != get_option('default_currency')) {
                            $amount += convertCurrency($expense->currency, $expense->amount, null, $expense->exchange_rate);
                        } else {
                            $amount += $expense->amount;
                        }
                    };
                }
            );
            \App\Entities\Computed::updateOrCreate(
                ['key' => 'expenses_billable_' . $i . '_' . $year],
                ['value' => $amount]
            );
        }
    }
    protected function yearlyBilled()
    {
        $year = chartYear();
        for ($i = 1; $i < 13; $i++) {
            $amount = 0;
            $this->expense->billed()->whereYear('expense_date', $year)->whereMonth('expense_date', $i)->chunk(
                200,
                function ($expenses) use (&$amount) {
                    foreach ($expenses as $key => $expense) {
                        if ($expense->currency != get_option('default_currency')) {
                            $amount += convertCurrency($expense->currency, $expense->amount, null, $expense->exchange_rate);
                        } else {
                            $amount += $expense->amount;
                        }
                    };
                }
            );
            \App\Entities\Computed::updateOrCreate(
                ['key' => 'expenses_billed_' . $i . '_' . $year],
                ['value' => $amount]
            );
        }
    }

    protected function average()
    {
        $amount = 0;
        $this->expense->select('id', 'amount', 'currency', 'amount', 'exchange_rate')->chunk(
            200,
            function ($expenses) use (&$amount) {
                foreach ($expenses as $key => $expense) {
                    if ($expense->currency != get_option('default_currency')) {
                        $amount += convertCurrency($expense->currency, $expense->amount, null, $expense->exchange_rate);
                    } else {
                        $amount += $expense->amount;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'expenses_average'],
            ['value' => $amount > 0 ? $amount / $this->expense->count() : 0]
        );
    }
}
