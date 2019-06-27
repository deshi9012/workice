<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@langapp('create')  </h4>
            </div>

            {!! Form::open(['route' => 'links.save', 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}

            <input type="hidden" name="project_id" value="{{ request()->route('project') }}">
            <input type="hidden" name="user_id" value="{{  Auth::id() }}">

            <div class="modal-body">

                <div class="form-group">
                    <label class="col-lg-4 control-label">@langapp('link_url') @required</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" placeholder="https://" name="url" required>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">@langapp('link_title')   </label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" placeholder="@langapp('link_title')"
                               name="title">
                        <small class="block small text-muted">@langapp('add_link_auto')  </small>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">@langapp('description')   </label>
                    <div class="col-lg-8">
                            <textarea name="description" class="form-control ta" placeholder="@langapp('description')  "></textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                {!! closeModalButton() !!}
                {!!  renderAjaxButton()  !!}
                
            </div>

            {!! Form::close() !!}
        </div>

    </div>

@include('partial.ajaxify')
