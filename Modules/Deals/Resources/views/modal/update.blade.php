<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('make_changes')  </h4>
        </div>
        {!! Form::open(['route' => ['deals.api.update', $deal->id], 'class' => 'ajaxifyForm form-horizontal', 'method' => 'PUT']) !!}
        
        <div class="modal-body">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a data-toggle="tab" href="#tab-deal-general">@langapp('general')  </a></li>
                <li><a data-toggle="tab" href="#tab-deal-custom">@langapp('custom_fields')  </a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab-deal-general">
                    <input type="hidden" name="id" value="{{ $deal->id }}">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">@langapp('title') @required
                        </label>
                        <div class="col-lg-8">
                            <input type="text" name="title" value="{{ $deal->title }}" class="input-sm form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">@langapp('currency') </label>
                        <div class="col-sm-8">
                        <select name="currency" class="form-control select2-option">
                            @foreach (currencies() as $cur)
                                <option value="{{  $cur['code']  }}" {{ get_option('default_currency') == $cur['code'] ? ' selected' : '' }}>{{ $cur['title'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-4 control-label">@langapp('deal_value') @required
                        </label>
                        <div class="col-lg-8">
                            <input type="text" name="deal_value" value="{{ $deal->deal_value }}"
                            class="input-sm form-control money" required>
                            <span class="help-block">Enter decimal value Ex. 300.00</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">@langapp('source') @required
                        </label>
                        <div class="col-lg-8">
                            <select class="form-control select2-option" name="source" required>
                                @foreach (App\Entities\Category::select('id', 'name')->whereModule('source')->get() as $key => $source)
                                <option value="{{  $source->id  }}" {{  $source->id == $deal->source ? 'selected="selected"' : '' }}>{{ $source->name  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-4 control-label">@langapp('close_date')</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <input class="datepicker-input form-control" size="16" type="text"
                                value="{{  datePickerFormat($deal->due_date) }}"
                                name="due_date" data-date-format="{{ get_option('date_picker_format') }}" data-date-start-date="moment()" required="required">
                                <label class="input-group-addon btn" for="date">
                                    @icon('solid/calendar-alt')
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">@langapp('pipeline') @required</label>
                        <div class="col-lg-8">
                            <select name="pipeline" class="form-control m-b" id="pipeline-list"
                                onChange="getStages(this.value);" required>
                                @foreach (App\Entities\Category::whereModule('pipeline')->get() as $key => $pipeline)
                                <option value="{{  $pipeline->id  }}" {{ $deal->pipeline == $pipeline->id ? 'selected' : '' }}>{{  $pipeline->name  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">@langapp('stage') @required
                        </label>
                        <div class="col-lg-8">
                            <select name="stage_id" class="form-control m-b" id="stage-list">
                                @foreach ($categories as $key => $cat)
                                <option value="{{ $cat->id }}" {{ $deal->stage_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">@langapp('organization') @required</label>
                        <div class="col-lg-8">
                            <select class="select2-option form-control" name="organization" required>
                                @foreach (Modules\Clients\Entities\Client::select('id', 'name')->get() as $key => $org)
                                <option value="{{  $org->id  }}" {{ $deal->organization === $org->id ? 'selected' : '' }}>{{  $org->name  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">@langapp('contact_person') @required</label>
                        <div class="col-lg-8">
                            <select class="select2-option form-control" name="contact_person" required>
                                
                                @foreach (app('user')->select('id', 'username', 'name')->get() as $key => $user)
                                <option value="{{  $user->id  }}" {{ $deal->contact_person === $user->id ? 'selected' : '' }}>{{  $user->name  }}</option>
                                
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">@langapp('tags')  </label>
                        <div class="col-md-8">
                            <select class="select2-tags form-control" name="tags[]" multiple>
                                @foreach (App\Entities\Tag::all() as $tag)
                                <option value="{{ $tag->name  }}" {{  in_array($tag->id, array_pluck($deal->tags->toArray(), 'id')) ? ' selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane fade in" id="tab-deal-custom">
                    @php
                    $data['fields'] = App\Entities\CustomField::whereModule('deals')->orderBy('order', 'desc')->get();
                    @endphp
                    @include('deals::_includes.updateCustom', $data)
                </div>
            </div>
        </div>
        <div class="modal-footer">
            {!! closeModalButton() !!}
            {!! renderAjaxButton() !!}
            
        </div>
        {!! Form::close() !!}
    </div>
</div>
@push('pagestyle')
@include('stacks.css.datepicker')
@include('stacks.css.form')
@endpush
@push('pagescript')
@include('stacks.js.datepicker')
@include('stacks.js.form')

<script>
    $('.money').maskMoney({allowZero: true, thousands: ''});
function getStages(val) {
    axios.post('{{ route('deals.ajaxStages') }}', {
                "pipeline": val
            })
          .then(function (response) {
            $("#stage-list").html(response.data);
          })
          .catch(function (error) {
            toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
});
}
</script>

@endpush

@stack('pagestyle')
@stack('pagescript')

@include('partial.ajaxify')