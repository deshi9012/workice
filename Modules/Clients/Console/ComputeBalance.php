<?php

namespace Modules\Clients\Console;

use Illuminate\Console\Command;
use Modules\Clients\Entities\Client;

class ComputeBalance extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'clients:balance {client?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate client balances';

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
        $id = $this->argument('client');
        if ($id > 0) {
            $client = Client::find($id);
            $client->unsetEventDispatcher();
            $client->compute();
        //$client->reCalculate();
        } else {
            Client::chunk(
                200,
                function ($clients) {
                    foreach ($clients as $client) {
                        $client->unsetEventDispatcher();
                        $client->compute();
                    }
                }
            );
        }
        $this->info('Client balances calculated successfully');
    }
}
