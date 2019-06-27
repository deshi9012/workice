<div class="lobilist-wrapper ps-container ps-theme-dark ps-active-y kanban-col">
    <div id="lobilist-list-0"
        class="lobilist lobilist-default">
        <div class="lobilist-header ui-sortable-handle">
            <div class="lobilist-title text-ellipsis">
                <span class="arrow right"></span>📆 @langapp('tomorrow') - <span class="small text-muted">{{ now()->tomorrow()->toFormattedDateString() }}</span>
            </div>
        </div>
        <div class="lobilist-body scrumboard slim-scroll" data-height="450" data-disable-fade-out="true"
            data-distance="0" data-size="5px"
            data-color="#333333">
            
            <ul class="lobilist-items ui-sortable list" id="today">
                @php $todoCounter = 0; @endphp
                @foreach (Auth::user()->tomorrow()->pending()->get() as $todo)
                <li id="{{  $todo->id  }}" class="lobilist-item kanban-entry grab dd-item">
                    <div class="lobilist-item-title text-ellipsis font14">
                        <a href="{{ $todo->todoable_url }}" class="">{{  $todo->subject  }}</a>
                    </div>
                    <div class="lobilist-item-description text-muted">
                        <small class=""><i class="fa fa-clock-o text-muted"></i>
                        {{ !empty($todo->due_date) ? dateElapsed($todo->due_date) : '' }}
                        </small>
                        <span class="pull-right">
                            <div class="form-check text-muted">
                                <label>
                                    <input type="checkbox" class="checkItem" data-id="{{ $todo->id }}">
                                    <span class="label-text"></span>
                                </label>
                            </div>
                        </span>
                    </div>
                    <div class="lobilist-item-duedate">
                        {{ dateFormatted($todo->due_date) }}
                    </div>
                    <span class="thumb-xs avatar lobilist-check">
                        <img src="{{ $todo->agent->profile->photo }}" data-rel="tooltip" title="{{ $todo->agent->name }}" data-placement="right" class="img-circle">
                    </span>
                    
                    
                </li>
                @php $todoCounter++; @endphp
                @endforeach
            </ul>
            
        </div>
        <div class="lobilist-footer">
            <strong>
            {{ Auth::user()->tomorrow()->done()->count() }} @langapp('done')
            </strong>
            <strong class="pull-right">
            {{ $todoCounter }} @langapp('pending')
            </strong>
        </div>
    </div>
</div>