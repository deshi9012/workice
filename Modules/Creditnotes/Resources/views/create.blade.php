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
                                class="btn btn-{{ get_option('theme_color') }} btn-sm" data-toggle="ajaxModal"
                                title="@langapp('new_company')  " data-placement="bottom">
                            @icon('solid/building') @langapp('new_client')  </a>
                            @endcan
                        </div>
                        <div class="col-sm-4 m-b-xs">
                        </div>
                    </div>
                </header>
                <section class="scrollable wrapper bg">
                    <div class="row">
                        {!! Form::open(['route' => 'credits.api.save', 'class' => 'bs-example ajaxifyForm', 'data-toggle' => 'validator']) !!}
                        
                        <div class="col-md-6">
                            <section class="panel panel-default">
                            <header class="panel-heading">@icon('regular/file-alt') @langapp('information')  </header>
                            <div class="panel-body">
                                <input type="hidden" name="exchange_rate" value="{{ xchangeRate() }}">
                                <input type="hidden" name="reference_no" value="{{ generateCode('credits') }}">
                                
                                
                                <div class="form-group">
                                    <label>@langapp('client') @required</label>
                                    <select class="select2-option form-control" name="client_id" required>
                                        @foreach (Modules\Clients\Entities\Client::select('id', 'name')->get() as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>@langapp('tax')   </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">%</span>
                                        <input class="form-control money" type="text" value="0.00" name="tax">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>@langapp('currency')  </label>
                                    <select class="select2-option form-control" name="currency">
                                        <option value="CL">@langapp('client_default_currency')  </option>
                                        @foreach (App\Entities\Currency::select('code', 'title')->get() as $cur)
                                        <option value="{{  $cur->code  }}">{{  $cur->title  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>@langapp('tags')</label>
                                    <select class="select2-tags form-control" name="tags[]" multiple="multiple">
                                        @foreach (App\Entities\Tag::all() as $tag)
                                        <option value="{{  $tag->name  }}">{{  ucfirst($tag->name)  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <section class="panel panel-default">
                            <header class="panel-heading"> @langapp('terms')  </header>
                            <div class="panel-body">
                                <div class="form-group terms">
                                    <textarea name="terms" data-hidden-buttons="cmdCode" class="form-control markdownEditor">{{ get_option('creditnote_terms') }}</textarea>
                                </div>
                                <span class="pull-right">{!! renderAjaxButton() !!}</span>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </section>
</section>
</aside>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen"
data-target="#nav"></a>
</section>
@push('pagestyle')
@include('stacks.css.form')
@include('stacks.css.datepicker')
@endpush
@push('pagescript')
@include('stacks.js.form')
@include('stacks.js.markdown')
@include('stacks.js.datepicker')
@endpush
@endsection