<div class="table-responsive">
    <table id="table-deals" class="table table-striped">
        <thead>
            <tr>
                <th>@langapp('title') </th>
                <th>@langapp('organization') </th>
                <th>@langapp('source') </th>
                <th>@langapp('stage') </th>
                <th>@langapp('pipeline') </th>
                <th>@langapp('deal_value')</th>
                <th>@langapp('status') </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deals as $deal)
            <tr>
                <td><a href="{{ route('deals.view', ['id' => $deal->id]) }}">{{ str_limit($deal->title,25) }}</a></td>
                <td><a href="{{ route('clients.view', ['id' => $deal->organization]) }}">{{ str_limit($deal->company->name,25) }}</a></td>
                <td>{{ $deal->AsSource->name }}</td>
                <td>{{ $deal->category->name }}</td>
                <td>{{ $deal->pipe->name }}</td>
                <td>{{ $deal->computed_value }}</td>
                <td>{{ ucfirst($deal->status) }}</td>
                
            </tr>
            
            @endforeach
        </tbody>
    </table>
</div>

    @push('pagestyle')
        @include('stacks.css.datatables')
    @endpush

    @push('pagescript')
    @include('stacks.js.datatables')
    
    <script>
    $('#table-deals').DataTable({
        processing: true,
        order: [[ 0, "desc" ]],
        pageLength: 25
    });
    </script>
    @endpush

    @stack('pagestyle')
    @stack('pagescript')