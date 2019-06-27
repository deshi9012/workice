<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Users\Entities\User;

class GdprDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:gdpr-delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to permanently delete user accounts';

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
        foreach (User::onlyTrashed()->whereDate('deleted_at', '<', now()->subDays(3))->get() as $user) {
            $user->forceDelete();
        }
    }
}
