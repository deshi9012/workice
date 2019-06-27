<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('make_changes')  </h4>
        </div>
        {!! Form::open(['route' => ['files.update', $file->id], 'class' => 'bs-example form-horizontal ajaxifyForm', 'files' => true, 'method' => 'PUT']) !!}
        <input type="hidden" name="id" value="{{  $file->id  }}">
        <div class="modal-body">
            @php
            $icon = getIcon($file->ext);
            @endphp
            <div class="form-group">
                <div class="col-lg-3">
                    
                    <div class="file-icon icon-large pull-right"><i class="fas {{ $icon }} fa-5x"></i></div>
                    
                </div>
                <div class="col-lg-9">
                    <table class="table table-striped table-small">
                        <tbody>
                            <tr>
                                <td class="col-lg-3">@langapp('filename') </td>
                                <td><span class="text-ellipsis">{{ $file->filename }}</span></td>
                            </tr>
                            <tr>
                                <td>@langapp('size')  </td>
                                <td>{{ $file->size }}KB</td>
                            </tr>
                            @if ($file->is_image == 1)
                            <tr>
                                <td>@langapp('dimensions') </td>
                                <td>{{  $file->image_width }}x{{  $file->image_height }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td>@langapp('date') </td>
                                <td>
                                    {{ dateFormatted($file->created_at) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('title')  </label>
                <div class="col-lg-9">
                    <input name="title" class="form-control" value="{{ $file->title }}"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('description')  </label>
                <div class="col-lg-9">
                    <textarea name="description" class="form-control ta">{{ $file->description }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                {!! closeModalButton() !!}
                {!! renderAjaxButton() !!}
                
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@include('partial.ajaxify')