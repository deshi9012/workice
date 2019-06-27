<div class="table-responsive">
    <table id="table-ratings" class="table table-striped">
        <thead>
            <tr>
                <th>@langapp('name')</th>
                <th>@langapp('ticket')</th>
                <th>@langapp('date')</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ratings as $rating)
            <tr>
                <td>
                    <span class="thumb-xs avatar">
                        <img src="{{ $rating->user->profile->photo }}" class="img-circle">
                    </span>
                    <a href="#" class="">{{ $rating->user->name }}</a>
                </td>
                <td>{{ $rating->reviewable->subject }}</td>
                <td>{{ $rating->created_at->diffForHumans() }}</td>
                <td>{!! $rating->satisfied === 1 ? '<i class="fas fa-star text-success"></i> Great' : '<i class="far fa-star text-danger"></i> Bad' !!}</td>
                
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
$('#table-ratings').DataTable({
processing: true,
order: [[ 0, "desc" ]],
pageLength: 25
});
</script>
@endpush
@stack('pagestyle')
@stack('pagescript')