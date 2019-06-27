<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@langapp('make_changes')  </h4>
            </div>

            {!! Form::open(['route' => ['links.update', $link->id], 'method' => 'PUT', 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}

            <input type="hidden" name="id" value="{{  $link->id  }}">
            <div class="modal-body">

                <div class="form-group">
                    <label class="col-lg-4 control-label">@langapp('link_title') @required</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" value="{{  $link->title  }}" name="title"
                               required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">@langapp('link_url') @required</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" value="{{  $link->url  }}" name="url">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">@langapp('description') </label>
                    <div class="col-lg-8">
                        <textarea name="description" class="form-control ta">{{  $link->description  }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">@langapp('username')  </label>
                    <div class="col-lg-8">
                        <input type="text" autocomplete="off" class="form-control" value="{{  $link->username  }}"
                               name="username">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">@langapp('password')  </label>
                    <div class="col-lg-8">
                        <input type="text" autocomplete="off" class="form-control" value="{{  $link->password  }}"
                               name="password">
                    </div>
                </div>

            </div>
            <div class="modal-footer">

                {!!  closeModalButton() !!}
                {!!  renderAjaxButton() !!}
                

            </div>
            {!! Form::close() !!}
        </div>
    </div>

@include('partial.ajaxify')
