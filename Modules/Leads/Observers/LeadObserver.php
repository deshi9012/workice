<?php

namespace Modules\Leads\Observers;

use App\Entities\Category;
use Modules\Leads\Entities\Lead;

class LeadObserver
{
    /**
     * Listen to the Lead saving event.
     *
     * @param Lead $lead
     */
    public function saving(Lead $lead)
    {
        if (empty($lead->name) || $lead->name == '') {
            $lead->name = $lead->email;
        }
        $lead->stage_id = empty($lead->stage_id) ? get_option('default_lead_stage') : $lead->stage_id;
        if (!is_numeric($lead->stage_id)) {
            $stage          = Category::whereName($lead->stage)->whereModule('leads')->first();
            $lead->stage_id = $stage->id;
        }
        if (!is_numeric($lead->source)) {
            $source       = Category::firstOrCreate(['name' => $lead->source, 'module' => 'source'], ['color' => 'info']);
            $lead->source = $source->id;
        }
        $lead->sales_rep      = $lead->sales_rep <= 0 ? get_option('default_sales_rep') : $lead->sales_rep;
        $lead->computed_value = formatCurrency(get_option('default_currency'), parseCurrency($lead->lead_value));
    }

    public function creating(Lead $lead)
    {
        $lead->token         = genToken();
        $lead->next_followup = now()->addDays(get_option('lead_followup_days'));
        $lead->due_date      = empty($lead->due_date) ? now()->addDays(get_option('lead_expire_days')) : $lead->due_date;
        if (settingEnabled('leads_opt_in')) {
            $lead->unsubscribed_at = now()->toDateTimeString();
        }
    }

    /**
     * Listen to the Lead updated event.
     *
     * @param Lead $lead
     */
    public function saved(Lead $lead)
    {
        if (request()->has('tags')) {
            $lead->retag(collect(request('tags'))->implode(','));
        }
        \Artisan::queue('leads:calcstage');
        $lead->saveCustom(request('custom'));
    }

    /**
     * Listen to Lead deleting event.
     *
     * @param Lead $lead
     */
    public function deleting(Lead $lead)
    {
        $lead->comments()->each(
            function ($comment) {
                $comment->delete();
            }
        );

        $lead->custom()->each(
            function ($extra) {
                $extra->delete();
            }
        );

        $lead->emails()->each(
            function ($email) {
                $email->delete();
            }
        );
        $lead->calls()->each(
            function ($call) {
                $call->delete();
            }
        );

        $lead->activities()->each(
            function ($activity) {
                $activity->delete();
            }
        );
        $lead->notes()->each(
            function ($note) {
                $note->delete();
            }
        );
        $lead->schedules()->each(
            function ($event) {
                $event->delete();
            }
        );

        $lead->files()->each(
            function ($file) {
                $file->delete();
            }
        );
        $lead->todos()->each(
            function ($todo) {
                $todo->delete();
            }
        );

        $lead->detag();
    }
}
