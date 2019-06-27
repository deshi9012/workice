<div class="table-responsive">

    <table id="table-agents" class="table table-striped">
        <thead>
            <tr>
                <th>@langapp('name')</th>
                <th>@langapp('comments')</th>
                <th>@langapp('resolved')</th>
                <th>@langapp('feedback')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agents as $agent)
            <tr>
                <td>
                    <span class="thumb-xs avatar">
                        <img src="{{ $agent->profile->photo }}" class="img-circle">
                    </span>
                    <a href="#" class="">{{ $agent->name }}</a>
                </td>
                <td class="text-bold">{{ $agent->ticketReplies($range) }}</td>
                <td class="text-bold">{{ $agent->ticketResolved($range) }}</td>
                <td class="text-bold">{{ percent($agent->ticketRating()) }}%</td>
                
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
    $('#table-agents').DataTable({
        processing: true,
        order: [[ 0, "desc" ]],
        pageLength: 25
    });
</script>
@endpush
@stack('pagestyle')
@stack('pagescript')