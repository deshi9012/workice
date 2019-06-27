<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ComputeBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:balances';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Computes projects,estimates,invoices and client balances';

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
        $this->callSilent('invoices:balance');
        $this->callSilent('estimates:balance');
        $this->callSilent('expenses:balance');
        $this->callSilent('projects:balance');
        $this->callSilent('credits:balance');
        $this->callSilent('clients:balance');
        $this->info('✔︎ Balances calculated successfully');
    }
}
