@if(($project->setting('show_project_links') && $project->isClient()) || isAdmin() || $project->isTeam())
<section class="scrollable">
    @if(is_null($item))
    <section class="panel panel-default">
        <header class="header bg-white b-b clearfix">
            <div class="row m-t-sm">
                <div class="col-sm-12 m-b-xs">
                    @if(isAdmin() || can('links_create'))
                    <a href="{{ route('links.create', ['project' => $project->id]) }}" data-toggle="ajaxModal"
                        class="btn btn-sm btn-{{ get_option('theme_color') }}">
                    @icon('solid/globe') @langapp('create')</a>
                    @endif
                </div>
            </div>
        </header>
        <div class="panel-body">
            <ul class="media-list links-media">
                
                @foreach ($project->links as $key => $link)
                <li class="media">
                    <div class="media-left">
                        <a href="#"
                            class="btn border-primary text-primary btn-flat btn-icon btn-rounded btn-sm">
                            <img class="favicon no-margin" src="http://www.google.com/s2/favicons?domain={{ $link->url }}"/>
                        </a>
                    </div>
                    <div class="media-body">
                        <a href="{{ route('projects.view', ['id' => $link->project_id, 'tab' => 'links', 'item' => $link->id]) }}">{{ $link->title }}
                            @if (!empty($link->password))
                            @icon('solid/lock')
                            @endif
                        </a>
                        <span class="pull-right">
                            <a href="{{ route('links.edit', ['id' => $link->id]) }}"
                            data-toggle="ajaxModal">@icon('solid/pencil-alt')</a>
                            <a href="{{ route('links.pin', ['id' => $link->id]) }}"
                                title="@langapp('link_pin') "
                                class="{{ $project->client_id === $link->client_id ? 'text-danger' : 'text-muted' }}">
                                @icon('solid/map-pin')
                            </a>
                            
                        </span>
                        
                        @parsedown($link->description)
                        
                        <div class="media-annotation">
                            {{ $link->created_at ? dateElapsed($link->created_at) : '' }}
                        </div>
                    </div>
                </li>
                
                @endforeach
            </ul>
        </div>
    </section>
    @else
    <section class="panel panel-default">
        @php $link = Modules\Projects\Entities\Link::findOrFail($item); @endphp
        @if ($link->project_id == $project->id)
        <header class="header bg-white b-b clearfix">
            <div class="row m-t-sm">
                <div class="col-sm-12 m-b-xs">
                    @if(isAdmin() || $project->isTeam())
                    <a href="{{ route('links.edit', ['id' => $link->id]) }}"
                        data-toggle="ajaxModal"
                    class="btn btn-sm btn-{{ get_option('theme_color') }}">@langapp('edit') </a>
                    <a href="{{ route('links.delete', ['id' => $link->id]) }}"
                        data-toggle="ajaxModal" title="@langapp('delete')"
                        class="btn btn-sm btn-danger">
                        @icon('solid/trash-alt') @langapp('delete')
                    </a>
                    @endif
                </div>
            </div>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-7">
                    <ul class="list-group no-radius">
                        <li class="list-group-item">
                            <span class="pull-right">{{ $link->title  }} </span>@langapp('link_title')
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right"><a href="{{  $link->url  }}"
                            target="_blank">{{  $link->url  }} </a>
                        </span>@langapp('link_url')
                    </li>
                    <li class="list-group-item">
                        <span class="pull-right">{{ $link->project->name  }}</span>
                        @langapp('project')
                    </li>
                </ul>
            </div>
            <div class="col-lg-5">
                <ul class="list-group no-radius">
                    <li class="list-group-item">
                        <span class="pull-right">{{  $link->username  }}</span>@langapp('username')
                    </li>
                    <li class="list-group-item">
                        <span class="pull-right">
                            {{  $link->password  }}
                        </span>@langapp('password')
                    </li>
                </ul>
            </div>
        </div>
        <p>
        <blockquote class="small text-muted">@parsedown($link->description)</blockquote>
    </p>
</div>
@endif
</section>
@endif


</section>
@endif