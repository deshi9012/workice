@foreach ($emails as $email)
<div class="padder m-t">
  <div class="block clearfix m-b">
    <div class="m-t-xs {{ $email->opened > 0 ? 'text-success' : 'text-dracula' }}">@icon('regular/envelope-open') {{ $email->subject }}
      <span class="pull-right small">@icon('solid/clock') {{ dateElapsed($email->created_at) }} <a href="{{ route('email.delete', ['id' => $email->id]) }}" data-toggle="ajaxModal">@icon('solid/trash-alt')</a></span>
    </div>
    <div class="line pull-in"></div>
    
  </div>
  
  @parsedown($email->message)
  @include('partial._show_files', ['files' => $email->files])
  
</div>
@endforeach