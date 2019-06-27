<?php

namespace Modules\Invoices\Console;

use Illuminate\Console\Command;
use Modules\Invoices\Entities\Invoice;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CalculateBalance extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'invoices:balance {invoice?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate invoice balances';

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
        $id = $this->argument('invoice');

        if ($id > 0) {
            $invoice = Invoice::findOrFail($id);
            $invoice->unsetEventDispatcher();
            $invoice->compute();
        } else {
            Invoice::open()->chunk(
                200,
                function ($invoices) {
                    foreach ($invoices as $invoice) {
                        $invoice->unsetEventDispatcher();
                        $invoice->compute();
                    }
                }
            );
        }
        $this->info('Invoice balances calculated successfully');
    }
}
