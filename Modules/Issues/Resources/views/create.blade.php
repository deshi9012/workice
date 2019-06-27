<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/plus') @langapp('create')  </h4>
        </div>
        {!! Form::open(['route' => 'issues.api.save', 'class' => 'bs-example ajaxifyForm']) !!}
        
        <div class="modal-body">
            <input type="hidden" name="project_id" value="{{  $project->id  }}">
            <input type="hidden" name="status" value="{{  $status  }}">
            <input type="hidden" name="user_id" value="{{  Auth::id()  }}">
            <input type="hidden" name="url" value="{{ url()->previous() }}">
            

            <div class="form-group">
                <label class="control-label">@langapp('subject') @required </label>
                    <input type="text" class="form-control" placeholder="@langapp('subject')" name="subject" required>
            </div>

            @if (isAdmin() || $project->isTeam()) 
                <div class="form-group">
                    <label class="control-label">@langapp('reporter') @required</label>
                        <select name="user_id" class="form-control select2-option">
                            @foreach (classByName('users')->select('id', 'username', 'name')->get() as $key => $user) 
                                <option value="{{  $user->id  }}">{{  $user->name  }}</option>
                            @endforeach
                        </select>
                </div>
            @endif

            <div class="form-group">
                <label class="control-label">@langapp('status')</label>
                    <select name="status" class="form-control">
                        @foreach (App\Entities\Status::all() as $s)
                            <option value="{{ $s->id }}" {{ $status == $s->id ? 'selected' : '' }}>{{ ucfirst($s->status) }}</option>
                        @endforeach
                        
                    </select>
            </div>

            <div class="form-group">
                <label class="control-label">@langapp('priority')</label>
                    <select name="priority" class="form-control">
                        <option value="low">@langapp('low')  </option>
                        <option value="medium">@langapp('medium')  </option>
                        <option value="high">@langapp('high')  </option>
                    </select>
            </div>

            <div class="form-group">
                <label class="control-label">@langapp('severity')</label>
                    <select name="severity" class="form-control">
                        <option value="@langapp('minor')">@langapp('minor')  </option>
                        <option value="@langapp('major')">@langapp('major')  </option>
                        <option value="@langapp('show_stopper')">@langapp('show_stopper')  </option>
                        <option value="@langapp('must_be_fixed')">@langapp('must_be_fixed')  </option>
                    </select>
            </div>

            @can('users_assign')
                <div class="form-group">
                    <label control-label">@langapp('assigned')</label>
                        <select name="assignee" class="form-control select2-option">
                            <option value="0">@langapp('not_assigned')  </option>
                            @foreach ($project->assignees as $member) 
                                <option value="{{ $member->user_id  }}">
                                {{  $member->user->name  }}
                                </option>
                            @endforeach
                        </select>
                    
                </div>

            @endcan

            @if (isAdmin() || $project->isTeam()) 

                <div class="form-group">
                    <label control-label">@langapp('tags')  </label>
                        <select class="select2-tags form-control" name="tags[]" multiple="multiple">
                        @foreach (App\Entities\Tag::all() as $tag)
                        <option value="{{  $tag->name  }}">{{  $tag->name }}</option>
                        @endforeach
                    </select>
                    
                </div>
            @endif

            <div class="form-group">
                <label control-label">@langapp('description') @required</label>
                    <textarea name="description" class="form-control markdownEditor" required></textarea>
                
            </div>

            <div class="form-group">
                <label control-label">@langapp('reproducibility') @required</label>
               
                    <textarea name="reproducibility" class="form-control markdownEditor" required></textarea>
                
            </div>

           


        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            {!! renderAjaxButton() !!}
            
        </div>

        {!! Form::close() !!}
    </div>
</div>

@push('pagestyle')
    @include('stacks.css.form')
@endpush
@push('pagescript')
    @include('stacks.js.form')
    @include('stacks.js.markdown')
    @include('partial.ajaxify')
@endpush

@stack('pagescript')
@stack('pagestyle')