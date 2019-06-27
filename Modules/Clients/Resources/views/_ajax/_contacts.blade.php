@foreach ($contacts->chunk(4) as $chunk)
    <div class="row">
        @foreach ($chunk as $contact)
            <div class="col-lg-3 col-md-6">
              <div class="thumbnail">
                <div class="thumb thumb-rounded">
                  <a href="{{ route('contacts.view', $contact->user_id) }}"><img src="{{ $contact->photo }}" alt=""></a>
                  
                </div>
              
                  <div class="caption text-center">
                    <h6 class="text-semibold">
                      <a href="{{ route('contacts.view', $contact->user_id) }}">
                        {{ $contact->user->name }} 
                      </a>
                      <span class="display-block text-muted m-xs">{{ $contact->job_title }}</span>
                      @if($contact->company > 0)
                      <span class="display-block text-muted m-xs">{{ optional($contact->business)->name }}</span>
                      @endif

                    </h6>

    <p class="m-t-sm">

     

      @can('clients_update')
                        <a href="{{ route('contacts.primary', ['id' => $contact->company, 'user' => $contact->user_id]) }}"
                                   class="btn btn-{{ optional($contact->business)->primary_contact === $contact->user_id ? 'success' : 'default' }} btn-rounded btn-icon" data-rel="tooltip" title="@langapp('contact_person')">
                                   @icon('regular/user-circle')
                        </a>

                        <a href="{{  route('contacts.edit', ['id' => $contact->user_id])  }}"
                                   class="btn btn-default btn-rounded btn-icon" data-rel="tooltip" title="@langapp('edit')" data-toggle="ajaxModal">
                                    @icon('solid/pencil-alt') 
                        </a>

      @endcan

        @can('users_delete')
                                <a href="{{  route('users.delete', ['id' => $contact->user_id]) }}"
                                   class="btn btn-default btn-rounded btn-danger btn-icon" data-rel="tooltip" title="@langapp('delete')" data-toggle="ajaxModal">
                                    @icon('solid/trash-alt') </a>
                        @endcan
      
       
                          
    </p>

                    
                  </div>
                </div>
            </div>
        @endforeach
    </div>
    @endforeach