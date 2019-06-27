<section class="panel panel-default">

    @widget('Users\BusyChart', ['user' => $user->id])

<div class="table-responsive">
        <table class="table table-striped" id="entries-table">
            
        <thead>
        <tr>
            <th class="hide"></th>
            <th>@langapp('name')</th>
            <th class="col-date">@langapp('start')</th>
            <th class="col-date">@langapp('stop')</th>
            <th>@langapp('time_spent')</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($user->timesheet as $key => $timer)
            <tr>
                <td class="display-none">{{$timer->id}}</td>
                <td><a href="{{ $timer->url }}" data-toggle="ajaxModal">{{ $timer->timeable->name }}</a></td>
                <td class="">
                    @if ($timer->start > 0)
                        {{ dateFromUnix($timer->start) }}
                    @endif
                </td>
                <td class="">
                    @if ($timer->end > 0)
                        {{ dateFromUnix($timer->end) }}
                    @endif
                </td>

                <td class="text-dark">{{ secToHours($timer->worked) }}</td>


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
$(function() {
    var table = $('#entries-table').DataTable({
        processing: true,
        order: [[ 0, "desc" ]],
    });

});
</script>
@endpush

</section>