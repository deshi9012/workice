<?php

namespace Modules\Analytics\Console;

use Illuminate\Console\Command;

class AnalyticsCompute extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'analytics:compute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compute all analytics data';

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
        $this->callSilent('analytics:credits');
        $this->callSilent('analytics:deals');
        $this->callSilent('analytics:estimates');
        $this->callSilent('analytics:expenses');
        $this->callSilent('analytics:invoices');
        $this->callSilent('analytics:leads');
        $this->callSilent('analytics:payments');
        $this->callSilent('analytics:projects');
        $this->callSilent('analytics:tasks');
        $this->callSilent('analytics:tickets');
        $this->callSilent('analytics:timesheets');

        $this->info('✔︎ Analytics reports calculated successfully');
    }
}
