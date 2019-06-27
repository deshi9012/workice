<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class PostUpdateCleanup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'app:post-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to perform updates cleanups';
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->files->cleanDirectory('bootstrap/cache');
        $contents = '*' . PHP_EOL . '!.gitignore' . PHP_EOL;
        $this->files->put('bootstrap/cache/.gitignore', $contents);
        \Artisan::call('cache:clear');
        $this->info('Bootstrap cache cleaned successfully');
    }
}
