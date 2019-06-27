@extends('layouts.app')
@section('content')
<section id="content" class="bg">
    <section class="hbox stretch">
        <section class="vbox">
            <header class="header bg-white b-b b-light">

                @admin
                <a href="{{ route('settings.stages.show', 'deals') }}" data-toggle="ajaxModal" class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right" data-rel="tooltip" title="@langapp('stages')" data-placement="bottom">
                    @icon('solid/cogs')
                </a>
                @endadmin
                <div class="btn-group pull-right">
                    <a href="{{ route('deals.index', ['view' => 'table']) }}" data-rel="tooltip" title="Table" data-placement="bottom" class="btn btn-sm btn-default">
                        @icon('solid/th')
                    </a>
                    <a href="{{ route('deals.index', ['view' => 'kanban']) }}" data-rel="tooltip" title="Kanban" data-placement="bottom" class="btn btn-sm btn-default">
                        @icon('solid/align-justify')
                    </a>
                </div>
                
                <div class="btn-group pull-right">
                    <button class="btn btn-{{ get_option('theme_color') }} btn-sm dropdown-toggle btn-responsive"
                    data-toggle="dropdown">@icon('solid/ellipsis-h')
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('deals.index', ['view' => 'forecast']) }}">@icon('solid/clock', 'text-muted') @langapp('forecasted')</a></li>
                        @can('deals_create')
                        <li><a href="{{ route('deals.import') }}" data-toggle="ajaxModal">@icon('solid/cloud-upload-alt', 'text-muted') @langapp('import')</a></li>
                        @endcan
                        <li><a href="{{ route('deals.export')  }}">@icon('solid/cloud-download-alt', 'text-muted') @langapp('export')</a></li>
                        <li><a href="{{ route('deals.index', ['filter' => 'won'])  }}">@icon('solid/check', 'text-muted') @langapp('won')</a></li>
                        <li><a href="{{ route('deals.index', ['filter' => 'lost'])  }}">@icon('solid/times', 'text-muted') @langapp('lost')</a></li>
                        <li><a href="{{ route('deals.index', ['filter' => 'archived'])  }}">@icon('solid/archive', 'text-muted') @langapp('archived')</a></li>
                    </ul>
                </div>
                <div class="btn-group pull-right">
                    <button class="btn btn-{{ get_option('theme_color') }} btn-sm dropdown-toggle btn-responsive"
                    data-toggle="dropdown"> Pipeline <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        @foreach (App\Entities\Category::whereModule('pipeline')->get() as $p)
                        <li>
                            <a href="{{  route('deals.index', ['pipeline' => $p->id])  }}">
                                {{ $p->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                
                
                
                @can('deals_create')
                <a href="{{ route('deals.create') }}"
                    class="btn btn-{{ get_option('theme_color') }} btn-sm pull-right"
                    data-toggle="ajaxModal" data-rel="tooltip"
                title="@langapp('create')" data-placement="left"> @icon('solid/plus') @langapp('create')  </a>
                @endcan
                <p class="h3">@langapp('deals') - <strong>{{ optional(App\Entities\Category::whereId($pipeline)->first())->name }}</strong></p>
                
            </header>
            <section class="scrollable wrapper overflow-x-auto">
                
                <div class="row">
                    
                    @if ($dealDisplay == 'table')
                    @include('deals::table_view')
                    @endif

                    @if ($dealDisplay == 'forecast')
                    @include('deals::forecast')
                    @endif

                    @if ($dealDisplay == 'kanban')
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body collapse in">
                                <div class="card-block">
                                    <div class="overflow-hidden">
                                        <div id="todo-lists-basic-demo"
                                            class="lobilists-wrapper lobilists single-line sortable ps-container ps-theme-dark ps-active-x">
                                           
                                            @foreach ($cards as $card)
                                            <div class="lobilist-wrapper ps-container ps-theme-dark ps-active-y kanban-col">
                                                <div id="lobilist-list-0"
                                                    class="lobilist lobilist-default">
                                                    <div class="lobilist-header ui-sortable-handle">
                                                        <div class="lobilist-title text-ellipsis text-uc text-muted">
                                                            <span class="arrow right"></span> {{ ucfirst($card->name) }}
                                                        </div>
                                                    </div>
                                                    <div class="lobilist-body scrumboard slim-scroll" data-disable-fade-out="true"
                                                        data-distance="0" data-size="3px" data-height="550"
                                                        data-color="#333333">
                                                        <ul class="lobilist-items ui-sortable list" id="{{ $card->id }}">
                                                            @php $dealCounter = 0; @endphp
                                                            @foreach ($deals->where('stage_id', $card->id) as $deal)
                                                            <li id="{{ $deal->id }}" draggable="true" class="lobilist-item kanban-entry grab {{ $deal->rotten ? 'rotten-bg' : '' }}">
                                                                <div class="lobilist-item-title text-ellipsis m-l-xs font14">
                                                                    <a href="{{ route('deals.view', $deal->id) }}" class="{{ $deal->rotten ? 'text-danger' : '' }}">{{ $deal->title }}</a>
                                                                    @if($deal->has_email)
                                                                    @icon('regular/envelope', 'text-success')
                                                                    @endif
                                                                </div>
                                                                <div class="lobilist-item-description text-muted">
                                                                    <small class="pull-right xs"> @icon('regular/user')
                                                                    {{  optional($deal->contact)->name  }}
                                                                    </small>
                                                                    
                                                                    <span class="text-bold">
                                                                        {{  $deal->computed_value  }}
                                                                        @if ($deal->status == 'won')
                                                                        <label class="label bg-success">@icon('solid/check-circle') {{ ucfirst($deal->status) }}</label>
                                                                        @endif
                                                                        @if ($deal->status == 'lost')
                                                                        <label class="label bg-danger">@icon('solid/times') {{ ucfirst($deal->status) }}</label>
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                                <small class="text-muted">
                                                                {{ !empty($deal->due_date) ? dateElapsed($deal->due_date) : '' }}
                                                                </small>
                                                                <div class="lobilist-item-duedate">
                                                                    {{  dateFormatted($deal->due_date) }}
                                                                </div>
                                                                @if ($deal->user_id > 0)
                                                                <span class="thumb-xs avatar lobilist-check">
                                                                    <img src="{{ $deal->user->profile->photo }}" class="img-circle">
                                                                </span>
                                                                @endif
                                                                <div class="todo-actions">
                                                                    @if ($deal->has_activity)
                                                                    <div class="edit-todo todo-action">
                                                                        <a href="{{ route('deals.view', ['id' => $deal->id, 'tab' => 'activity']) }}">
                                                                            @icon('solid/circle', 'text-warning')
                                                                        </a>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                <div class="drag-handler"></div>
                                                                
                                                            </li>
                                                            @php $dealCounter++; @endphp
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="lobilist-footer">
                                                        <strong>@metrics('deals_stage_'.$card->id)</strong>
                                                        <strong class="pull-right">{{ $dealCounter }} Deal(s)</strong>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="modal modal-static fade" id="processing-modal"
                                                role="dialog" aria-hidden="true">
                                                <div class="modal-dialog processing-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="text-center">
                                                                @icon('solid/sync-alt', 'fa-4x fa-spin')
                                                                <h4>Processing...</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>


            </section>
        </section>
    </section>
</section>
@push('pagescript')
<script type="text/javascript">
$(document).ready(function () {
var kanbanCol = $('.scrumboard');
draggableInit();
});
function draggableInit() {
var sourceId;
$('[draggable=true]').bind('dragstart', function (event) {
sourceId = $(this).parent().attr('id');
event.originalEvent.dataTransfer.setData("text/plain", event.target.getAttribute('id'));
});
$('.scrumboard').bind('dragover', function (event) {
event.preventDefault();
});
$('.scrumboard').bind('drop', function (event) {
var children = $(this).children();
var targetId = children.attr('id');
if (sourceId != targetId) {
var elementId = event.originalEvent.dataTransfer.getData("text/plain");
$('#processing-modal').modal('toggle');
setTimeout(function () {
var element = document.getElementById(elementId);
deal_id = element.getAttribute('id');
$.ajax({
type: "POST",
url: "{{ route('deals.movestage') }}",
data: {
'id': deal_id,
'_token': '{{ csrf_token() }}',
'target': targetId
},
success: function (msg) {
toastr.success(msg, '@langapp('success') ');
}
});
children.prepend(element);
$('#processing-modal').modal('toggle');
}, 1000);
}
event.preventDefault();
});
}
</script>
@endpush
@endsection