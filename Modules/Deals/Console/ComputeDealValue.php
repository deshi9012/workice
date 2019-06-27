<?php

namespace Modules\Deals\Console;

use Illuminate\Console\Command;
use Modules\Deals\Entities\Deal;

class ComputeDealValue extends Command
{
    protected $deal;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'deals:value {deal?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Computes the deal value using deal currency.';

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
        $dealId = $this->argument('deal');
        if ($dealId > 0) {
            $deal = $this->deal->find($dealId);
            $deal->compute();
        } else {
            $this->deal->open()->chunk(
                200,
                function ($deals) {
                    foreach ($deals as $deal) {
                        $deal->compute();
                    }
                }
            );
        }

        $this->info('✔︎ Deal Values computed');
    }
}
