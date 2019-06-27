<?php

namespace App\Console\Commands;

use Crypt;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Storage;

class SysChk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:license';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check application license';

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
        if (urlAccessible($this->getEndPoint()) && !isDemo()) {
            try {
                $this->query(get_option('purchase_code'));
            } catch (Exception $e) {
                $this->shutDown();
            }
            $this->info('Purchase verified successfully');
        } else {
            $this->error('Server unreachable or demo activated');
        }
    }

    private function query($code)
    {
        $client   = new Client();
        $response = $client->get($this->getEndPoint() . '?code=' . $code);
        $response = collect(json_decode($response->getBody()->getContents()));
        if ($response->has('error')) {
            $this->shutDown();
            return false;
        }
        if ($response->has('item_id')) {
            return $this->turnOn($response);
        }
        $this->shutDown();
        return false;
    }
    private function turnOn(Collection $response)
    {
        return Storage::put('verified.json', Crypt::encryptString($response->toJson()));
    }

    private function shutDown()
    {
        if (Storage::exists('verified.json')) {
            Storage::delete('verified.json');
        }
    }

    private function getEndPoint()
    {
        return 'https://sales.gitbench.com/verify';
    }
}
