<?php

namespace Modules\Settings\Jobs;

use Crypt;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Log;
use Storage;

class SetupChk implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;
    public $timeout = 30;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (Storage::exists('verified.json')) {
            try {
                if (urlAccessible($this->getEndPoint()) && !isDemo()) {
                    $l = json_decode(Crypt::decryptString(Storage::get('verified.json')));
                    $this->query($l->purchase_code);
                }
            } catch (Exception $e) {
                $this->shutDown();
                Log::error($e->getMessage());
            }
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
