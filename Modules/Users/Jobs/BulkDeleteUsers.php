<?php

namespace Modules\Users\Jobs;

use App;
use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Users\Entities\User;
use Modules\Users\Events\UserDeleted;

class BulkDeleteUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Delete the job if its models no longer exist.
     *
     * @var bool
     */
    public $deleteWhenMissingModels = true;
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    public $arr;
    public $user_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $arr, $user)
    {
        $this->arr     = $arr;
        $this->user_id = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (App::runningInConsole() && $this->user_id && !App::runningUnitTests()) {
            Auth::onceUsingId($this->user_id);
        }
        foreach ($this->arr as $u) {
            $model = User::where('id', $u)->first();
            $model->delete();
            event(new UserDeleted($model, $this->user_id));
        }

        if (App::runningInConsole() && $this->user_id && !App::runningUnitTests()) {
            Auth::logout();
        }
    }
}
