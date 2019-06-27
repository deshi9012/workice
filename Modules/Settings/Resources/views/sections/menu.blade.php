<section class="panel panel-default">
    <header class="panel-heading">@icon('solid/list') @langapp('menu_settings')  </header>
    <div class="panel-body">


       
                <div class="table-responsive">
                    <table id="menu-main" class="table table-striped b-t b-light table-menu sorted_table">
                        <thead>
                        <tr>
                            <th></th>
                            <th class="col-xs-2">@langapp('icon')</th>
                            <th class="col-xs-8">@langapp('menu')</th>
                            <th class="col-xs-2">@langapp('visible')</th>
                        </tr>
                        </thead>
                        <tbody>

@php 
    $menu = App\Entities\Hook::with('children')->whereHook('main_menu')->orderBy('order', 'asc')->get();
@endphp
            @foreach ($menu as $adm) 
                      <tr class="sortable" data-module="{{  $adm->module  }}" data-access="1">
                                <td class="drag-handle">@icon('solid/bars')</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-default iconpicker-component" type="button">
                                            <i class="{{  $adm->icon  }} fa-fw"></i></button>
                                        <button data-toggle="dropdown" data-selected="{{  $adm->icon  }}"
                                                class="menu-icon icp icp-dd btn btn-default dropdown-toggle"
                                                type="button" aria-expanded="false" data-role="1"
                                                data-href="{{  route('menu.icon', ['module' => $adm->module])  }}">
                                            <span class="caret"></span>
                                        </button>
                                        <div class="dropdown-menu iconpicker-container"></div>
                                    </div>
                                </td>
                                <td>@langapp($adm->name)  </td>
                                <td>
                                    <a data-rel="tooltip" data-original-title="@langapp('toggle')  "
                                       class="menu-view-toggle btn btn-xs btn-{{  $adm->visible == 1 ? 'info' : 'default'  }}"
                                       href="#" data-role="1"
                                       data-href="{{  route('menu.visible', ['module' => $adm->module])  }}">
                                       @icon('solid/eye')
                                    </a>
                                </td>
                            </tr>
        @endforeach

                        </tbody>
                    </table>
                </div>
            
            
    </div>
</section>


@push('pagestyle')
<link rel="stylesheet" href="{{ getAsset('plugins/iconpicker/fontawesome-iconpicker.min.css') }}" type="text/css"/>
@endpush

@push('pagescript')
    @include('stacks.js.iconpicker')
    @include('stacks.js.menu')
    @include('stacks.js.sortable')
@endpush