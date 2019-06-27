<?php

namespace Modules\Deals\Console;

use App\Entities\Computed;
use Illuminate\Console\Command;
use Modules\Deals\Entities\Deal;
use Modules\Settings\Jobs\SetupChk;

class ComputeSalesVelocity extends Command
{
    protected $deal;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'deals:velocity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates the average time a deal takes all the way through your pipeline.';

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
        $this->deal->won()->chunk(
            200,
            function ($deals) {
                foreach ($deals as $deal) {
                    $deal->update(
                        [
                            'days_to_close' => dateParser($deal->won_time)->diffInDays($deal->created_at),
                        ]
                    );
                }
            }
        );
        Computed::updateOrCreate(
            ['key' => 'conversion-rate'],
            ['value' => $this->deal->count() > 0 ? (($this->deal->won()->count() / $this->deal->count()) * 100) : 0]
        );
        Computed::updateOrCreate(
            ['key' => 'sales-velocity'],
            ['value' => round($this->deal->won()->avg('days_to_close'))]
        );
        SetupChk::dispatch()->onQueue('low');
        $this->info('✔︎ Sales velocity calculated successfully');
    }
}
