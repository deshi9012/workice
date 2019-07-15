<?php

namespace Modules\Leads\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Modules\Leads\Entities\Lead;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use DB;

class GetLoggedLeads implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct() {

//        $this->parcel = $parcel;
        //

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        $client = new Client();
        $loggedUsers = [];
        try {

            $headers = ['Content-Type' => 'application/json'];
            $res = $client->request('GET', 'https://thebrokersacademy.com/getLoggedUsers.php?authTokenCRM=ahrnJBuscD0Gi23l8iPO');
            $loggedUsers = json_decode($res->getBody(), 1);
            logger('---');
            logger($res->getBody());
            logger('---');

        } catch (ClientException $exception) {
            logger($exception);

        }



        DB::table('leads')
            ->update(['is_logged' => 0]);
        $loggedEmails = [];
        foreach ($loggedUsers as $loggedUser) {

            Lead::where('email', $loggedUser['user_email'])->update(['is_logged'=> 1, 'last_login' => $loggedUser['last_active_date']]);
        }


    }

    /**
     * The job failed to process.
     *
     * @param  Exception $exception
     * @return void
     */
    public function failed(Error $error = null) {

    }
}
