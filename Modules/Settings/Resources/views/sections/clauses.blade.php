<div class="row">
    <div class="col-lg-12">
        
        
        <section class="scrollable wrapper bg" id="clauses">
            
            <div class="panel-group m-b" id="accordion2">
                <div class="input-group m-b-sm">
                    <input type="text" class="form-control search" placeholder="Search by Subject or Message">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-{{ get_option('theme_color') }} btn-icon">@icon('solid/search')</button>
                    </span>
                </div>
                
                <ul class="list no-style" id="clauses-list">
                    @foreach (Modules\Contracts\Entities\Clause::orderBy('id', 'desc')->get() as $clause)
                    <li class="panel panel-default" id="clause-{{ $clause->id }}">
                        <div class="panel-heading">
                            <a class="accordion-toggle name" data-toggle="collapse" data-parent="#accordion2" href="#{{ slugify($clause->name) }}">
                                @icon('solid/caret-right') {{ humanize($clause->name) }}
                            </a>
                            <a href="#" class="delete-clause pull-right text-muted" data-clause-id="{{$clause->id}}">@icon('solid/trash-alt')</a>
                            <a href="{{ route('extras.edit.clause', $clause->id) }}" class="pull-right text-muted m-l-xs" data-toggle="ajaxModal">@icon('solid/pencil-alt')</a>
                        </div>
                        <div id="{{ slugify($clause->name) }}" class="panel-collapse collapse">
                            <div class="panel-body clause">
                                @parsedown($clause->clause)
                            </div>
                        </div>
                    </li>
                    
                    @endforeach
                </ul>
                
                
                
                
            </div>
            {!! Form::open(['route' => 'clauses.api.save', 'novalidate' => '', 'id' => 'save-clause']) !!}
            <div class="form-group">
                <label class="control-label">@langapp('name') @required</label>
                
                <input type="text" class="form-control" name="name" placeholder="Dispute" required>
            </div>
            <div class="form-group">
                <label class="control-label">@langapp('clause') @required</label>
                <textarea class="form-control markdownEditor" name="clause" placeholder="Type text..."></textarea>
                
            </div>
            <footer class="panel-footer bg-light lter m-b-sm">
                {!!  renderAjaxButton()  !!}
            <ul class="nav nav-pills nav-sm"></ul>
        </footer>
        {!! Form::close() !!}
    </section>
    
    
    <a class="hide nav-off-screen-block" data-target="#nav" data-toggle="class:nav-off-screen" href="#">
    </a>
    
</div>
</div>
@push('pagestyle')
@include('stacks.css.form')
@endpush
@push('pagescript')
@include('stacks.js.markdown')
@include('stacks.js.form')
<script src='{{ getAsset('plugins/apps/list.min.js') }}'></script>
<script>
var options = {
valueNames: [ 'name', 'clause' ]
};
var ResponseList = new List('clauses', options);
</script>
<script>
    $(document).ready(function () {
        $('#save-clause').on('submit', function(e) {
            $(".formSaving").html('Processing..<i class="fas fa-spin fa-spinner"></i>');

            e.preventDefault();
            var tag, data;
            tag = $(this);

            var data = new FormData(this);

            axios.post($(this).attr("action"), data)
            .then(function (response) {
                    $('#clauses-list').prepend(response.html);
                    toastr.info( response.data.message , '@langapp('response_status') ');
                    $(".formSaving").html('<i class="fas fa-paper-plane"></i> @langapp('save') </span>');
                    window.location.href = response.data.redirect;
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


        $('.list').on('click', '.delete-clause', function (e) {
            e.preventDefault();
            var tag, id;

            tag = $(this);
            id = tag.data('clause-id');

            if(!confirm('Do you want to delete this clause?')) {
                return false;
            }

            axios.delete('/api/v1/clauses/'+id)
            .then(function (response) {
                    toastr.warning( response.data.message , '@langapp('response_status') ');
                    $('#clause-' + id).hide(500, function () {
                        $(this).remove();
                    });
            })
            .catch(function (error) {
                    toastr.error( 'Oops! Something went wrong!' , '@langapp('response_status') ');
            });

        });
    });

</script>
@endpush