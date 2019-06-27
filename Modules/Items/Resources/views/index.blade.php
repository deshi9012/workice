@extends('layouts.app')
@section('content')
<section id="content" class="bg">
    <section class="vbox">
        <header class="header panel-heading bg-white b-b b-light">
            <a href="{{ route('tasks.template') }}" data-toggle="ajaxModal"
                class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right">
                @icon('solid/tasks') @langapp('tasks')
            </a>
            <a href="{{ route('items.create') }}" data-toggle="ajaxModal"
                class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right">
                @icon('solid/list') @langapp('items')
            </a>
            
        </header>
        <section class="scrollable wrapper">
            
                <div class="tabbable">
                    <ul class="nav nav-tabs nav-tabs-highlight">
                        <li class="active"><a href="#itemstab" data-toggle="tab">Product Items</a></li>
                        <li><a href="#taskstab" data-toggle="tab">Task Templates</a></li>
                        
                    </ul>
                    <div class="tab-content">
                        
                        <div class="tab-pane active" id="itemstab">
                            
                            <section class="panel panel-default">
                            <div class="table-responsive">
                                <table  class="table table-striped" id="table-item-template">
                                    <thead>
                                        <tr>
                                            <th class="hide"></th>
                                            <th>@langapp('product')  </th>
                                            <th class="col-currency">{{ itemUnit() }}</th>
                                            <th>@langapp('tax_rate')   </th>
                                            <th>@langapp('qty')   </th>
                                            <th class="no-sort"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Modules\Items\Entities\Item::templates()->get() as $key => $item)
                                        <tr>
                                            <td class="display-none">{{ $item->id }}</td>
                                            <td>
                                                <a class="text-muted" href="#" data-original-title="{{  $item->description  }}"
                                                    data-toggle="tooltip" data-placement="right" title="">
                                                    {{  str_limit($item->name, 50)  }}
                                                </a>
                                            </td>
                                            <td>
                                            {{ formatCurrency(get_option('default_currency'), $item->unit_cost) }}</td>
                                            <td>{{ $item->tax_rate }}%</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>
                                                <a href="{{ route('items.edit', ['id' => $item->id]) }}" data-toggle="ajaxModal" class="m-l-xs">
                                                    @icon('solid/pencil-alt')
                                                </a>
                                                <a href="{{ route('items.delete', ['id' => $item->id]) }}" data-toggle="ajaxModal" class="m-l-xs">
                                                    @icon('solid/trash-alt')
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        </div>
                        <div class="tab-pane" id="taskstab">
                            <section class="panel panel-default">

                            <div class="table-responsive">
                                <table id="table-tasks-template" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>@langapp('task_name')</th>
                                            <th>@langapp('hourly_rate')</th>
                                            <th>@langapp('visible')</th>
                                            <th>@langapp('estimated_hours')</th>
                                            <th class="no-sort"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Modules\Tasks\Entities\Task::templates()->get() as $key => $task)
                                        <tr>
                                            <td>
                                                <a class="text-muted" href="#"
                                                    data-original-title="{{  $task->description  }}" data-toggle="tooltip"
                                                    data-placement="right">
                                                {{ str_limit($task->name, 50) }}</a></td>
                                                <td class="">{{ $task->hourly_rate  }}/ hr</td>
                                                <td>{{ $task->visible === 1 ? langapp('yes') : langapp('no') }}</td>
                                                <td><strong>{{ $task->estimated_hours }} @langapp('hours') </strong></td>
                                                <td>
                                                    <a href="{{ route('tasks.editTemplate', ['id' => $task->id]) }}" data-toggle="ajaxModal" class="m-l-xs">
                                                        @icon('solid/pencil-alt')
                                                    </a>
                                                    <a href="{{ route('tasks.deleteTemplate', ['id' => $task->id]) }}" data-toggle="ajaxModal" class="m-l-xs">
                                                        @icon('solid/trash-alt')
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </section>
                                
                            </div>
                            
                        </div>
                    </div>

            </section>
        </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>

@push('pagestyle')
    @include('stacks.css.datatables')
@endpush

@push('pagescript')
@include('stacks.js.datatables')

<script>
$(function() {
$('#table-item-template').DataTable({
    processing: true,
    order: [[ 0, "desc" ]],
});
$('#table-tasks-template').DataTable({
    processing: true,
    order: [[ 0, "desc" ]],
});
});
</script>
@endpush
@endsection