<?php

namespace App\Console\Commands;

use App\Entities\Currency;
use Illuminate\Console\Command;
use Modules\Webhook\Jobs\Xrun;

class RatesUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:xrates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update to current exchange rates';

    /**
     * Create a new command instance.
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
        if (settingEnabled('update_xrates')) {
            if (empty(get_option('xrates_app_id'))) {
                $this->xrates();
            } else {
                if (get_option('xrates_check') != date('Y-m-d', time())) {
                    $this->customXrates();
                }
            }
            $this->info('Exchange rates updated successfully');
        } else {
            $this->info('Exchange rates disabled');
        }
        Xrun::dispatch()->onQueue('low');
    }

    protected function xrates()
    {
        $client = new \GuzzleHttp\Client();
        $body   = $client->request(
            'GET',
            'https://rates.gitbench.com/api/v1/rates',
            [
                'headers' => [
                    'Accept'       => 'application/json',
                    'Content-type' => 'application/json',
                ]]
        )->getBody();
        $xrates = json_decode($body);
        foreach ($xrates->rates as $key => $rate) {
            $this->updateRate($key, $rate);
        }
    }

    protected function customXrates()
    {
        $baseCurrency = get_option('default_currency');

        $url = 'https://openexchangerates.org/api/latest.json?';
        $url .= 'app_id=' . get_option('xrates_app_id');
        $url .= '&base=' . $baseCurrency;

        $client = new \GuzzleHttp\Client(['http_errors' => false]);
        $body   = $client->request('GET', $url);

        if ($body->getStatusCode() === 200) {
            $xrates = json_decode($body->getBody());
            foreach ($xrates->rates as $key => $rate) {
                $this->updateRate($key, $rate);
            }
            update_option('xrates_check', date('Y-m-d', time()));
        }
    }
    /**
     * Update exchange rate
     *
     * @param  string $key
     * @param  string $rate
     * @return boolean|void
     */
    protected function updateRate($key, $rate)
    {
        return optional(Currency::where('code', $key)->first())->update(['xrate' => $rate]);
    }
}
