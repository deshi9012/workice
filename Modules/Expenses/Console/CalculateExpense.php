<?php

namespace Modules\Expenses\Console;

use Illuminate\Console\Command;
use Modules\Expenses\Entities\Expense;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CalculateExpense extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'expenses:balance {expense?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate expenses tax';

    /**
     * Create a new command instance.
     *
     * @return void
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
        $id = $this->argument('expense');

        if ($id > 0) {
            $expense = Expense::findOrFail($id);
            $expense->unsetEventDispatcher();
            $expense->compute();
        } else {
            Expense::chunk(
                200,
                function ($expenses) {
                    foreach ($expenses as $expense) {
                        $expense->unsetEventDispatcher();
                        $expense->compute();
                    }
                }
            );
        }
        $this->info('Expenses calculated successfully');
    }
}
