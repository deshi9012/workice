<section class="panel panel-default">

<div class="table-responsive">
        <table class="table table-striped" id="tickets-table">
        <thead>
        <tr>
            <th class="hide"></th>
            <th>@langapp('subject')  </th>
            <th class="col-date">@langapp('date')  </th>
            <th>@langapp('priority')  </th>
            <th>@langapp('department')  </th>
            <th>@langapp('status')  </th>
        </tr>
        </thead>
        <tbody>

        @foreach ($user->tickets()->get() as $key => $ticket)
            <tr>
                <td class="display-none">{{ $ticket->id }}</td>
                <td>
                    <a href="{{ route('tickets.view', ['id' => $ticket->id]) }}">{{  $ticket->subject }}</a>
                </td>
                <td class="">{{  dateElapsed($ticket->created_at) }}</td>
                <td>
                      <span class="label label-{{ priorityColor($ticket->AsPriority->priority) }}"> {{  $ticket->AsPriority->priority  }}</span>
                </td>
                <td class="">{{ $ticket->dept->deptname }}</td>
                <td>
                    <span class="label label-default">{{  ucfirst($ticket->AsStatus->status)  }}</span>
                </td>

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
    var table = $('#tickets-table').DataTable({
        processing: true,
        order: [[ 0, "desc" ]],
    });

});
</script>
@endpush

</section>