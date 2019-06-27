<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('category')  </h4>
        </div>
        
        {!! Form::open(['route' => 'kb.category.save', 'class' => 'bs-example form-horizontal', 'id' => 'saveCategory']) !!}
        
        <input type="hidden" name="module" value="knowledgebase">
        <input type="hidden" name="color" value="info">
        <input type="hidden" name="active" value="1">
        
        <div class="modal-body">
            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('name') @required </label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" placeholder="Getting Started" name="name">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('description') @required</label>
                <div class="col-lg-9">
                <input type="text" class="form-control" placeholder="Beginners guide" name="description">
                </div>
            </div>

            <ul class="list-group gutter list-group-lg list-group-sp sortable" id="categoryList">

                @foreach ($categories as $category)
                <li class="list-group-item" draggable="true" id="cat-{{ $category->id }}">
                    <span class="pull-right">
                    <a href="{{ route('kb.category.edit', ['id' => $category->id]) }}" data-toggle="ajaxModal" data-dismiss="modal">
                            @icon('solid/pencil-alt', 'icon-muted fa-fw m-r-xs')
                    </a>
                        <a href="#" class="deleteCategory" data-cat-id="{{ $category->id }}">
                            @icon('solid/times', 'icon-muted fa-fw')
                        </a>
                    </span>

                    <span class="pull-left media-xs">@icon('solid/arrows-alt', 'm-r-xs')</span>

                    <div class="clear">{{ $category->name }} </div>
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

    $('#saveCategory').on('submit', function(e) {
        $(".formSaving").html('Processing..<i class="fas fa-spin fa-spinner"></i>');

        e.preventDefault();
        var tag, data;

        tag = $(this);
        data = tag.serialize();

        axios.post('{{ route('kb.category.save') }}', data)
          .then(function (response) {
                $('#categoryList').append(response.data.html);
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


    $('.modal-body').on('click', '.deleteCategory', function (e) {
        e.preventDefault();
        var tag, id;

        tag = $(this);
        id = tag.data('cat-id');

        if(!confirm('Do you want to delete this message?')) {
            return false;
        }
        axios.post('{{ route('kb.category.destroy') }}', {
            "id": id
        })
          .then(function (response) {
                toastr.warning( response.data.message , '@langapp('response_status')');
                $('#cat-' + id).hide(500, function () {
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