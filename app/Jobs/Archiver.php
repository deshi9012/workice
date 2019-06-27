<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Archiver
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $arr;
    protected $module;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $arr, $module)
    {
        $this->arr = $arr;
        $this->module = $module;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach (classByName($this->module)->whereIn('id', $this->arr)->get() as $entity) {
            if (is_null($entity->archived_at)) {
                $entity->update(['archived_at' => now()->toDateTimeString()]);
            } else {
                $entity->update(['archived_at' => null]);
            }
        }
    }
}
