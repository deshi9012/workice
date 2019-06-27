<div class="table-responsive">
    <table id="table-projects" class="table table-striped">
        <thead>
            <tr>
                <th>@langapp('title') </th>
                <th>@langapp('client') </th>
                <th>@langapp('amount') </th>
                <th>@langapp('expenses') </th>
                <th>@langapp('time_spent') </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            
            <tr>
                <td><a href="{{ route('projects.view', ['id' => $project->id]) }}">{{ $project->name }}</a></td>
                <td><a href="{{ route('clients.view', ['id' => $project->client_id]) }}">{{ optional($project->company)->name }}</a></td>
                <td class="text-semibold">{{ formatCurrency($project->currency, $project->sub_total) }}</td>
                <td class="text-semibold">{{ formatCurrency($project->currency, $project->total_expenses) }}</td>
                <td>{{ secToHours($project->billable_time) }}</td>
                
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
$('#table-projects').DataTable({
processing: true,
order: [[ 0, "desc" ]],
pageLength: 25
});
</script>
@endpush
@stack('pagestyle')
@stack('pagescript')