<div class="col-md-4">
    <div class="panel-body text-center">
        <div class="content-group-sm user-name">
            <h6 class="text-dark">
            {{ $user->name }}
            </h6>
            <span class="display-block">{{ $user->profile->job_title }}</span>
        </div>
        <a href="#" class="thumb-md display-inline-block content-group-sm">
            <img src="{{ $user->profile->photo }}" class="img-circle">
        </a>
        
        <p id="social-buttons" class="m-t-sm">
            @if ($user->profile->website)
            <a href="{{ $user->profile->website }}" class="btn btn-rounded btn-sm btn-icon btn-success" target="_blank">
                @icon('solid/link')
            </a>
            @endif
            @if ($user->profile->twitter )
            <a href="https://twitter.com/{{ $user->profile->twitter }}" class="btn btn-rounded btn-sm btn-icon btn-info" target="_blank">
                @icon('brands/twitter')
            </a>
            @endif
            @if ($user->profile->skype)
            <a href="skype:{{ $user->profile->skype }}" class="btn btn-rounded btn-sm btn-icon btn-primary">
                @icon('brands/skype')
            </a>
            @endif
            
        </p>
    </div>
    <table class="table table-borderless table-xs content-group-sm">
        <tbody>
            {{--@if ($user->profile->company > 0)--}}
            {{--<tr>--}}
                {{--<td class="text-muted">@langapp('company')</td>--}}
                {{--<td class="text-right">--}}
                    {{--<span class="pull-right">--}}
                        {{--<a href="{{ route('clients.view', $user->profile->company) }}">{{  $user->profile->business->name  }}</a>--}}
                    {{--</span>--}}
                {{--</td>--}}
            {{--</tr>--}}
            {{--@endif--}}
            {{----}}
            <tr>
                <td class="text-muted">@langapp('email')</td>
                <td class="text-right">{{  $user->email  }}</td>
            </tr>
            <tr>
                <td class="text-muted">@langapp('username')</td>
                <td class="text-right">{{  $user->username  }}</td>
            </tr>
            <tr>
                <td class="text-muted">@langapp('last_login')</td>
                <td class="text-right">{{  dateTimeFormatted($user->last_login)  }}</td>
            </tr>
            <tr>
                <td class="text-muted">@langapp('role')</td>
                <td class="text-right">{{  $user->roles->pluck('name')  }}</td>
            </tr>
            {{--<tr>--}}
                {{--<td class="text-muted">@langapp('department')</td>--}}
                {{--<td class="text-right">{{ $user->departments->pluck('department.deptname') }}</td>--}}
            {{--</tr>--}}
            <tr>
                <td class="text-muted">@langapp('mobile')</td>
                <td class="text-right">{{  $user->profile->mobile  }}</td>
            </tr>
            <tr>
                <td class="text-muted">@langapp('phone')   #</td>
                <td class="text-right">{{  $user->profile->phone  }}</td>
            </tr>
            <tr>
                <td class="text-muted">@langapp('locale') </td>
                <td class="text-right">{{  ucfirst($user->locale)  }}</td>
            </tr>
            {{--<tr>--}}
                {{--<td class="text-muted">@langapp('hourly_rate') </td>--}}
                {{--<td class="text-right">{{  $user->profile->hourly_rate  }}/hr</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td class="text-muted">@langapp('city')</td>--}}
                {{--<td class="text-right">{{  $user->profile->city  }}</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td class="text-muted">@langapp('country')</td>--}}
                {{--<td class="text-right"><a href="#">{{  $user->profile->country  }}</a></td>--}}
            {{--</tr>--}}
            <tr>
                <td class="text-muted">@langapp('locale')</td>
                <td class="text-right"><a href="#">{{  $user->profile->locale  }}</a></td>
            </tr>
            {{--<tr>--}}
                {{--<td class="text-muted">@langapp('address')</td>--}}
                {{--<td class="text-right">{{  $user->profile->address  }}</td>--}}
            {{--</tr>--}}
            <tr>
                <td class="text-muted">@langapp('verified_at') </td>
                <td class="text-right">{{ $user->email_verified_at }}</td>
            </tr>
            <tr>
                <td class="text-muted">@langapp('created_at') </td>
                <td class="text-right">{{  dateTimeFormatted($user->created_at)  }}</td>
            </tr>
            <tr>
                <td class="text-muted">@langapp('updated')</td>
                <td class="text-right">{{  dateTimeFormatted($user->updated_at)  }}</td>
            </tr>
        </tbody>
    </table>
    <small class="text-uc text-xs text-muted">
    @langapp('vaults')
    <a href="{{ route('extras.vaults.create', ['module' => 'users', 'id' => $user->id]) }}" class="btn btn-xs btn-danger pull-right" data-toggle="ajaxModal">@icon('solid/plus')</a>
    </small>
    <div class="line"></div>
    @widget('Vaults\Show', ['vaults' => $user->vault])
</div>
<div class="col-md-8">
    <section class="slim-scroll" data-color="#333333" data-disable-fade-out="true" data-distance="0" data-height="700" data-size="5px">
        
        <section class="panel panel-default">
        <header class="panel-heading">@langapp('activities')  </header>
        
        @widget('Activities\Feed', ['activities' => $user->activities->take(100)])
    </section>
</section>

</div>