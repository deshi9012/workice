<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class QueueMonitor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:queue-monitor';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monitors the queue worker and restart it if it fails';
    /**
     * The path to store the command output
     *
     * @var string
     */
    private $logFile;
    /**
     * Artisan file path
     *
     * @var string
     */
    private $artisan;
    /**
     * Horizon queue flag
     *
     * @var bool
     */
    private $isHorizon = false;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->logFile = storage_path('logs/queue-worker.log');
        $this->artisan = base_path('artisan');
        $this->isHorizon = 'horizon' === config('queue.default');
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $command =  $this->isHorizon ?
        $this->horizonQueueWorker() :
        $this->defaultQueueWorker();
        $ioStream = `ps -C php -o args h | grep '$command'`;
        $processes = collect(explode("\n", $ioStream))->filter();
        // If the process is not running start the queue worker
        if ($processes->count() === 0) {
            // If the worker is default append some flags
            $command = $this->isHorizon ? $command : $command.' --sleep 3 --tries 3 --timeout 300';
            // Execute the command in backgroung
            `$command > {$this->logFile} &`;
        }
    }
    /**
     * The default queue worker command
     *
     * @return string
     **/
    protected function defaultQueueWorker()
    {
        return "php {$this->artisan} queue:work --queue=default,high,normal,low";
    }
    /**
     * Get horizon command
     *
     * @return string
     **/
    protected function horizonQueueWorker()
    {
        return "php {$this->artisan} horizon";
    }
}
