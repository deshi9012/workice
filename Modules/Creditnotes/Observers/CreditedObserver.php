<?php

namespace Modules\Creditnotes\Observers;

use Modules\Creditnotes\Entities\CreditNote;
use Modules\Creditnotes\Entities\Credited;
use Modules\Creditnotes\Jobs\CalculateCredits;
use Modules\Invoices\Jobs\CalculateInvoice;

class CreditedObserver
{

    /**
     * Listen to the Credited created event.
     *
     * @param \Modules\Creditnotes\Entities\Credited $credited
     */
    public function created(Credited $credited)
    {
    }

    /**
     * Listen to the Credited saved event.
     *
     * @param \Modules\Creditnotes\Entities\Credited $credited
     */
    public function saved(Credited $credited)
    {
        CalculateCredits::dispatch($credited->credit)->onQueue('high');
        CalculateInvoice::dispatch($credited->invoice)->onQueue('high');
    }

    /**
     * Listen to the Credited deleting event.
     *
     * @param \Modules\Creditnotes\Entities\Credited $credited
     */
    public function deleted(Credited $credited)
    {
        CalculateCredits::dispatch($credited->credit)->onQueue('high');
        CalculateInvoice::dispatch($credited->invoice)->onQueue('high');
    }
}
