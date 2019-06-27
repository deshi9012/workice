<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('create')  </h4>
        </div>
        {!! Form::open(['route' => 'expenses.api.save', 'class' => 'bs-example form-horizontal ajaxifyForm', 'data-toggle' => 'validator', 'files' => true]) !!}
        
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <div class="modal-body">
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('amount') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control money" placeholder="800.00" name="amount">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('category') @required</label>
                <div class="col-lg-8">
                    <select name="category" class="form-control select2-option">
                        @foreach (App\Entities\Category::whereModule('expenses')->select('id', 'name')->get() as $key => $cat)
                        <option value="{{  $cat->id  }}">{{  $cat->name  }}</option>
                        @endforeach
                    </select>
                </div>
                @can('categories_create')
                <a href="{{  route('categories.create')  }}"
                    class="btn btn-{{ get_option('theme_color')  }} btn-sm" data-toggle="ajaxModal"
                    title="@langapp('add_category')  " data-dismiss="modal">@icon('solid/plus') @langapp('add_category')
                </a>
                @endcan
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">{{  langapp('vendor')  }} </label>
                <div class="col-lg-8" id="vendor-search">
                    <input type="text" class="form-control typeahead" id="vendor-name" placeholder="ACME Designers" name="vendor">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('currency') @required</label>
                <div class="col-lg-8">
                    <select name="currency" class="select2-option form-control">
                        @foreach (App\Entities\Currency::select('code', 'title')->get() as $key => $cur)
                        <option value="{{  $cur->code  }}" {{ $cur->code == get_option('default_currency') ? 'selected="selected"' : ''  }}>{{  $cur->title  }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">{{ get_option('tax1Label') }} (%) </label>
                <div class="col-lg-8">
                    <input type="text" class="form-control money" value="0.00" name="tax">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">{{ get_option('tax2Label') }} (%) </label>
                <div class="col-lg-8">
                    <input type="text" class="form-control money" value="0.00" name="tax2">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('notes')   </label>
                <div class="col-lg-8">
                    <textarea class="form-control ta" name="notes"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('project') </label>
                <div class="col-lg-8">
                    <select name="project_id" class="select2-option form-control m-b" id="selected_project">
                        <option value="0">None</option>
                        @foreach (classByName('projects')->whereNull('archived_at')->select('id', 'name')->get() as $key => $project)
                        <option value="{{  $project->id  }}" {{ $selected_project == $project->id ? 'selected' : ''  }}>{{  $project->name  }}</option>
                        @endforeach
                        
                    </select>
                </div>
            </div>
            <div id="client_select" class="display-none">
                <div class="form-group">
                    <label class="col-lg-4 control-label">@langapp('client')</label>
                    <div class="col-lg-8">
                        <select name="client_id" class="select2-option form-control">
                            @foreach (classByName('clients')->select('id', 'name')->get() as $key => $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('expense_date') @required</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <input class="datepicker-input form-control" size="16" type="text"
                        value="{{ datePickerFormat(now()) }}"
                        name="expense_date"
                        data-date-format="{{get_option('date_picker_format') }}"
                        required>
                        <label class="input-group-addon btn" for="date">
                            @icon('solid/calendar-alt', 'text-muted')
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                                        <label class="col-md-4 control-label">@langapp('recur_frequency')</label>
                                        <div class="col-md-8">
                                            <select name="recurring[frequency]" class="form-control" id="frequency">
                                                <option value="none" selected>@langapp('none')</option>
                                                <option value="1">@langapp('daily')</option>
                                                <option value="7">@langapp('week')</option>
                                                <option value="30">@langapp('month')</option>
                                                <option value="90">@langapp('quarter')</option>
                                                <option value="180">@langapp('six_months')</option>
                                                <option value="365">@langapp('year')</option>
                                            </select>
                                        </div>
                                    </div>
            
            
            <div id="recurring" class="display-none">

                <div class="form-group">
                    <label class="col-lg-4 control-label">@langapp('recur_starts')</label>
                    <div class="col-lg-8">
                        <div class="input-group">
                            <input class="datepicker-input form-control" size="16" type="text"
                            value="{{ datePickerFormat(now()) }}"
                            name="recurring[recur_starts]"
                            data-date-format="{{get_option('date_picker_format') }}"
                            required>
                            <label class="input-group-addon btn" for="date">
                                @icon('solid/calendar-alt', 'text-muted')
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">@langapp('recur_ends')</label>
                    <div class="col-lg-8">
                        <div class="input-group">
                            <input class="datepicker-input form-control" size="16" type="text"
                            value="{{  datePickerFormat(now()->addYears(1)) }}"
                            name="recurring[recur_ends]"
                            data-date-format="{{ get_option('date_picker_format')  }}" data-date-start-date="moment()" required>
                            <label class="input-group-addon btn" for="date">
                                @icon('solid/calendar-alt', 'text-muted')
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label"></label>
                <div class="col-lg-8">
                    <div class="form-check text-muted">
                        <label>
                            <input type="hidden" value="0" name="billable"/>
                            <input type="checkbox" name="billable" value="1" checked>
                            <span class="label-text">@langapp('billable')</span>
                        </label>
                    </div>
                    <div class="form-check text-muted">
                        <label>
                            <input type="hidden" value="0" name="is_visible"/>
                            <input type="checkbox" name="is_visible" value="1" checked>
                            <span class="label-text">@langapp('show_to_client')</span>
                        </label>
                    </div>
                    <div class="form-check text-muted">
                        <label>
                            <input type="hidden" value="0" name="invoiced"/>
                            <input type="checkbox" name="invoiced" value="1">
                            <span class="label-text">@langapp('billed')  </span>
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">@langapp('tags')</label>
                <div class="col-md-8">
                    <select class="select2-tags form-control" name="tags[]" multiple="multiple">
                        @foreach (App\Entities\Tag::all() as $tag)
                        <option value="{{  $tag->name  }}">{{  $tag->name }}</option>
                        @endforeach
                    </select>
                    
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('receipt')</label>
                <div class="col-lg-8">
                    <input name="uploads[]" type="file">
                </div>
            </div>

                @php 
                $data['fields'] = App\Entities\CustomField::expenses()->orderBy('order', 'desc')->get();
                @endphp
                @include('partial.customfields.createWithCol', $data)


        </div>
        <div class="modal-footer">
            {!! closeModalButton() !!}
            {!! renderAjaxButton() !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>

@push('pagestyle')
<link href="{{ getAsset('plugins/typeahead/typeahead.css') }}" rel="stylesheet" type="text/css">
@include('stacks.css.datepicker')
@include('stacks.css.form')
@endpush

@push('pagescript')
<script src="{{ getAsset('plugins/typeahead/typeahead.jquery.min.js') }}"></script>
@include('stacks.js.datepicker')
@include('stacks.js.form')
<script type="text/javascript">
$(document).ready(function () {
var substringMatcher = function(strs) {
return function findMatches(q, cb) {
    var matches, substringRegex;
    matches = [];
    substrRegex = new RegExp(q, 'i');
    $.each(strs, function(i, str) {
    if (substrRegex.test(str)) {
        matches.push(str);
    }
    });
cb(matches);
};
};
var vendors = [
@foreach(Modules\Expenses\Entities\Expense::select('vendor')->whereNotNull('vendor')->groupBy('vendor')->get() as $expense)
'{{ $expense->vendor }}',
@endforeach
];
$('#vendor-search .typeahead').typeahead({
    hint: true,
    highlight: true,
    minLength: 1
},
{
    name: 'vendors',
    source: substringMatcher(vendors)
});

$('#selected_project').change(function () {
    if ($("#selected_project").val() == 0) {
        $("#client_select").show();
    } else {
        $("#client_select").hide();
    }
}).change();
$('#frequency').change(function () {
        if ($("#frequency").val() === "none") {
            $("#recurring").hide();
        } else {
            $("#recurring").show();
        }
    }).change();
$('.money').maskMoney({allowZero: true, thousands: '', allowNegative: true});
});
</script>
@include('partial.ajaxify')

@endpush
@stack('pagestyle')
@stack('pagescript')