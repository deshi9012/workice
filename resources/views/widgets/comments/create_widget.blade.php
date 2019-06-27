{!! Form::open(['route' => 'comments.create', 'novalidate' => '', 'id' => 'sendComment', 'files' => true]) !!}
<input type="hidden" name="commentable_id" value="{{ $commentable_id }}">
<input type="hidden" name="commentable_type" value="{{ $commentable_type }}">
<input type="hidden" name="user_id" value="{{ Auth::id() }}">
<textarea class="form-control markdownEditor" name="message" id="comment-editor" data-id="{{ $commentable_id }}" required {{ isCommentLocked($commentable_type, $commentable_id) ? 'disabled' : '' }}></textarea>
@if($cannedResponse)
<div class="m-xs">
    @if(count(Auth::user()->cannedResponses) > 0)
    <select name="selectCanned" class="form-control m-b" id="insertCannedResponse" onChange="insertMessage(this.value);">
        <option value="0">--- @langapp('canned_responses') ---</option>
        @foreach (Auth::user()->cannedResponses as $template)
        <option value="{{ $template->id }}">{{ $template->subject }}</option>
        @endforeach
    </select>
    @endif
</div>
@endif
@if ($hasFiles)
<input type="file" class="form-control no-border" name="uploads[]" multiple="" id="file-upload">
@endif

@if($commentable_type === 'tickets')
<div class="form-group">
    <div class="checkbox">
        <label>
            <input type="checkbox" name="reply_close" value="1">
            <span class="label-text">@langapp('reply_close')</span>
        </label>
    </div>
</div>
@endif
<footer class="panel-footer bg-light lter">
    
    {!!  renderAjaxButton('comment', 'fas fa-comment-dots')  !!}
<ul class="nav nav-pills nav-sm"></ul>
</footer>
{!! Form::close() !!}
@if($cannedResponse)
<script type="text/javascript">
function insertMessage(d) {
axios.post('{{ route('extras.canned_responses') }}', {
    "response_id": d
})
.then(function (response) {
    $("textarea#comment-editor").val(response.data.message);
})
.catch(function (error) {
    toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
});
}
</script>
@endif