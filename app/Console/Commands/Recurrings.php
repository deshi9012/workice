<?php

namespace App\Console\Commands;

use App\Entities\Recurring;
use Illuminate\Console\Command;
use Modules\Settings\Jobs\SetupChk;

class Recurrings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:recurring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process recurring models';
    /**
     * Recurring model
     *
     * @var \App\Entities\Recurring
     */
    protected $recurring;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->recurring = new Recurring;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->recurring->recurrings() as $recur) {
            $newEntity                = $recur->recurrable->replicate();
            $newEntity->recurred_from = $recur->recurrable->id;
            $newEntity->save();
            if (isset($newEntity->items)) {
                foreach ($recur->recurrable->items as $item) {
                    $newEntity->items()->create(array_except($item->toArray(), ['id']));
                }
            }

            $recur->recurrable->recurring()->update(
                [
                    'next_recur_date' => nextRecurringDate($recur->next_recur_date, $recur->frequency),
                ]
            );
            $newEntity->retag($recur->recurrable->tagList);
            $newEntity->recurred();
        }
        SetupChk::dispatch()->onQueue('low')->delay(now()->addMinutes(1));
        $this->info('Recurrings processed successfully');
    }
}
