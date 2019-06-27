<?php

namespace App\Helpers;

use App\Entities\Currency;

class CurrencyConverter
{
    protected $currencies;

    public function __construct()
    {
        $this->currencies = currencies();
    }
    /**
     * Apply corrent currency format
     */
    public function toCurrency($currency, $amount)
    {
        $commonCur = ['USD', 'EUR', 'GBP', 'INR'];
        if (in_array($currency, $commonCur)) {
            return $this->formatCommonCurrencies($currency, $amount);
        }
        $cur = array_first(
            $this->currencies,
            function ($item) use ($currency) {
                return $item['code'] == $currency;
            }
        );
        $cur_before    = $cur['native'] . '';
        $cur_after     = '';
        $space_between = $cur['space_between'] == '1' ? ' ' : '';
        if ($cur['symbol_left'] == '1') {
            $cur_before = $cur['native'] . $space_between;
            $cur_after  = $space_between;
        }
        if ($cur['symbol_left'] == '0') {
            $cur_before = $space_between;
            $cur_after  = $space_between . $cur['native'];
        }

        return $cur_before . number_format($amount, $cur['exp'], $cur['decimal_sep'], $cur['thousands_sep']) . $cur_after;
    }

    public function convert($from, $amount, $to = null, $xrate = null)
    {
        if (empty($from)) {
            return $amount;
        }
        // Use default currency if no target currency
        $cr = is_null($to) ? get_option('default_currency') : $to;
        if ($from == $cr) {
            return $amount;
        }
        $cur = array_first(
            $this->currencies,
            function ($item) use ($cr) {
                return $item['code'] == $cr;
            }
        );
        // Use model xrate if present
        $rate = is_null($xrate) ? $cur['xrate'] : $xrate;
        if (isset($cur['xrate'])) {
            $in_local_cur = $amount / $rate;
            // If xrate specified, use model xrate
            if (!is_null($xrate)) {
                return $in_local_cur;
            }
            $xr = array_first(
                $this->currencies,
                function ($item) use ($from) {
                    return $item['code'] == $from;
                }
            );
            // Use current xrates
            $in_local = $amount / $xr['xrate'];
            return $in_local;
            // return $amount * $cur->xrate;
        }
        return $amount;
    }

    // Get by currency code or fetch all
    public function fetch($code)
    {
        if (!$code) {
            return Currency::all();
        }
        $cur = Currency::where('code', $code)->first();
        if (count($cur) > 0) {
            return $cur;
        }
        $cur = Currency::where('code', get_option('default_currency'))->first();
        if (count($cur) > 0) {
            return $cur;
        }

        return false;
    }
    /**
     * Format common currencies to improve performance
     */
    public function formatCommonCurrencies($currency, $amount)
    {
        switch ($currency) {
            case 'USD':
                return '$' . number_format($amount, 2, '.', ',');
                break;
            case 'GBP':
                return '£' . number_format($amount, 2, '.', ',');
                break;
            case 'EUR':
                return number_format($amount, 2, ',', '.') . ' €';
                break;
            case 'INR':
                return '₹' . number_format($amount, 2, '.', ',');
                break;
        }
    }
}
