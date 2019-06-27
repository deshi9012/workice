<?php

namespace App\Console\Commands;

use App\Traits\DaemonWorkerTrait;
use Illuminate\Console\Command;
use Illuminate\Queue\Console\WorkCommand as BaseWorkCommand;
use Illuminate\Queue\Worker;

/**
 * Credits to https://github.com/orobogenius/sansdaemon
 */

class WorkCommand extends BaseWorkCommand
{
    use DaemonWorkerTrait;

    /**
     * Create a new queue work command.
     *
     * @param \Illuminate\Queue\Worker $worker
     *
     * @return void
     */
    public function __construct(Worker $worker)
    {
        if (!defined('LARAVEL_START')) {
            define('LARAVEL_START', microtime(true));
        }

        // Get default max execution time - 5s
        $maxExecutionTime = ini_get('max_execution_time');
        $maxExecutionTime = $maxExecutionTime <= 0 ? 0 : $maxExecutionTime - 5;

        $this->signature .= '{--workicedaemon : Run the worker without a daemon}
                             {--jobs=0 : Number of jobs to process before worker exits}
                             {--max_exec_time=' . $maxExecutionTime . ' : Maximum seconds to run to prevent error (0 - forever)}';

        $this->description .= ' or workice-daemon';

        parent::__construct($worker);
    }

    /**
     * Run the worker instance.
     *
     * @param  string $connection
     * @param  string $queue
     *
     * @return array
     */
    protected function runWorker($connection, $queue)
    {
        if ($this->option('workicedaemon')) {
            $this->worker->setCache($this->laravel['cache']->driver());

            return $this->runWorkiceDaemon($connection, $queue);
        }

        parent::runWorker($connection, $queue);
    }

    /**
     * Gather all of the queue worker options as a single object.
     *
     * @return \Illuminate\Queue\WorkerOptions
     */
    protected function gatherWorkerOptions()
    {
        $options                   = parent::gatherWorkerOptions();
        $options->jobs             = $this->option('jobs');
        $options->maxExecutionTime = intval($this->option('max_exec_time'));

        return $options;
    }
}
