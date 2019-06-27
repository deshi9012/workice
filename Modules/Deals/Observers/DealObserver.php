<?php

namespace Modules\Deals\Observers;

use App\Entities\Category;
use Auth;
use Modules\Clients\Entities\Client;
use Modules\Deals\Entities\Deal;
use Modules\Users\Entities\User;

class DealObserver
{

    /**
     * Listen to the Deal creating event.
     *
     * @param Deal $deal
     */
    public function creating(Deal $deal)
    {
        if (!request()->has('user_id')) {
            $deal->user_id = Auth::check() ? Auth::id() : 1;
        }
    }

    /**
     * Listen to the Deal saving event.
     *
     * @param Deal $deal
     */
    public function saving(Deal $deal)
    {
        if (!is_numeric($deal->stage_id)) {
            $stage          = Category::whereName($deal->stage)->deals()->first();
            $deal->stage_id = isset($stage->id) ? $stage->id : get_option('default_deal_stage');
        }
        if (!is_numeric($deal->source)) {
            $source       = Category::firstOrCreate(['name' => $deal->source, 'module' => 'source'], ['color' => 'info']);
            $deal->source = $source->id;
        }
        if (!is_numeric($deal->pipeline)) {
            $pipeline       = Category::whereName($deal->pipeline)->whereModule('pipeline')->first();
            $deal->pipeline = isset($pipeline->id) ? $pipeline->id : get_option('default_deal_pipeline');
        }
        if (!is_numeric($deal->organization)) {
            $deal->organization = Client::firstOrCreate(
                ['name' => $deal->organization],
                ['code' => generateCode('clients')]
            )->id;
        }
        if (!is_numeric($deal->contact_person)) {
            $deal->contact_person = optional(User::whereEmail($deal->contact_person)->first())->id;
        }
        $deal->computed_value = formatCurrency($deal->currency, parseCurrency($deal->deal_value));
    }

    /**
     * Listen to the Deal updated event.
     *
     * @param Deal $deal
     */
    public function saved(Deal $deal)
    {
        if (request()->has('tags')) {
            $deal->retag(collect(request('tags'))->implode(','));
        }
        $deal->saveCustom(request('custom'));
        \Artisan::queue('deals:calcstage');
        !\App::runningUnitTests() ? $deal->startComputeJob() : '';
    }

    /**
     * Listen to Deal deleting event.
     *
     * @param Deal $deal
     */
    public function deleting(Deal $deal)
    {
        $deal->comments()->each(
            function ($comment) {
                $comment->delete();
            }
        );

        $deal->custom()->each(
            function ($extra) {
                $extra->delete();
            }
        );

        $deal->emails()->each(
            function ($email) {
                $email->delete();
            }
        );

        $deal->calls()->each(
            function ($email) {
                $call->delete();
            }
        );

        $deal->activities()->each(
            function ($activity) {
                $activity->delete();
            }
        );
        $deal->notes()->each(
            function ($note) {
                $note->delete();
            }
        );
        $deal->schedules()->each(
            function ($event) {
                $event->delete();
            }
        );

        $deal->files()->each(
            function ($file) {
                $file->delete();
            }
        );
        $deal->todos()->each(
            function ($todo) {
                $todo->delete();
            }
        );

        $deal->detag();
    }
}
