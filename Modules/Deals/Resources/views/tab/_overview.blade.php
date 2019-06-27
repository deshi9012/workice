<div class="row">
    <div class="col-lg-4 b-r">
        <section class="panel panel-default">
        <header class="panel-heading">@langapp('overview')  </header>
        <section class="panel-body">
            <div class="inline m pull-right">
                <div class="easypiechart text-success" data-percent="{{ $deal->propability }}" data-line-width="5" data-track-Color="#f0f0f0" data-bar-color="#3869D4" data-rotate="180" data-scale-Color="false" data-size="80" data-animate="2000">
                    <span class="h2 step">{{ $deal->propability }}</span>%
                    <div class="easypie-text text-muted">Propability</div>
                </div>
            </div>
            @if ($deal->user_id > 0)
            <span class="thumb-sm avatar lobilist-check">
                <img src="{{ $deal->user->profile->photo  }}" class="img-circle">
            </span> <strong>{{  $deal->user->name  }}</strong>
            @endif
            <div class="m-xs">
                <span class="text-muted">@langapp('pipeline')  : </span>
                <span class="text-bold">{{  ucfirst($deal->pipe->name)  }}</span>
            </div>
            <div class="m-xs">
                <span class="text-muted">@langapp('status')  : </span>
                <span class="text-bold text-danger">{{  ucfirst($deal->status)  }}</span>
            </div>
            <div class="m-xs">
                <span class="text-muted">@langapp('deal_age')  : </span>
                <span class="text-bold">{{  dateElapsed($deal->created_at)  }}</span>
            </div>
            <div class="m-xs">
                <span class="text-muted">@langapp('source')  : </span>
                <span class="text-bold">{{  optional($deal->AsSource)->name  }}</span>
            </div>
            <div class="m-xs">
                <span class="text-muted">@langapp('date')  : </span>
                <span class="text-bold">{{  dateFormatted($deal->created_at)  }}</span>
            </div>
            <div class="m-xs">
                <span class="text-muted">@langapp('due_date')  : </span>
                <span class="text-bold text-danger">{{  dateFormatted($deal->due_date)  }}</span>
            </div>

            
            <div class="m-xs">
                <span class="text-muted">@langapp('deal_value')  : </span>
                <span class="text-bold">{{  formatCurrency($deal->currency, $deal->deal_value)  }}</span>
            </div>

            
            <div class="line"></div>

            @if ($deal->project_id > 0)
            <div class="line"></div>
            <small class="text-uc text-xs text-muted">@langapp('project')  </small>
            <div class="m-xs">
                <a href="{{ route('projects.view', $deal->project_id) }}">
                <span class="">{{ $deal->project->name }}</span>
                </a>
            </div>
            @endif

            <small class="text-uc text-xs text-muted">@langapp('company')  </small>
            <div class="m-xs">
                <span class="text-bold">
                    <a href="{{  route('clients.view', ['id' => $deal->company->id])  }}">{{  $deal->company->name  }}</a>
                </span>
            </div>
            
            @if ($deal->contact_person > 0)
            <div class="line"></div>
            <small class="text-uc text-xs text-muted">@langapp('contact_person')  </small>
            <div class="m-xs">
                <a href="{{ route('contacts.view', $deal->contact->id) }}">
                <span class="">{{ $deal->contact->name }}</span>
                </a>
            </div>
            @endif
            <div class="map">
                <a href="{{ $deal->company->maplink }}" rel="nofollow" target="_blank">
                    <img src="//maps.googleapis.com/maps/api/staticmap?center={{ $deal->company->map }}&amp;zoom=14&amp;scale=2&amp;size=600x340&amp;maptype=roadmap&amp;format=png&amp;visual_refresh=true&amp;key=AIzaSyC0XyInNlB2mAnQbJLRZFQ2FjX--ZrP4Mk" alt="Google Map">
                    
                </a>
            </div>
            <div class="line"></div>
            <small class="text-uc text-xs text-muted">@langapp('tags')  </small>
            <div class="m-xs">
                @php
                $data['tags'] = $deal->tags;
                @endphp
                @include('partial.tags', $data)
            </div>
            <div class="line"></div>
            <small class="text-uc text-xs text-muted">@langapp('extras')  </small>
            @foreach ($deal->custom as $key => $field)
            @if (App\Entities\CustomField::where('name', $field->meta_key)->count() > 0)
            <div class="m-xs">
                <span class="text-muted">@icon('solid/caret-right')
                {{  ucfirst(humanize($field->meta_key, '-'))  }}: </span>
                <span class="">
                    {{  (isJson($field->meta_value)) ? implode(', ', json_decode($field->meta_value)) : $field->meta_value }}
                </span>
            </div>
            @endif
            @endforeach
            @if($deal->status == 'lost')
            <div class="line"></div>
            <small class="text-uc text-xs text-muted">@langapp('reason')  </small>
            @parsedown($deal->lost_reason)
            @endif
        </section>
    </section>
    <section class="panel panel-default">
    <header class="panel-heading">@langapp('activities')  </header>
    <div class="slim-scroll" data-color="#333333" data-disable-fade-out="true" data-distance="0" data-height="500px" data-size="3px">
        @widget('Activities\Feed', ['activities' => $deal->activities])
    </div>
</section>
</div>
<div class="col-lg-8">
@php
$data = [
'notes' => $deal->notes, 'noteable_type' => get_class($deal) ,
'title' => $deal->title.' Note', 'noteable_id' => $deal->id
];
@endphp
@widget('Notes\ShowNotes', $data)
</div>
</div>