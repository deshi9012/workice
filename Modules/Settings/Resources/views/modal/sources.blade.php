<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('source')  </h4>
        </div>
        {!! Form::open(['route' => 'settings.sources.save', 'class' => 'bs-example form-horizontal', 'id' => 'saveSource']) !!}
        <input type="hidden" name="module" value="source">
        <input type="hidden" name="color" value="info">
        <input type="hidden" name="active" value="1">

        <div class="modal-body">
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('source') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="e.g Facebook" name="name">
                </div>
            </div>
            <ul class="list-group gutter list-group-lg list-group-sp sortable" id="sourceList">

                @foreach ($sources as $source)
                    <li class="list-group-item" draggable="true" id="source-{{ $source->id }}">
                    <span class="pull-right">
                    <a href="{{ route('settings.sources.edit', $source->id) }}" data-toggle="ajaxModal" data-dismiss="modal">
                            @icon('solid/pencil-alt', 'icon-muted fa-fw m-r-xs')
                    </a>
                        <a href="#" class="deleteSource" data-source-id="{{ $source->id }}">
                            @icon('solid/times', 'icon-muted fa-fw')
                        </a>
                    </span>


                        <div class="clear">{{ $source->name }}</div>
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
        $('#saveSource').on('submit', function(e) {
            $(".formSaving").html('Processing..<i class="fas fa-spin fa-spinner"></i>');

            e.preventDefault();
            var tag, data;
            tag = $(this);
            data = tag.serialize();

            axios.post('{{ route('settings.sources.save') }}', data)
            .then(function (response) {
                $('#sourceList').append(response.data.html);
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


        $('body').on('click', '.deleteSource', function (e) {
            e.preventDefault();
            var tag, id;

            tag = $(this);
            id = tag.data('source-id');

            if(!confirm('Do you want to delete this message?')) {
                return false;
            }
            axios.post('{{ route('settings.sources.delete') }}', {
                "id":id
            })
            .then(function (response) {
                toastr.warning( response.data.message , '@langapp('response_status') ');
                $('#source-' + id).hide(500, function () {
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