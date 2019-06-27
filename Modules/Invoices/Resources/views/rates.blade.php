@extends('layouts.app')
@section('content')
<section id="content" class="bg">
    <section class="vbox">
        <header class="header panel-heading bg-white b-b b-light">
            @can('taxes_create')
            <a href="{{ route('rates.create') }}" data-toggle="ajaxModal"
                class="btn btn-sm btn-{{  get_option('theme_color')  }} pull-right">
                @icon('solid/plus') @langapp('create')
            </a>
            @endcan
            
        </header>
        <section class="scrollable wrapper">
            <section class="panel panel-default">
                
                <div class="table-responsive">
                    <table class="table table-striped" id="rates-table">
                        <thead>
                            <tr>
                                <th>@langapp('name')</th>
                                <th>@langapp('tax_rate')</th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rates as $key => $r)
                            <tr>
                                <td>{{ $r->name }}</td>
                                <td>{{ $r->rate }} %</td>
                                <td>
                                    @can('taxes_update')
                                    <a class="btn btn-{{ get_option('theme_color') }} btn-sm"
                                        href="{{ route('rates.edit', ['id' => $r->id])  }}"
                                        data-toggle="ajaxModal"
                                    title="@langapp('edit')  ">@langapp('edit')  </a>
                                    @endcan
                                    @can('taxes_delete')
                                    <a class="btn btn-dark btn-sm"
                                        href="{{  route('rates.delete', ['id' => $r->id])  }}"
                                        data-toggle="ajaxModal"
                                    title="@langapp('delete')">@langapp('delete')  </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a></section>
    @push('pagestyle')
    @include('stacks.css.datatables')
    @endpush
    @push('pagescript')
    @include('stacks.js.datatables')
    <script>
    $(function() {
    $('#rates-table').DataTable({
    processing: true,
    });
    });
    </script>
    @endpush
    @endsection