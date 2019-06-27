<?php

namespace Modules\Items\Observers;

use Modules\Estimates\Entities\Estimate;
use Modules\Items\Entities\Item;

class ItemObserver
{
    /**
     * Listen to the Item creating event.
     *
     * @param Item $item
     */
    public function saving(Item $item)
    {
        $subTotal         = $item->unit_cost * $item->quantity;
        $itemTaxTotal     = formatDecimal(($item->tax_rate / 100) * $subTotal);
        $total            = $subTotal + (float) $itemTaxTotal;
        $item->tax_total  = $itemTaxTotal;
        $item->total_cost = formatDecimal($total - (($item->discount / 100) * $total));
    }

    /**
     * Listen to the Item saved event.
     *
     * @param Item $item
     */
    public function saved(Item $item)
    {
        $item->itemable_id > 0 ? $item->itemable->startComputeJob() : '';
        if ($item->itemable_type === Estimate::class) {
            if ($item->itemable->deal_id > 0) {
                $item->itemable->deal->update(['currency' => $item->itemable->currency, 'deal_value' => $item->itemable->amount]);
            }
        }
    }

    /**
     * Listen to the Item deleting event.
     *
     * @param Item $item
     */
    public function deleted(Item $item)
    {
        $item->itemable_id > 0 ? $item->itemable->startComputeJob() : '';
        if ($item->itemable_type === Estimate::class) {
            if ($item->itemable->deal_id > 0) {
                $item->itemable->deal->update(['currency' => $item->itemable->currency, 'deal_value' => $item->itemable->amount]);
            }
        }
    }
}
