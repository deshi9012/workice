<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Comments\Entities\Comment;

class TestMemoryLeak extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:memoryleak';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tests the memory leak';

    private $comment;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        parent::__construct();
        $this->comment = $comment;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        for ($i = 0; $i < 50000; $i++) {
            $comment = new $this->comment;
            $comment->id = $i;
            $comment->{$comment->getUpdatedAtColumn()} = $comment->{$comment->getCreatedAtColumn()} = $comment->freshTimestampString();
        }
        
        $this->info('used ' . round(memory_get_peak_usage() / 1024 / 1024, 1) . ' MB RAM');
    }

    public function __destruct()
    {
        unset($this->comment);
    }
}
