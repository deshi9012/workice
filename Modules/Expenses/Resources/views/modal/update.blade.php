<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('make_changes')  </h4>
        </div>
        {!! Form::open(['route' => ['expenses.api.update', $expense->id], 'class' => 'bs-example form-horizontal ajaxifyForm', 'files' => true, 'method' => 'PUT']) !!}
        <input type="hidden" name="id" value="{{  $expense->id  }}">
        <div class="modal-body">
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('amount') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control money" value="{{ $expense->amount }}" name="amount">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">{{  langapp('vendor')  }} </label>
                <div class="col-lg-8" id="vendor-search">
                    <input type="text" class="form-control typeahead" id="vendor-name" value="{{  $expense->vendor  }}" name="vendor">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('category') @required</label>
                <div class="col-lg-8">
                    <select name="category" class="form-control m-b select2-option">
                        @foreach (App\Entities\Category::whereModule('expenses')->select('id', 'name')->get() as $key => $cat)
                        <option value="{{  $cat->id  }}" {{ $expense->category == $cat->id ? 'selected="selected"' : '' }}>{{  $cat->name  }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('currency') @required</label>
                <div class="col-lg-8">
                    <select name="currency" class="select2-option form-control">
                        @foreach (App\Entities\Currency::select('code', 'title')->get() as $key => $cur)
                        <option value="{{  $cur->code  }}" {{  $cur->code == $expense->currency ? 'selected="selected"' : '' }}>{{  $cur->title  }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">{{ langapp('xrate') }}</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon">-</span>
                        <input class="form-control" type="text" value="{{ $expense->exchange_rate }}" name="exchange_rate" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">{{  get_option('tax1Label')  }} (%) </label>
                <div class="col-lg-8">
                    <input type="text" class="form-control money" value="{{ $expense->tax }}" name="tax">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">{{  get_option('tax2Label')  }} (%) </label>
                <div class="col-lg-8">
                    <input type="text" class="form-control money" value="{{ $expense->tax2 }}" name="tax2">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('notes')   </label>
                <div class="col-lg-8">
                    <textarea class="form-control ta" name="notes">{{ $expense->notes }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('project') @required</label>
                <div class="col-lg-8">
                    <select name="project_id" class="form-control m-b select2-option" id="selected_project">
                        <option value="0" {{ $expense->project_id > 0 ? '' : 'selected' }}>None</option>
                        @foreach (classByName('projects')->select('id', 'name')->get() as $key => $project)
                        <option value="{{  $project->id  }}" {{ $expense->project_id === $project->id ? 'selected' : '' }}>
                        {{  $project->name  }}</option>
                        @endforeach
                        
                    </select>
                </div>
            </div>
            <div id="client_select" class="{{ $expense->project_id ? 'display-none' : ''}}">
                <div class="form-group">
                    <label class="col-lg-4 control-label">@langapp('client')</label>
                    <div class="col-lg-8">
                        <select name="client_id" class="form-control m-b select2-option">
                            @foreach (classByName('clients')->select('id', 'name')->get() as $key => $company)
                            <option value="{{  $company->id  }}" {{ $expense->client_id === $company->id ? 'selected' : '' }}>{{  $company->name  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('expense_date')</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <input class="datepicker-input form-control" size="16" type="text"
                        value="{{  datePickerFormat($expense->expense_date)  }}"
                        name="expense_date"
                        data-date-format="{{ get_option('date_picker_format') }}"
                        required>
                        <label class="input-group-addon btn" for="date">
                            @icon('solid/calendar-alt', 'text-muted')
                        </label>
                    </div>
                    
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-4 control-label"></label>
                <div class="col-lg-8">
                    <div class="form-check text-muted">
                        <label class="">
                            <input type="hidden" name="billable" value="0">
                            <input type="checkbox" name="billable" {{ $expense->billable ? 'checked' : '' }} value="1">
                            <span class="label-text">@langapp('billable')</span>
                        </label>
                    </div>
                    <div class="form-check text-muted">
                        <label>
                            <input type="hidden" value="0" name="is_visible"/>
                            <input type="checkbox" name="is_visible" {{ $expense->is_visible ? 'checked' : '' }} value="1">
                            <span class="label-text">@langapp('show_to_client')</span>
                        </label>
                    </div>
                    <div class="form-check text-muted">
                        <label class="">
                            <input type="hidden" name="invoiced" value="0">
                            <input type="checkbox" name="invoiced" {{  $expense->invoiced ? 'checked' : '' }} value="1">
                            <span class="label-text">@langapp('billed')</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">@langapp('recur_frequency')</label>
                <div class="col-md-8">
                    <select name="recurring[frequency]" class="form-control" id="frequency">
                        <option value="none" {{ $expense->is_recurring ? 'selected' : '' }}>@langapp('none')  </option>
                        <option value="1"{{ $expense->is_recurring && $expense->recurring->frequency == '1' ? ' selected' : ''  }}>@langapp('daily')</option>
                        <option value="7"{{ $expense->is_recurring && $expense->recurring->frequency == '7' ? ' selected' : ''  }}>@langapp('week')</option>
                        <option value="30"{{ $expense->is_recurring && $expense->recurring->frequency == '30' ? ' selected' : ''  }}>@langapp('month')</option>
                        <option value="90"{{ $expense->is_recurring && $expense->recurring->frequency == '90' ? ' selected' : ''  }}>@langapp('quarter')</option>
                        <option value="180"{{ $expense->is_recurring && $expense->recurring->frequency == '180' ? ' selected' : ''  }}>@langapp('six_months')</option>
                        <option value="365"{{ $expense->is_recurring && $expense->recurring->frequency == '365' ? ' selected' : ''  }}>@langapp('year')</option>
                    </select>
                </div>
            </div>
            <div id="recurring" class="{{ !$expense->is_recurring ? 'display-none' : '' }}">
                @php
                $recurStarts = $expense->is_recurring ? $expense->recurring->recur_starts : today()->toDateString();
                $recurEnds = $expense->is_recurring ? $expense->recurring->recur_ends : today()->addYears(1)->toDateString();
                @endphp
                <div class="form-group">
                    <label class="col-md-4 control-label">@langapp('start_date')   </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input class="datepicker-input form-control" size="16" type="text"
                            value="{{ datePickerFormat($recurStarts) }}"
                            name="recurring[recur_starts]"
                            data-date-format="{{ get_option('date_picker_format') }}"
                            required>
                            <label class="input-group-addon btn" for="date">
                                @icon('solid/calendar-alt', 'text-muted')
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">@langapp('end_date')</label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input class="datepicker-input form-control" size="16" type="text"
                            value="{{ datePickerFormat($recurEnds) }}"
                            name="recurring[recur_ends]"
                            data-date-format="{{ get_option('date_picker_format')  }}"
                            required>
                            <label class="input-group-addon btn" for="date">
                                @icon('solid/calendar-alt', 'text-muted')
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-4 control-label">@langapp('tags')  </label>
                <div class="col-md-8">
                    <select class="select2-tags form-control" name="tags[]" multiple>
                        @foreach (App\Entities\Tag::all() as $tag)
                        <option value="{{ $tag->name  }}" {{  in_array($tag->id, array_pluck($expense->tags->toArray(), 'id')) ? ' selected="selected"' : '' }}>
                            {{ $tag->name }}
                        </option>
                        @endforeach
                    </select>
                    
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('receipt')</label>
                <div class="col-lg-3">
                    <input type="file" name="uploads[]">
                </div>
            </div>
            @php
            $data['fields'] = App\Entities\CustomField::whereModule('expenses')->orderBy('order', 'desc')->get();
            @endphp
            @include('expenses::_includes.updateCustom', $data)
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
@include('stacks.js.form')
@include('stacks.js.datepicker')
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
$('#frequency').change(function () {
if ($("#frequency").val() === "none") {
$("#recurring").hide();
} else {
$("#recurring").show();
}
}).change();
$('#selected_project').change(function () {
if ($("#selected_project").val() == 0) {
$("#client_select").show();
} else {
$("#client_select").hide();
}
}).change();
$('.money').maskMoney({allowZero: true, thousands: '', allowNegative: true});
});
</script>
@include('partial.ajaxify')
@endpush
@stack('pagestyle')
@stack('pagescript')