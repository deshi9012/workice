
<aside class="aside-lg bg-white b-r" id="subNav">
    <div class="wrapper b-b header">@icon('solid/users') @langapp('users') 

    </div>


    <div class="user-list user-overflow">


        <ul class="media-list">
            @foreach (User::orderBy('id', 'desc')->take(30)->get() as $key => $u)


                <li class="media {{ ($u->id == $user->id) ? 'active' : '' }} m-t-1">
                    <div class="kb-pad">
                        <a href="{{ route('users.view', ['id' => $u->id]) }}">
                                            <span class="media-left p-r-10">
                                            <div class="thumb-sm">
                                            <img src="{{ $u->profile->photo }}" class="img-circle" alt="">
                                            </div>
                                            </span>
                            <div class="media-body">
                                <span class="media-heading text-dark">{{ $u->name }} {!!  ($u->banned == 1) ? '<i class="fa fa-circle text-danger"></i>' : '' !!}</span>
                                <span class="text-size-small text-muted display-block">{{ $u->profile->job_title }}</span>
                            </div>
                        </a>
                    </div>
                </li>


            @endforeach

        </ul>

    </div>


</aside>
