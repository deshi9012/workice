<ul class="nav">

    @foreach ($user->invoices()->take(30) as $key => $invoice)

        <li class="b-b b-light {{ ($invoice->id == $inv->id) ? 'bg-light dk' : '' }}">

            <a href="{{ route('invoices.transactions', ['id' => $invoice->id]) }}">

                {{ ucfirst($invoice->company->name) }}
                <div class="pull-right">
                    {{ formatCurrency($invoice->currency, $invoice->due()) }}
                </div>
                <br>
                <small class="block small text-muted">{{ $invoice->reference_no }}
                    <span class="label label-success">@langapp($invoice->payment_status) </span>
                </small>
            </a>

        </li>
        @endforeach
</ul>
