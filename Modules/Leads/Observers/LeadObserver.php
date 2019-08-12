<?php

namespace Modules\Leads\Observers;

use App\Entities\Category;
use Modules\Leads\Entities\Lead;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Symfony\Component\HttpFoundation\Response;

class LeadObserver {
    /**
     * Listen to the Lead saving event.
     *
     * @param Lead $lead
     */
    public function saving(Lead $lead) {

//
        if (request()->isMethod('patch') && request()->has('stage_id')) {
            return true;

        }
        if (empty($lead->name) || $lead->name == '') {
            $lead->name = $lead->email;
        }
//        if (empty($lead->desk_id)) {
//            $lead->desk_id = 1;
//        }
        $lead->stage_id = empty($lead->stage_id) ? get_option('default_lead_stage') : $lead->stage_id;
        if (!is_numeric($lead->stage_id)) {
            $stage = Category::whereName($lead->stage)->whereModule('leads')->first();
            $lead->stage_id = $stage->id;
        }
        if (!is_numeric($lead->source)) {
            $source = Category::firstOrCreate([
                'name'   => $lead->source,
                'module' => 'source'
            ], ['color' => 'info']);
            $lead->source = $source->id;
        }
        $lead->sales_rep = $lead->sales_rep <= 0 ? get_option('default_sales_rep') : $lead->sales_rep;
        $lead->computed_value = formatCurrency(get_option('default_currency'), parseCurrency($lead->lead_value));
    }

    public function creating(Lead $lead) {

        $lead->token = genToken();
        $lead->next_followup = now()->addDays(get_option('lead_followup_days'));
        $lead->due_date = empty($lead->due_date) ? now()->addDays(get_option('lead_expire_days')) : $lead->due_date;
        if (settingEnabled('leads_opt_in')) {
            $lead->unsubscribed_at = now()->toDateTimeString();
        }
    }

    /**
     * Listen to the Lead updated event.
     *
     * @param Lead $lead
     */

    public function saved(Lead $lead) {
        if (request()->isMethod('patch') && request()->has('stage_id')) {

           $res = new Response();
           return $res->send();

        }
        if (request()->has('change_password')) {
            logger('password');

            logger(request()->all());
            $data['user_email'] = request()->all()['email'];
            $data['new_password'] = request()->all()['change_password'];

            $client = new Client();
            try {
                logger($data);
                $headers = ['Content-Type' => 'application/json'];
                $res = $client->request('POST', 'https://thebrokersacademy.com/changeUserPassword.php?authTokenCRM=ahrnJBuscD0Gi23l8iPO', [
                    'form_params' => $data
                ]);
                $resBody = json_decode($res->getBody(), 1);
                logger($resBody);

            } catch (ClientException $exception) {
                logger($exception);

            }

        }
        elseif(request()->has('converting')){

            if (request()->has('tags')) {
                $lead->retag(collect(request('tags'))->implode(','));
            }
            \Artisan::queue('leads:calcstage');
            $lead->saveCustom(request('custom'));
        }
        else {
            logger('asdfa');
            if (request()->has('tags')) {
                $lead->retag(collect(request('tags'))->implode(','));
            }
            \Artisan::queue('leads:calcstage');
            $lead->saveCustom(request('custom'));

            logger(request()->all());

            $tmpName = request()->all()['name'];

            $name = explode(' ', $tmpName);
            $data['first_name'] = $name[0];
            $data['last_name'] = $name[1];
            $data['phone'] = request()->all()['mobile'];
            $data['email'] = request()->all()['email'];
            $data['lang'] = request()->all()['language'];

            $client = new Client();
            try {
                logger('try');
//            $res = $client->request('post','https://thebrokersacademy.com/createuser.php?authTokenCRM=ahrnJBuscD0Gi23l8iPO', [
//                'headers' => [
//                    'Content-Type' => 'application/json'
//                ],
////                'auth'    => [
////                    '',
////                    null
////                ],
//                'json'    => $data
//            ]);
                logger($data);
                $headers = ['Content-Type' => 'application/json'];
                $res = $client->request('POST', 'https://thebrokersacademy.com/createuser.php?authTokenCRM=ahrnJBuscD0Gi23l8iPO', [
                    'form_params' => $data
                ]);

            } catch (\Exception $exception) {
                logger('exception');
                logger($exception);
            }
        }

    }

    /**
     * Listen to Lead deleting event.
     *
     * @param Lead $lead
     */
    public function deleting(Lead $lead) {
        $lead->comments()->each(function ($comment) {
            $comment->delete();
        });

        $lead->custom()->each(function ($extra) {
            $extra->delete();
        });

        $lead->emails()->each(function ($email) {
            $email->delete();
        });
        $lead->calls()->each(function ($call) {
            $call->delete();
        });

        $lead->activities()->each(function ($activity) {
            $activity->delete();
        });
        $lead->notes()->each(function ($note) {
            $note->delete();
        });
        $lead->schedules()->each(function ($event) {
            $event->delete();
        });

        $lead->files()->each(function ($file) {
            $file->delete();
        });
        $lead->todos()->each(function ($todo) {
            $todo->delete();
        });

        $lead->detag();
    }
}
