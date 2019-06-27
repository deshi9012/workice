<div class="panel panel-body border-top-teal">


            {!! Form::open(['route' => 'notes.save', 'class' => 'ajaxifyForm']) !!}
            <input type="hidden" name="noteable_type" value="{{ $noteable_type }}">
            <input type="hidden" name="noteable_id" value="{{  $noteable_id  }}">
            <input type="hidden" name="user_id" value="{{  \Auth::id()  }}">
            <input type="hidden" name="name" value="{{ $title }}">
            <div class="form-group">
                <label>@langapp('take_notes')</label>
                <textarea name="description" class="form-control markdownEditor"></textarea>
            </div>
            <div class="text-right">
                {!!  renderAjaxButton() !!}
            </div>
            {!! Form::close() !!}



            <div class="streamline streamline-dotted m-t-lg list-feed">

                
                @foreach ($notes as $note)
                <div class="sl-item b-success" id="note-{{ $note->id }}">
                    <div class="sl-icon"><i class="fas fa-file-alt"></i></div>
                    <div class="sl-content text-muted">

                        <div class="sl-author">{{ $note->user->name }}</div>

                <span class="pull-right sl-date">
                <a href="{{  route('notes.edit', ['id' => $note->id])  }}" data-toggle="ajaxModal" class="m-r-xs">
                    @icon('solid/pencil-alt')
                </a>
                <a href="#" rel="tooltip" class="text-muted noteDelete" data-note-id="{{ $note->id }}" title="@langapp('delete')">
                   @icon('solid/trash-alt')
                </a>
                </span>

                        <div class="sl-date text-muted">
                           @icon('solid/calendar-alt')
                            {{ $note->created_at->diffForHumans() }}
                        </div>

                        @parsedown($note->description)

                    <small class="sl-footer text-muted small">
                        @icon('solid/calendar-alt') {{ dateTimeFormatted($note->created_at) }}
                    </small>

                    </div>



                </div>
                @endforeach
               
        </div>

</div>

 @push('pagescript')
    <script>
        $('.list-feed').on('click', '.noteDelete', function (e) {
            e.preventDefault();
            var tag, url, id, request;

            tag = $(this);
            id = tag.data('note-id');
            url = '/notes/destroy-note/' + id;

            if (!confirm('Do you want to delete this note?')) {
                return false;
            }

            axios.post(url, {
                "id": id
            })
          .then(function (response) {
            toastr.info(response.data.message, "@langapp('notification') ");
                    $('#note-' + id).hide(500, function () {
                        $(this).remove();
                    });
          })
          .catch(function (error) {
            toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
        });

            
        });
        
    </script>

    @endpush