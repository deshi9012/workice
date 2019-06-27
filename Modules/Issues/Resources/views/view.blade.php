<section class="panel panel-default">
    <header class="header bg-white b-b clearfix">
        <div class="row m-t-sm">
            <div class="col-sm-12 m-b-xs">
                @if(can('files_create') || isAdmin())
                <a href="{{  route('files.upload', ['module' => 'issues', 'id' => $issue->id])  }}" data-toggle="ajaxModal" class="btn btn-sm btn-{{get_option('theme_color')}}">
                    @icon('solid/cloud-upload-alt') @langapp('upload_file')
                </a>
                @endif
                @if (isAdmin() || $project->isTeam() || $issue->user_id === Auth::id())
                <a href="{{  route('issues.edit', $issue->id)  }}" data-toggle="ajaxModal"
                class="btn btn-sm btn-{{  get_option('theme_color')  }}">@icon('solid/pencil-alt') @langapp('edit')</a>
                <a href="{{  route('issues.delete', $issue->id)  }}" data-toggle="ajaxModal"
                class="pull-right btn btn-sm btn-danger">@icon('solid/trash-alt') @langapp('delete')</a>
                @endif
                
            </div>
        </div>
    </header>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-body">
                        <aside class="col-lg-4 b-r">
                            <section class="scrollable">
                                <div class="wrapper">
                                    <div class="clearfix m-b">
                                        @if($issue->assignee > 0)
                                        <a href="#" class="pull-left thumb m-r">
                                            <img src="{{ optional($issue->agent)->profile->photo  }}" class="img-circle"
                                            data-toggle="tooltip"
                                            data-title="{{  optional($issue->agent)->name  }}"
                                            data-placement="bottom">
                                        </a>
                                        @endif
                                        <div class="clear">
                                            <div class="text-bold text-wrap">{{ $issue->subject }}</div>
                                            <div class="text-muted">@icon('regular/user-circle') {{ optional($issue->agent)->name }}</div>
                                        </div>
                                    </div>
                                    <div class="panel wrapper panel-success">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <span class="m-b-xs block">@langapp('reporter')</span>
                                                <small class="text-muted">{{  $issue->user->name  }}</small>
                                            </div>
                                            <div class="col-xs-6">
                                                <span class="m-b-xs block">@langapp('status')</span>
                                                <small class="label label-primary">{{ ucfirst($issue->AsStatus->status) }}</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                    
                                        <small class="text-uc text-xs text-muted">@langapp('severity')</small>
                                        <p>{{ $issue->severity }}</p>
                                        <small class="text-uc text-xs text-muted">@langapp('date')</small>
                                        <p>
                                            <label class="label label-success">
                                                {{ dateFormatted($issue->created_at) }}
                                            </label>
                                        </p>
                                        <small class="text-uc text-xs text-muted">@langapp('priority')  </small>
                                        <p>
                                            <label class="label label-danger">
                                                {{  strtoupper($issue->priority)  }}
                                            </label>
                                        </p>
                                        <span class="text-uc text-xs text-muted">@langapp('description')</span>
                                        <span class="text-wrap">@parsedown($issue->description)</span>
                                        <small class="text-uc text-xs text-muted">@langapp('reproducibility')</small>
                                        <span class="text-wrap">@parsedown($issue->reproducibility)</span>
                                        
                                        

                                        <div class="m-xs"></div>
                                        
                                        <small class="text-uc text-muted">@icon('solid/shield-alt')
                                        @langapp('vaults')
                                        <a href="{{ route('extras.vaults.create', ['module' => 'issues', 'id' => $issue->id]) }}" class="btn btn-xs btn-danger pull-right" data-toggle="ajaxModal">@icon('solid/plus')</a>
                                        </small>
                                        <div class="line"></div>
                                        @widget('Vaults\Show', ['vaults' => $issue->vault])
                                        @admin
                                        
                                        <small class="text-uc text-muted">@icon('solid/tags') @langapp('tags')</small>
                                        <div class="line"></div>
                                        
                                        @php
                                        $data['tags'] = $issue->tags;
                                        @endphp
                                        @include('partial.tags', $data)

                                        @if (count((array)$issue->meta))
                                            <small class="text-uc text-xs text-muted">Metadata</small>
                                            <div class="line"></div>
                                            @foreach ($issue->meta['tags'] as $meta)
                                                <small class="text-uc text-xs text-muted">{{ $meta[0] }}</small>
                                                <p class="text-wrap">{{ $meta[1] }}</p>
                                            @endforeach
                                        @endif

                                        
                                        
                                        @endadmin

                                        </div>
                                        
                                </div>
                            </section>
                        </aside>
                        <aside class="col-lg-8">



                             <div id="tabs">
    <ul class="nav nav-tabs" id="prodTabs">
        <li class="active"><a href="#tab_comments">@langapp('comments')</a></li>
        <li><a href="#tab_files" data-url="/issues/ajax/files/{{ $issue->id }}">@langapp('files')</a></li>
    </ul>
    <div class="tab-content">
        <div id="tab_comments" class="tab-pane active">
            <section class="comment-list block">
                                <article class="comment-item" id="comment-form">
                                    <a class="pull-left thumb-sm avatar">
                                        <img src="{{ avatar() }}" class="img-circle">
                                    </a>
                                    <span class="arrow left"></span>
                                    <section class="comment-body">
                                        <section class="panel panel-default">
                                            @widget('Comments\CreateWidget', ['commentable_type' => 'issues' , 'commentable_id' => $issue->id, 'hasFiles' => true])
                                            
                                            
                                        </section>
                                    </section>
                                </article>
                                
                                @widget('Comments\ShowComments', ['comments' => $issue->comments])  
                                
            </section>
        </div>
        <div id="tab_files" class="tab-pane active"></div>
    </div>
</div>



</aside>
                </div>
            </section>
        </div>
        
    </div>
</section>
@push('pagescript')
@include('stacks.js.markdown')
@include('comments::_ajax.ajaxify')

<script>
    $('#tabs').on('click','.tablink,#prodTabs a',function (e) {
        e.preventDefault();
        var url = $(this).attr("data-url");
        if (typeof url !== "undefined") {
            var pane = $(this), href = this.hash;
            $(href).load(url,function(result){      
                pane.tab('show');
            });
        } else {
            $(this).tab('show');
        }
    });
    </script>

@endpush