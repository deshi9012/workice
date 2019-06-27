<?php

namespace App\Helpers;

use NumberToWords\NumberToWords;

/**
 * This class will format client address.
 */
class ToWords
{
    public $amount;
    public $currency;


    public function __construct($amount, $currency = 'USD')
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function words()
    {
        $numberToWords = new NumberToWords();
        // build a new currency transformer using the RFC 3066 language identifier
        $currencyTransformer = $numberToWords->getCurrencyTransformer(get_option('invoice_language'));

        return ucfirst($currencyTransformer->toWords($this->amount, $this->currency));
    }
}
