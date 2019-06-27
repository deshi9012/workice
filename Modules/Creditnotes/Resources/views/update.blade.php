@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">
        <aside>
            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-8 m-b-xs">
                            <a href="{{ route('creditnotes.view', ['id' => $creditnote->id]) }}" title="Back to Credit Note" data-rel="tooltip"
                                    data-placement="bottom" class="btn btn-{{ get_option('theme_color') }} btn-sm">
                                    @icon('regular/file-alt') @langapp('credit_note')  
                                </a>
                        </div>
                        <div class="col-sm-4 m-b-xs">
                        </div>
                    </div>
                </header>
                <section class="scrollable wrapper bg">
                    <div class="row">
                        {!! Form::open(['route' => ['credits.api.update', $creditnote->id], 'class' => 'bs-example ajaxifyForm', 'data-toggle' => 'validator', 'method' => 'PUT']) !!}
                        
                        <div class="col-md-6 form-horizontal">
                            <section class="panel panel-default">
                                <header class="panel-heading">@icon('solid/pencil-alt')
                                    @langapp('edit')   #{{  $creditnote->reference_no  }}
                                </header>
                                <div class="panel-body">
                                    <input type="hidden" name="id" value="{{  $creditnote->id  }}">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">@langapp('reference_no') @required</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="{{  $creditnote->reference_no  }}"
                                                name="reference_no" readonly required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">@langapp('client')   </label>
                                            <div class="col-md-9">
                                                <select class="select2-option form-control" name="client_id">
                                                    @foreach (classByName('clients')->select('id', 'name')->get() as $client)
                                                    <option value="{{  $client->id  }}" {{ $creditnote->client_id == $client->id ? 'selected="selected"' : '' }}>
                                                        {{ $client->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">@langapp('date')</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <input class="datepicker-input form-control" size="16" type="text"
                                                    value="{{  datePickerFormat($creditnote->created_at) }}"
                                                    name="created_at"
                                                    data-date-format="{{ get_option('date_picker_format') }}"
                                                    required>
                                                    <label class="input-group-addon btn" for="date">
                                                        @icon('solid/calendar-alt', 'text-muted')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">@langapp('tax')</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">%</span>
                                                    <input class="form-control money" type="text" value="{{  $creditnote->tax  }}"
                                                    name="tax">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">@langapp('currency')  </label>
                                            <div class="col-md-9">
                                                <select name="currency" class="select2-option width100">
                                                    @foreach (App\Entities\Currency::select('code', 'title')->get() as $cur)
                                                    <option value="{{  $cur->code  }}" {{  $creditnote->currency == $cur->code ? ' selected="selected"' : '' }}>{{ $cur->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        <label class="col-md-3 control-label">{{ langapp('xrate') }}</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon">-</span>
                                                <input class="form-control" type="text" value="{{ $creditnote->exchange_rate }}" name="exchange_rate"
                                                required>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">@langapp('status')  </label>
                                            <div class="col-md-9">
                                                <select name="status" class="form-control">
                                                    <option value="open"{{ $creditnote->status == 'open' ? ' selected' : '' }}>
                                                        Open
                                                    </option>
                                                    <option value="closed"{{ $creditnote->status == 'closed' ? ' selected' : '' }}>
                                                        Closed
                                                    </option>
                                                    <option value="void"{{ $creditnote->status == 'void' ? ' selected' : '' }}>
                                                        Void
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">@langapp('tags')  </label>
                                            <div class="col-md-9">
                                                <select class="select2-tags form-control" name="tags[]" multiple="multiple">
                                                    @foreach (App\Entities\Tag::all() as $tag)
                                                    <option value="{{  $tag->name  }}" {{  in_array($tag->id, array_pluck($creditnote->tags->toArray(), 'id')) ? ' selected="selected"' : '' }}>{{ $tag->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>

                            <div class="col-md-6">
                                <section class="panel panel-default">
                                <header class="panel-heading">@icon('solid/gavel') @langapp('terms')</header>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <textarea name="terms" data-hidden-buttons="cmdCode" class="form-control markdownEditor">{{ strip_tags($creditnote->terms) }}</textarea>
                                    </div>
                                    <span class="pull-right">{!! renderAjaxButton()  !!}</span>
                                </div>
                            </section>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </section>
            </section>
        </aside>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>

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