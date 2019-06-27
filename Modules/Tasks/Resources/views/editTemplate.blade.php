<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/pencil-alt') @langapp('make_changes')  </h4>
        </div>
        {!! Form::open(['route' => ['tasks.updateTemplate', $task->id], 'class' => 'bs-example form-horizontal ajaxifyForm', 'method' => 'put']) !!}
        
        <div class="modal-body">
            <input type="hidden" name="id" value="{{  $task->id  }}">
            <input type="hidden" name="visible" value="0">
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('task_name') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{  $task->name  }}" name="name" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('hourly_rate')</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $task->hourly_rate }}" name="hourly_rate">
                           <span class="help-block">Hourly rate e.g 50</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('estimated_hours')</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{  $task->estimated_hours  }}" name="estimated_hours">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('description') @required</label>
                <div class="col-lg-8">
                    <textarea name="description" class="form-control ta" required>{{ $task->description }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label"></label>
                <div class="col-lg-8">
                        <label class="">
                            <input name="visible" value="1" {{ $task->visible === 1 ? 'checked' : '' }} type="checkbox"> 
                            <span class="label-text">@langapp('visible_to_client')</span>
                        </label>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            {!! closeModalButton() !!}
            {!! renderAjaxButton()  !!}
            
        </div>
        {!! Form::close() !!}
    </div>

</div>

@include('partial.ajaxify')