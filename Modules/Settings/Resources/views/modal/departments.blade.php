<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{  langapp('department') }}</h4>
        </div>
        {!! Form::open(['route' => 'departments.save', 'class' => 'bs-example form-horizontal', 'id' => 'saveDepartment']) !!}
        
        <div class="modal-body">
            <div class="form-group">
                <label class="col-lg-4 control-label">{{ langapp('name') }} @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="Sales" name="deptname">
                </div>
            </div>

            

            <ul class="list-group gutter list-group-lg list-group-sp sortable" id="departmentList">

                @foreach ($departments as $department)
                <li class="list-group-item" draggable="true" id="department-{{ $department->deptid }}">
                    <span class="pull-right">
                    <a href="{{ route('departments.edit', $department->deptid) }}" data-toggle="ajaxModal" data-dismiss="modal">
                            @icon('solid/pencil-alt', 'icon-muted fa-fw m-r-xs')
                    </a>
                        <a href="#" class="deleteDepartment" data-department-id="{{ $department->deptid }}">
                            @icon('solid/times', 'icon-muted fa-fw')
                        </a>
                    </span>

                    <span class="pull-left media-xs">@icon('solid/arrows-alt', 'm-r-sm')</span>

                    <div class="clear">{{ $department->deptname }}</div>
                </li>
                @endforeach
                
                
            </ul>
        </div>
        <div class="modal-footer">

            {!! closeModalButton() !!}
            {!! renderAjaxButton('save') !!}

        </div>

    {!! Form::close() !!}
</div>

</div>

@push('pagescript')
    <script>
    $('#saveDepartment').on('submit', function(e) {
        $(".formSaving").html('Processing..<i class="fas fa-spin fa-spinner"></i>');

        e.preventDefault();
        var tag, data;
        tag = $(this);
        data = tag.serialize();


        axios.post('{{ route('departments.save') }}', data)
          .then(function (response) {
            $('#departmentList').append(response.data.html);
                toastr.info( response.data.message , '@langapp('response_status') ');
                $(".formSaving").html('<i class="fas fa-paper-plane"></i> @langapp('send') </span>');
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


    $('body').on('click', '.deleteDepartment', function (e) {
        e.preventDefault();
        var tag, id;

        tag = $(this);
        id = tag.data('department-id');

        if(!confirm('Do you want to delete this message?')) {
            return false;
        }

        axios.post('{{ route('departments.delete') }}', {
            "id":id
        })
          .then(function (response) {
                toastr.warning( response.data.message , '@langapp('response_status') ');
                $('#department-' + id).hide(500, function () {
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