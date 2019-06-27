@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">
        <aside>
            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-8 m-b-xs">
                            @can('clients_create')
                            <a href="{{  route('clients.create')  }}"
                                class="btn btn-{{  get_option('theme_color') }} btn-sm" data-toggle="ajaxModal"
                                title="@langapp('new_company')  " data-placement="bottom">
                            @icon('solid/building') @langapp('new_client')  </a>
                            @endcan
                        </div>
                        <div class="col-sm-4 m-b-xs">
                            @admin
                            <a href="{{  route('estimates.export')  }}" class="pull-right btn btn-sm btn-{{  get_option('theme_color')  }}">
                            @icon('solid/cloud-download-alt') CSV</a>
                            @endadmin
                            @can('estimates_create')
                            <a href="{{  route('estimates.import')  }}" class="pull-right btn btn-sm btn-{{  get_option('theme_color')  }}" data-toggle="ajaxModal">
                                @icon('solid/cloud-upload-alt') @langapp('import')
                            </a>
                            @endcan
                        </div>
                    </div>
                </header>
                <section class="scrollable wrapper bg">
                    <div class="row">
                        {!! Form::open(['route' => 'estimates.api.save', 'class' => 'bs-example ajaxifyForm', 'data-toggle' => 'validator']) !!}
                        
                        <input type="hidden" name="is_visible" value="0">
                        <input type="hidden" name="reference_no" value="{{ generateCode('estimates') }}">
                        <div class="col-md-6">
                            <section class="panel panel-default">
                            <header class="panel-heading">@icon('solid/file-alt') @langapp('information')  </header>
                            <div class="panel-body">
                                

                                <div class="form-group">
                                    <label class="">@langapp('title')</label>
                                    
                                        <input type="text" name="title" placeholder="Website Project Estimate" class="input-sm form-control">
                                    
                                </div>

                                <div class="form-group">
                                    <label>@langapp('client') @required </label>
                                    <select class="select2-option form-control" name="client_id">
                                            @foreach (Modules\Clients\Entities\Client::select('id', 'name')->get() as $client)
                                            <option value="{{ $client->id }}" {!! $selectClient == $client->id ? 'selected' : '' !!}>{{ $client->name }}</option>
                                            @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                <label>@langapp('due_date')  </label>
                                <div class="input-group">
                                    <input class="datepicker-input form-control" size="16" type="text" value="{{  datePickerFormat(now()->addDays(30))  }}" name="due_date" data-date-format="{{  get_option('date_picker_format') }}"
                                    data-date-start-date="moment()" required>
                                    <label class="input-group-addon btn" for="date">
                                        @icon('solid/calendar-alt', 'text-muted')
                                    </label>
                                </div>
                                
                            </div>
                                <div class="form-group">
                                    <label>@langapp('currency')  </label>
                                    <select name="currency" class="form-control select2-option">
                                        @foreach(App\Entities\Currency::all() as $cur)
                                        <option value="{{  $cur->code  }}" {{ ($cur->code == get_option('default_currency')) ? 'selected' : '' }}>{{  $cur->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>@langapp('discount')  </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">-</span>
                                        <input class="form-control money" type="text" value="0.00" name="discount" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>@langapp('discount_percent')  </label>
                                    <select name="discount_percent" width="100%" class="form-control">
                                        <option value="1">Percentage</option>
                                        <option value="0">Amount</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>{{  get_option('tax1Label')  }} </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">%</span>
                                        <input class="form-control money" type="text"
                                        value="{{ get_option('default_tax') }}" name="tax" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ get_option('tax2Label') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">%</span>
                                        <input class="form-control money" type="text"
                                        value="{{ get_option('default_tax2') }}" name="tax2" required>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </section>
                    </div>
                    <div class="col-md-6">
                        <section class="panel panel-default">
                        <header class="panel-heading">@langapp('terms')  </header>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>@langapp('tags')  </label>
                                <select class="select2-tags form-control" name="tags[]" multiple>
                                    @foreach (App\Entities\Tag::all() as $tag)
                                    <option value="{{  $tag->name  }}">{{  $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>@langapp('notes')   </label>
                                <textarea name="notes"
                                class="form-control markdownEditor">{{  get_option('estimate_terms')  }}</textarea>
                            </div>

                            <div class="form-group">
                                    <label>@langapp('attach_deal')   @required </label>
                                    <select class="select2-option form-control" name="deal_id">
                                        <option value="0" selected>None</option>
                                            @foreach (Modules\Deals\Entities\Deal::select('id', 'title')->open()->get() as $deal)
                                            <option value="{{  $deal->id  }}">{{ $deal->title }}</option>
                                            @endforeach
                                    </select>
                                </div>

                            <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="new_deal" value="1">
                                        <span class="label-text">Create new deal and attach estimate</span>
                                    </label>
                            </div>

            @php 
                $data['fields'] = App\Entities\CustomField::estimates()->orderBy('order', 'desc')->get();
            @endphp
            @include('partial.customfields.createNoCol', $data)

                            <span class="pull-right">
                                {!!  renderAjaxButton()  !!}
                            </span>
                            {!! Form::close() !!}
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </section>
</aside>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a></section>
@push('pagestyle')
@include('stacks.css.datepicker')
@include('stacks.css.form')
@endpush
@push('pagescript')
@include('stacks.js.datepicker')
@include('stacks.js.form')
@include('stacks.js.markdown')
@endpush
@endsection