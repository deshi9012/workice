<div class="table-responsive">
    <table id="table-timesheet" class="table table-striped">
        <thead>
            <tr>
                <th>@langapp('team_member') </th>
                <th>@langapp('name') </th>
                <th>@langapp('time_spent') </th>
                <th>@langapp('date') </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entries as $entry)
            
            <tr>
                <td><a href="{{ route('users.view', ['id' => $entry->user_id, 'tab' => 'timesheet']) }}">{{ $entry->user->name }}</a></td>
                <td><a href="{{ $entry->url }}">{{ optional($entry->timeable)->name }}</a></td>
                <td class="text-semibold">{{ secToHours($entry->worked) }}</td>
                <td>{{ dateTimeFormatted($entry->created_at) }}</td>
                
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
$('#table-timesheet').DataTable({
processing: true,
order: [[ 0, "desc" ]],
pageLength: 25
});
</script>
@endpush
@stack('pagestyle')
@stack('pagescript')