<div class="table-responsive">
    <table id="table-leads" class="table table-striped">
        <thead>
            <tr>
                <th>@langapp('name') </th>
                <th>@langapp('source')</th>
                <th>@langapp('stage')</th>
                <th>@langapp('organization')</th>
                <th>@langapp('lead_value')</th>
                <th>@langapp('email') </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leads as $lead)
            <tr>
                <td><a href="{{ route('leads.view', ['id' => $lead->id]) }}">{{ str_limit($lead->name, 25) }}</a></td>
                <td>{{ $lead->AsSource->name }}</td>
                <td>{{ $lead->status->name }}</td>
                <td>{{ str_limit($lead->company, 25) }}</td>
                <td>{{ $lead->lead_value }}</td>
                <td><a href="{{ route('leads.view', ['id' => $lead->id, 'tab' => 'compose']) }}">{{ $lead->email }}</a></td>

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
$('#table-leads').DataTable({
processing: true,
order: [[ 0, "desc" ]],
pageLength: 25
});
</script>
@endpush
@stack('pagestyle')
@stack('pagescript')