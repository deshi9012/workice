<div class="">
                    @foreach ($files as $key => $file)
                    <li class="list-group-item m-t-xs">
                        <i class="{{ getIcon($file->ext) }} fa-3x text-danger pull-left m-xs"></i>
                        <a href="{{  route('files.download', ['id' => $file->id] ) }}" data-rel="tooltip" title="@langapp('download')">{{ $file->title }}</a> 
                        <span class="text-muted pull-right small">@icon('solid/calendar-alt') {{ dateElapsed($file->created_at) }} 

                        </span>
                        <div class="text-muted">@parsedown($file->description)</div>
                        <div class="m-l-md text-muted text-semibold small">@langapp('size'): {{ $file->size }}KB 
                            <span class="pull-right">
                                @if(!isset($limit))
                                <span class="m-r-sm">{{ $file->filename }}</span>
                                @endif

                                @if (Auth::id() == $file->user_id) 
                                <a href="{{  route('files.edit', ['id' => $file->id])  }}" data-toggle="ajaxModal" class="m-l-xs">
                                    @icon('solid/pencil-alt')
                                </a>
                                @endif
                                @if(isAdmin() || can('files_delete') || Auth::id() == $file->user_id) 
                        <a href="{{  route('files.delete', ['id' => $file->id])  }}" data-toggle="ajaxModal" class="m-l-xs">
                                @icon('solid/trash-alt')
                        </a>
                        @endif
                        
                            </span>
                        </div>
                    </li>

                    @endforeach
  
                </div>