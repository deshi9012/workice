<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{  langapp('stage') }}</h4>
        </div>
        {!! Form::open(['route' => 'settings.stages.save', 'class' => 'bs-example form-horizontal', 'id' => 'saveStage']) !!}
        <input type="hidden" name="module" value="{{ $module }}">
        <input type="hidden" name="color" value="info">
        <input type="hidden" name="active" value="1">
        
        <div class="modal-body">
            <div class="form-group">
                <label class="col-lg-4 control-label">{{ langapp('stage') }} @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="e.g Initial Contact" name="name">
                </div>
            </div>

            @if($module === 'deals')

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('pipeline') @required</label>
                <div class="col-lg-8">
                    <select name="pipeline" class="form-control">
                        @foreach (App\Entities\Category::whereModule('pipeline')->get() as $pipeline)
                           <option value="{{ $pipeline->id }}" {{ $pipeline->id == get_option('default_deal_stage') ? 'selected' : '' }}>{{ $pipeline->name }}</option>
                        @endforeach
                        
                    </select>
                </div>
            </div>

            @endif

            <ul class="list-group gutter list-group-lg list-group-sp sortable" id="stageList">

                @foreach ($stages as $stage)
                <li class="list-group-item" draggable="true" id="stage-{{ $stage->id }}">
                    <span class="pull-right">
                    <a href="{{ route('settings.stages.edit', $stage->id) }}" data-toggle="ajaxModal" data-dismiss="modal">
                            @icon('solid/pencil-alt', 'icon-muted fa-fw m-r-xs')
                    </a>
                        <a href="#" class="deleteStage" data-stage-id="{{ $stage->id }}">
                            @icon('solid/times', 'icon-muted fa-fw')
                        </a>
                    </span>

                    <span class="pull-left media-xs">@icon('solid/arrows-alt', 'm-r-sm')</span>

                    <div class="clear">{{ $stage->name }}
                        @if($stage->module === 'deals')
                        <span class="badge bg-info">{{ $stage->AsPipeline()->name }}</span>
                        @endif
                    </div>
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
<script src="{{ getAsset('plugins/sortable/jquery-sortable.js') }}"></script>
    <script>
    $('#saveStage').on('submit', function(e) {
        $(".formSaving").html('Processing..<i class="fas fa-spin fa-spinner"></i>');

        e.preventDefault();
        var tag, data;
        tag = $(this);
        data = tag.serialize();


        axios.post('{{ route('settings.stages.save') }}', data)
          .then(function (response) {
            $('#stageList').append(response.data.html);
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


    $('body').on('click', '.deleteStage', function (e) {
        e.preventDefault();
        var tag, id;

        tag = $(this);
        id = tag.data('stage-id');

        if(!confirm('Do you want to delete this message?')) {
            return false;
        }
        axios.post('{{ route('settings.stages.delete') }}', {
            "id":id
        })
          .then(function (response) {
                toastr.warning( response.data.message , '@langapp('response_status') ');
                $('#stage-' + id).hide(500, function () {
                    $(this).remove();
                });
          })
          .catch(function (error) {
            toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
        });

        
    });
        
$(function  () {
  $("ul#stageList").sortable({
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

        var dataToSend = $("ul#stageList").sortable("serialize").get();

        axios.post('{{ route('settings.stages.order') }}', {
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