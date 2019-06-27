<?php

namespace Modules\Estimates\Observers;

use Modules\Clients\Entities\Client;
use Modules\Estimates\Entities\Estimate;
use Modules\Estimates\Jobs\ComputeEstimate;

class EstimateObserver
{
    /**
     * Listen to the Estimate creating event.
     *
     * @param \Modules\Estimates\Entities\Estimate $estimate
     */
    public function creating(Estimate $estimate)
    {
        $estimate->reference_no = generateCode('estimates');
        if (!is_numeric($estimate->client_id)) {
            $estimate->client_id = Client::firstOrCreate(
                ['email' => $estimate->client_id],
                ['name' => $estimate->client_id]
            )->id;
        }
        if (empty($estimate->due_date)) {
            $estimate->due_date = now()->addDays(get_option('invoices_due_after', '15'));
        }
        $estimate->exchange_rate = xchangeRate($estimate->currency);
    }

    /**
     * Listen to the Estimate saved event.
     *
     * @param \Modules\Estimates\Entities\Estimate $estimate
     */
    public function saved(Estimate $estimate)
    {
        if (request()->has('tags')) {
            $estimate->retag(collect(request('tags'))->implode(','));
        }
        if ($estimate->deal_id > 0) {
            $estimate->deal->update(['currency' => $estimate->currency, 'deal_value' => $estimate->amount()]);
        }
        ComputeEstimate::dispatch($estimate)->onQueue('high');
        $estimate->saveCustom(request('custom'));
    }

    /**
     * Listen to the Estimate deleting event.
     *
     * @param \Modules\Estimates\Entities\Estimate $estimate
     */
    public function deleting(Estimate $estimate)
    {
        $estimate->items()->each(
            function ($item) {
                $item->delete();
            }
        );
        $estimate->activities()->each(
            function ($log) {
                $log->delete();
            }
        );

        $estimate->comments()->each(
            function ($comment) {
                $comment->delete();
            }
        );
    }
}
