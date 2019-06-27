<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/trash-alt') @langapp('delete')</h4>
        </div>
        {!! Form::open(['route' => ['kb.destroy',$article->id] 'method' => 'DELETE']) !!}
        
        <div class="modal-body">
            <p>@langapp('delete') : {{  $article->subject  }}</p>

            @parsedown(str_limit($article->description, 200))

            <input type="hidden" name="id" value="{{  $article->id  }}">

        </div>
        <div class="modal-footer">

            {!! closeModalButton() !!}

            {!! okModalButton() !!}

            
        {!! Form::close() !!}
        </div>
    </div>
</div>