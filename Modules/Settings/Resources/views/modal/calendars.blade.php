<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('calendars')</h4>
        </div>
        {!! Form::open(['route' => 'settings.calendars.save', 'class' => 'bs-example form-horizontal', 'id' => 'saveCalendar']) !!}
        

        <div class="modal-body">
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('name') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="e.g Work" name="name">
                </div>
            </div>
            <ul class="list-group gutter list-group-lg list-group-sp sortable" id="calendarList">

                @foreach ($calendars as $calendar)
                    <li class="list-group-item" draggable="true" id="calendar-{{ $calendar->id }}">
                    <span class="pull-right">
                    <a href="{{ route('settings.calendars.edit', $calendar->id) }}" data-toggle="ajaxModal" data-dismiss="modal">
                            @icon('solid/pencil-alt', 'icon-muted fa-fw m-r-xs')
                    </a>
                        <a href="#" class="deleteCalendar" data-calendar-id="{{ $calendar->id }}">
                            @icon('solid/times', 'icon-muted fa-fw')
                        </a>
                    </span>


                        <div class="clear">{{ $calendar->name }}</div>
                    </li>
                @endforeach


            </ul>
        </div>
        <div class="modal-footer">
            {!! closeModalButton() !!}
            {!! renderAjaxButton() !!}
        </div>
        {!! Form::close() !!}
    </div>

</div>

@push('pagescript')
<script>
        $('#saveCalendar').on('submit', function(e) {
            $(".formSaving").html('Processing..<i class="fas fa-spin fa-spinner"></i>');

            e.preventDefault();
            var tag, data;
            tag = $(this);
            data = tag.serialize();

            axios.post('{{ route('settings.calendars.save') }}', data)
            .then(function (response) {
                $('#calendarList').append(response.data.html);
                toastr.success( response.data.message , '@langapp('response_status') ');
                $(".formSaving").html('<i class="fas fa-paper-plane"></i> @langapp('save') </span>');
                tag[0].reset();
          })
          .catch(function (error) {
            var errors = error.response.data.errors;
            var errorsHtml= '';
            $.each( errors, function( key, value ) {
                errorsHtml += '<li>' + value[0] + '</li>'; 
            });
            toastr.error( errorsHtml , '@langapp('response_status') ');
            $(".formSaving").html('<i class="fas fa-sync"></i> Try Again</span>');
        });

        });


        $('body').on('click', '.deleteCalendar', function (e) {
            e.preventDefault();
            var tag, id;

            tag = $(this);
            id = tag.data('calendar-id');

            if(!confirm('Do you want to delete this message?')) {
                return false;
            }
            axios.post('{{ route('settings.calendars.delete')}}', {
                "id":id
            })
            .then(function (response) {
                toastr.warning( response.data.message , '@langapp('response_status') ');
                $('#calendar-' + id).hide(500, function () {
                    $(this).remove();
                });
              })
              .catch(function (error) {
                    toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
            });
        });

</script>

@endpush

@stack('pagescript')