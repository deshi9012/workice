<?php

namespace Modules\Leads\Console;

use Illuminate\Console\Command;

class ComputeLeadStage extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'leads:calcstage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates totals for each lead stage.';

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
        \App\Entities\Category::leads()->chunk(
            200,
            function ($stages) {
                foreach ($stages as $stage) {
                    \App\Entities\Computed::updateOrCreate(
                        ['key' => 'leads_stage_' . $stage->id],
                        ['value' => $stage->leadsValue()]
                    );
                }
            }
        );

        $this->info('Lead Stages calculated successfully');
    }
}
