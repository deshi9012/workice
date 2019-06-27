@if ($invoice->getOriginal('status') != 'fully_paid')

<div class="btn-group">
    <button class="btn btn-sm btn-{{  get_option('theme_color')  }} dropdown-toggle"
            data-toggle="dropdown">@langapp('pay_invoice') <span class="caret"></span></button>
    <ul class="dropdown-menu">
        @foreach (explode(',', get_option('enabled_gateways')) as $gateway)
            <li><a href="{{ route('payments.pay', ['id' => $invoice->id, 'gateway' => $gateway])  }}" data-toggle="ajaxModal"
                   title="Pay using {{ ucfirst($gateway) }}">@icon('solid/angle-right', 'text-success') {{ ucfirst($gateway) }}</a>
            </li>
        @endforeach
    </ul>
</div>

@endif
