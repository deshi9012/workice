<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{  langapp('deal_pipelines')  }}</h4>
        </div>
        {!! Form::open(['route' => 'settings.pipelines.save', 'class' => 'bs-example form-horizontal', 'id' => 'savePipeline']) !!}
        <input type="hidden" name="module" value="pipeline">
        <input type="hidden" name="color" value="info">
        <input type="hidden" name="active" value="1">
        
        <div class="modal-body">
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('pipeline') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="e.g Sales" name="name">
                </div>
            </div>
            <ul class="list-group gutter list-group-lg list-group-sp sortable" id="pipelineList">

                @foreach ($pipelines as $pipeline)
                <li class="list-group-item" draggable="true" id="pipeline-{{ $pipeline->id }}">
                    <span class="pull-right">
                    <a href="{{ route('settings.pipelines.edit', $pipeline->id) }}" data-toggle="ajaxModal" data-dismiss="modal">
                             @icon('solid/pencil-alt', 'icon-muted fa-fw m-r-xs')
                    </a>
                        <a href="#" class="deletePipeline" data-pipeline-id="{{ $pipeline->id }}">
                             @icon('solid/times', 'icon-muted fa-fw')
                        </a>
                    </span>

                    <span class="pull-left media-xs"> @icon('solid/arrows-alt', 'm-r-sm')</span>

                    <div class="clear">{{ $pipeline->name }}</div>
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
<script src="{{ getAsset('plugins/sortable/jquery-sortable.js') }}"></script>
    <script>
        $(document).ready(function () {

    $('#savePipeline').on('submit', function(e) {
        $(".formSaving").html('Processing..<i class="fas fa-spin fa-spinner"></i>');

        e.preventDefault();
        var tag, data;
        tag = $(this);
        data = tag.serialize();

        axios.post('{{ route('settings.pipelines.save') }}', data)
          .then(function (response) {
            $('#pipelineList').append(response.data.html);
                toastr.success( response.data.message , '@langapp('response_status') ');
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


    $('.modal-body').on('click', '.deletePipeline', function (e) {
        e.preventDefault();
        var tag, url, id, request;

        tag = $(this);
        id = tag.data('pipeline-id');
        url = '/settings/pipelines/delete/' + id;

        if(!confirm('Do you want to delete this message?')) {
            return false;
        }

        axios.post('{{ route('settings.pipelines.delete') }}', {
            "id":id
        })
          .then(function (response) {
                toastr.warning( response.data.message , '@langapp('response_status') ');
                $('#pipeline-' + id).hide(500, function () {
                    $(this).remove();
                });
          })
          .catch(function (error) {
            toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
        });
    })
});

    </script>
    <script type="text/javascript">
        $(function  () {
  $("ul#pipelineList").sortable({
    placeholder: '<li class="placeholder list-group-item"/>',
    serialize: function ($parent, $children, parentIsContainer) {
      var result = $.extend({}, {id:$parent.attr('id')});
      if(parentIsContainer)
        return $children;
      else if ($children[0]) 
        result.children = $children;
      return result;

    }, 
    onDrop: function ($item, container, _super) {
        $item.removeClass("dragged").removeAttr("style");
        $("body").removeClass("dragging");

        var dataToSend = $("ul#pipelineList").sortable("serialize").get();

        axios.post('{{ route('settings.pipelines.order') }}', {
            "sortedList":dataToSend
        })
          .then(function (response) {
                toastr.info( response.data.message , '@langapp('response_status') ');
          })
          .catch(function (error) {
                toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
        });
    }
  });
});      
    </script>
@endpush

@stack('pagescript')