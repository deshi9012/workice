<ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border list">
    
        @foreach($threads as $inbox)

            @if(!is_null($inbox->thread))
        <li class="list-group-item p-lr">
            
        <a href="{{ route('users.view', ['id' => $inbox->withUser->id]) }}" class="thumb-sm pull-left m-r-sm">
                                <img src="{{ $inbox->withUser->profile->photo }}" class="img-circle">
                              </a>

                               <span class="clear">
                                <small class="pull-right">{!! $inbox->thread->is_seen == 0 && $inbox->thread->sender->id != Auth::id() ? '<i class="far fa-bell text-success"></i>' : '' !!}</small>
                                <a href="{{ route('message.read', ['id' => $inbox->withUser->id]) }}">
                                <span class="block sender-name">{{ $inbox->withUser->name }}</span>
                                </a>

                                <small class="text-ellipsis">
                    @if(Auth::id() == $inbox->thread->sender->id)
                        @icon('solid/reply')
                    @endif {{ str_limit(strip_tags($inbox->thread->message), 200)}}</small>
                              </span>
            
        </li>
            @endif
        @endforeach

    </ul>