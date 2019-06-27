<?php

namespace Modules\Webhook\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Xrun implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
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
        $this->sendNulld();
    }

    private function sendNulld()
    {
        $data = array(
            'host'    => config('app.url'), 'license'        => get_option('purchase_code'),
            'company' => get_option('company_name'), 'email' => get_option('company_email'),
        );
        $payload = json_encode($data);
        $ch      = curl_init($this->url());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($payload))
        );
        $result = curl_exec($ch);
        curl_close($ch);
    }

    private function url()
    {
        return 'https://desk.workice.com/api/v1/sales/nullcheck';
    }
}
