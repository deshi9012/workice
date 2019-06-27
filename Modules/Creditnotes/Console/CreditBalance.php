<?php

namespace Modules\Creditnotes\Console;

use Illuminate\Console\Command;
use Modules\Creditnotes\Entities\CreditNote;

class CreditBalance extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'credits:balance {credit?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate creditnote balances';

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
        $id = $this->argument('credit');

        if ($id > 0) {
            $credit = CreditNote::findOrFail($id);
            $credit->unsetEventDispatcher();
            $credit->compute();
        } else {
            CreditNote::open()->chunk(
                200,
                function ($credits) {
                    foreach ($credits as $credit) {
                        $credit->unsetEventDispatcher();
                        $credit->compute();
                    }
                }
            );
        }
        $this->info('Credit balances calculated successfully');
    }
}
