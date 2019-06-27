<section class="panel panel-default">
        <header class="panel-heading font-bold">@langapp('deals') <span class="text-danger">({{ count($deals) }})</span></header>

<div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>@langapp('title') </th>
                    <th>@langapp('deal_value') </th>
                    <th>@langapp('pipeline') </th>
                    <th>@langapp('stage') </th>
                    <th>@langapp('organization') </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deals->take(10) as $deal)

                <tr>
                        <td><a href="{{ route('deals.view', ['id' => $deal->id]) }}">{{ $deal->title }}</a></td>
                        <td>{{ $deal->computed_value }}</td>
                        <td>{{ $deal->pipe->name }}</td>
                        <td><span class="badge bg-default">{{ $deal->category->name }}</span></td>
                        <td><a href="{{ route('clients.view', ['id' => $deal->organization]) }}">{{ $deal->company->name }}</a></td>
                    </tr>
                    
                @endforeach
                
               
            </tbody>
        </table>
    </div>

</section>