@if (in_array($currency, config('system.supported_currency_words')))
<p class="text-bold">
    {{  toWords($amount, $currency)  }}
</p>
@endif
