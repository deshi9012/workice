@foreach ($contacts->chunk(4) as $chunk)
    <div class="row">
        @foreach ($chunk as $contact)
            <div class="col-lg-3 col-md-6">
              <div class="thumbnail">
                <div class="thumb thumb-rounded">
                  <a href="{{ route('contacts.view', $contact->user_id) }}">
                    <img src="{{ $contact->photo }}" alt="" class="avatar-img">
                  </a>
                  
                </div>
              
                  <div class="caption text-center">
                    <h6>
                      <a href="{{ route('contacts.view', $contact->user_id) }}" >
                        {{ $contact->name }} 
                      </a>
                      <span class="display-block text-muted m-xs">{{ $contact->job_title }}</span>
                      @if($contact->company > 0)
                      <span class="display-block text-muted m-xs">{{ optional($contact->business)->name }}</span>
                      @endif

                    </h6>

    <p class="m-t-sm">
      
       @if(!empty($contact->twitter))
       <a href="{{ $contact->twitter }}" target="_blank" class="btn btn-rounded btn-twitter btn-icon">@icon('brands/twitter')</a>
       @endif
       @if(!empty($contact->skype))
       <a href="skype:{{ $contact->skype }}?call" class="btn btn-rounded btn-info btn-icon">@icon('brands/skype')</a>
       @endif
    <a href="{{ route('contacts.email', $contact->user_id) }}" class="btn btn-rounded btn-dracula btn-icon" data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('send_email')">@icon('solid/paper-plane')</a>
                          
    </p>

                    
                  </div>
                </div>
            </div>
        @endforeach
    </div>
    @endforeach