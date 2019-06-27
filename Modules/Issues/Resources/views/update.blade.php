<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('make_changes')  </h4>
        </div>

    {!! Form::open(['route' => ['issues.api.update', $issue->id], 'method' => 'PUT', 'class' => 'bs-example ajaxifyForm']) !!}
       
        <div class="modal-body">
            <input type="hidden" name="id" value="{{ $issue->id }}">
            <input type="hidden" name="project_id" value="{{ $issue->project_id }}">
            <input type="hidden" name="url" value="{{ url()->previous() }}">
            <div class="form-group">
                <label class="control-label">@langapp('code')</label>
                    <input type="text" class="form-control" value="{{ $issue->code }}" name="code"
                           readonly>
            </div>

            <div class="form-group">
                <label class="control-label">@langapp('subject')   @required</label>
                    <input type="text" class="form-control" value="{{ $issue->subject }}" name="subject">
            </div>

    @if (isAdmin() || $issue->AsProject->isTeam()) 
                <div class="form-group">
                    <label class="control-label">@langapp('reporter')   @required</label>
                        <select name="user_id" class="form-control select2-option">
                        @foreach (app('user')->select('id','username', 'name')->get() as $key => $user)
                        <option value="{{  $user->id  }}" {{ $user->id === $issue->user_id ? 'selected' : '' }}>{{ $user->name }}
                        </option>
                        @endforeach
                        </select>
                </div>
        @endif

            <div class="form-group">
                <label class="control-label">@langapp('priority')</label>
                    <select name="priority" class="form-control">
<option value="low" {{ $issue->priority === 'low' ? 'selected' : '' }}>@langapp('low')  </option>
<option value="medium" {{ $issue->priority === 'medium' ? 'selected' : '' }}>@langapp('medium')  </option>
<option value="high" {{ $issue->priority === 'high' ? 'selected' : '' }}>@langapp('high')  </option>
                    </select>
            </div>

            <div class="form-group">
                <label class="control-label">@langapp('status')</label>
                    <select name="status" class="form-control">
                        @foreach (App\Entities\Status::all() as $s)
                            <option value="{{ $s->id }}" {{ $issue->status == $s->id ? 'selected' : '' }}>{{ ucfirst($s->status) }}</option>
                        @endforeach
                        
                    </select>
            </div>

            <div class="form-group">
                <label class="control-label">@langapp('severity')</label>
                    <select name="severity" class="form-control">
<option value="@langapp('minor')  " {{ $issue->severity === 'minor' ? 'selected' : '' }}>@langapp('minor')  </option>
<option value="@langapp('major')  " {{ $issue->severity === 'major' ? 'selected' : '' }}>@langapp('major')  </option>
<option value="@langapp('show_stopper')  " {{ $issue->severity === 'show_stopper' ? 'selected' : '' }}>@langapp('show_stopper')  </option>
<option value="@langapp('must_be_fixed')  " {{ $issue->severity === 'must_be_fixed' ? 'selected' : '' }}>@langapp('must_be_fixed')  </option>
                    </select>
            </div>


             @can('users_assign')
                <div class="form-group">
                    <label class="control-label">@langapp('assigned')</label>
                        <select name="assignee" class="form-control select2-option">
                            <option value="-">@langapp('not_assigned')  </option>
                            @foreach ($issue->AsProject->assignees as $member) 
                                <option value="{{  $member->user->id  }}" {{  $issue->assignee === $member->user->id ? ' selected="selected"' : ''  }}>{{  $member->user->name }}</option>
                            @endforeach
                        </select>
                </div>
            @endcan

            @if (isAdmin() || $issue->AsProject->isTeam()) 

                <div class="form-group">
                    <label class="control-label">@langapp('tags')  </label>
                        <select class="select2-tags form-control" name="tags[]" multiple>
                                @foreach (App\Entities\Tag::all() as $tag)
                                <option value="{{ $tag->name  }}" {{  in_array($tag->id, array_pluck($issue->tags->toArray(), 'id')) ? ' selected="selected"' : '' }}>
                                    {{ $tag->name }}
                                </option>
                                @endforeach
                        </select>

                       
                </div>

            @endif


            <div class="form-group">
                <label class="control-label">@langapp('description') @required</label>
                        <textarea name="description" class="form-control markdownEditor"
                                  required>{{  $issue->description  }}</textarea>
            </div>

            <div class="form-group">
                <label class="control-label">@langapp('reproducibility') </label>
                        <textarea name="reproducibility" class="form-control markdownEditor"
                                  required>{{  $issue->reproducibility  }}</textarea>
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

@stack('pagestyle')
@stack('pagescript')