<?php

namespace Modules\Estimates\Console;

use Illuminate\Console\Command;
use Modules\Estimates\Entities\Estimate;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CalculateBalance extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'estimates:balance {estimate?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate estimate costs';

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
        $id = $this->argument('estimate');

        if ($id > 0) {
            $estimate = Estimate::findOrFail($id);
            $estimate->unsetEventDispatcher();
            $estimate->compute();
        } else {
            Estimate::pending()->chunk(
                200,
                function ($estimates) {
                    foreach ($estimates as $estimate) {
                        $estimate->unsetEventDispatcher();
                        $estimate->compute();
                    }
                }
            );
        }
        $this->info('Estimate costs calculated successfully');
    }
}
