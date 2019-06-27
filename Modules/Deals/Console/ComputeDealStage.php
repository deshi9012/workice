<?php

namespace Modules\Deals\Console;

use Illuminate\Console\Command;

class ComputeDealStage extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'deals:calcstage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates total for each deal stage';

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
        \App\Entities\Category::deals()->chunk(
            200,
            function ($stages) {
                foreach ($stages as $stage) {
                    \App\Entities\Computed::updateOrCreate(
                        ['key' => 'deals_stage_' . $stage->id],
                        ['value' => $stage->totalValue()]
                    );
                }
            }
        );

        $this->info('✔︎ Deal Stages calculated successfully');
    }
}
