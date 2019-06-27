<section class="panel panel-default">
        <header class="panel-heading font-bold">@langapp('expenses') <span class="text-danger">({{ count($expenses) }})</span></header>

<div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>@langapp('date') </th>
                    <th>@langapp('code')</th>
                    <th>@langapp('category') </th>
                    <th>@langapp('client') </th>
                    <th>@langapp('amount') </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($expenses->take(15) as $expense)

                <tr>
                        <td>{{ dateFormatted($expense->created_at) }}</td>
                        <td><a href="{{ route('expenses.view', ['id' => $expense->id]) }}" data-rel="tooltip" title="{{ $expense->notes }}">{{ $expense->code }}</a></td>
                        <td><span class="label label-default">{{ $expense->AsCategory->name }}</span></td>
                        <td><a href="{{ route('clients.view', ['id' => $expense->client_id]) }}">{{ $expense->company->name }}</a></td>
                        <td class="text-semibold">{{ formatCurrency($expense->currency, $expense->cost) }}</td>
                    </tr>
                    
                @endforeach
                
               
            </tbody>
        </table>
    </div>

</section>