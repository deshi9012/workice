@extends('layouts.app') 

@section('content')


<section id="content">
    <section class="hbox stretch">
        <aside>
            <section class="vbox">
                <section class="scrollable wrapper">
                    <section class="panel panel-default">

                        <header class="panel-heading">

                            @include('analytics::report_header')

                        </header>

                        <div class="panel-body">



<?php
$start_date = date('F d, Y', strtotime($range[0]));
$end_date = date('F d, Y', strtotime($range[1]));
?>


                                <section class="panel panel-default">
                                    <header class="panel-heading">@langapp('clients_reports')</header>
                                    <div class="row wrapper analytics">
                                        <div class="col-sm-12 m-b-xs">
                                            <form>

                                                <div class="inline v-middle col-md-4">

                                                    <input type="text" class="form-control" id="reportrange" name="range">
                                                </div>

                                                <select class="form-control input-s-sm inline v-middle" required>
                                                    <option value="">{{ __('Type') }}</option>
                                                    <option value="1">{{ __('Individual') }}</option>
                                                    <option value="0">@langapp('company')</option>
                                                </select>

                                                    <select class="form-control input-s-sm inline v-middle" required>
                                                            <option value="">@langapp('currency')</option>
                                                            @foreach (Modules\Clients\Entities\Client::groupBy('currency')->select('id','currency')->get() as $client)
                                                            <option value="{{ $client->currency }}">{{ $client->currency }}</option>
                                                            @endforeach
                                                    </select>

                                                    
                                                


                                                <a class="btn btn-{{ get_option('theme_color') }} btn-sm" type="submit">
                                                    @langapp('go')
                                                </a>



                                            </form>

                                        </div>


                                    </div>
                                    
                                    
                                    <div class="table-responsive">
                                        <table class="table table-striped b-t b-light">
                                            <thead>
                                                <tr>
                                                    <th>@langapp('name') </th>
                                                    <th>@langapp('contact_person') </th>
                                                    <th>@langapp('email') </th>
                                                    <th>@langapp('city') </th>
                                                    <th>@langapp('country') </th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (Modules\Clients\Entities\Client::with('contact')->get()->take(10) as $client)

                                                <tr>
                                                        <td><a href="{{ route('clients.view', ['id' => $client->id]) }}">{{ $client->name }}</a></td>
                                                        <td>{{ optional($client->contact)->name }}</td>
                                                        <td><a href="{{ route('clients.email', ['id' => $client->id]) }}" data-toggle="ajaxModal">{{ $client->email }}</a></td>
                                                        <td>{{ $client->city }}</td>
                                                        <td class="text-ellipsis">{{ $client->country }}</td>
    
                                                    </tr>
                                                    
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    

                                
                                    


                                </section>











                        </div>

                    </section>
                </section>


            </section>
        </aside>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>

@include('analytics::_daterangepicker')

@endsection