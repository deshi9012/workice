<div class="row m-sm">
    <div class="col-md-3 padder-v b-r bg-dark b-light pallete">
        <a class="clear" href="{{  route('creditnotes.index')  }}">
            <span class="fa-stack fa-2x pull-left m-r-sm"> @icon('solid/balance-scale', 'fa-stack-1x text-white')
            </span>
            <small class="text-uc">@langapp('credit_note')   </small>
            <span class="h4 block m-t-xs">{{  formatCurrency($company->currency, $company->creditBalance())  }}</span>
        </a>
    </div>
    <div class="col-md-3 padder-v b-r bg-dark pallete">
        <a class="clear" href="{{  route('invoices.index')  }}">
            <span class="fa-stack fa-2x pull-left m-r-sm"> @icon('solid/exclamation-triangle', 'fa-stack-1x')
            </span>
            <small class="text-uc">@langapp('balance_due')   </small>
            <span class="h4 block m-t-xs">{{ formatCurrency($company->currency, $company->balance)  }}</span>
        </a>
    </div>
    <div class="col-md-3 padder-v b-r bg-dark b-light pallete">
        <a class="clear" href="{{  route('expenses.index')  }}">
            <span class="fa-stack fa-2x pull-left m-r-sm">@icon('regular/credit-card', 'fa-stack-1x')
            </span>
            <small class="text-uc">@langapp('expenses')</small>
            <span class="h4 block m-t-xs">{{ formatCurrency($company->currency, $company->expense)  }}</span>
        </a>
    </div>
    <div class="col-md-3 padder-v b-r bg-dark b-light pallete">
        <a class="clear" href="{{  route('payments.index')  }}">
            <span class="fa-stack fa-2x pull-left m-r-sm"> @icon('solid/check-circle', 'fa-stack-1x')
            </span>
            <small class="text-uc">@langapp('received_amount')</small>
            <span class="h4 block m-t-xs">{{  formatCurrency($company->currency, $company->paid)  }}</span>
        </a>
    </div>
</div>
<div class="col-md-5">
    <section class="panel panel-default">
        <section class="panel-body">
            @if($company->primary_contact > 0)
            <div class="clearfix m-b">
                <a href="#" class="pull-left thumb m-r">
                    <img src="{{ $company->logo  }}" class="img-circle">
                </a>
                <div class="clear">
                    <div class="h3 m-t-xs m-b-xs">{{  $company->name }}
                    </div>
                    <span class="text-muted">@icon('regular/user-circle') {{ $company->contact->name }}</span>
                    <br/>
                    <span class="text-muted">@icon('solid/award') {{ optional($company->contact->profile)->job_title }}</span>
                </div>
            </div>
            @endif
            @can('clients_update')
            @if($company->email)
            <a href="{{ route('clients.email', ['id' => $company->id]) }}" class="btn btn-{{  get_option('theme_color')  }} btn-sm" data-toggle="ajaxModal">
                @icon('solid/paper-plane') @langapp('send_email')
            </a>
            @endif
            <a href="{{  route('clients.edit', ['id' => $company->id])  }}"
                class="btn btn-{{ get_option('theme_color') }} btn-sm" data-toggle="ajaxModal"
                title="@langapp('edit')  ">@icon('solid/pencil-alt') @langapp('edit')
            </a>
            @endcan
            @can('clients_delete')
            <a href="{{  route('clients.delete', ['id' => $company->id])  }}"
                class="btn btn-{{  get_option('theme_color')  }} btn-sm" data-toggle="ajaxModal"
            title="@langapp('delete')  ">@icon('solid/trash-alt')</a>
            @endcan
            <div class="company_data">
                <div class="line"></div>
                <small class="text-uc text-xs text-muted">@langapp('notes')  </small>
                <p>{!!  ($company->notes == '') ? 'No Notes' : parsedown($company->notes)  !!}</p>
                <div class="line"></div>
                <small class="text-uc text-xs text-muted">@langapp('contacts')  </small>
                <ul class="list-cust">
                    <li class="m-xs">
                        <span class="text-muted">@icon('solid/phone') @langapp('phone')  :</span>
                        <a href="tel:{{  $company->phone  }}">{{  $company->phone  }}</a>
                    </li>
                    <li class="m-xs">
                        <span class="text-muted">@icon('solid/mobile-alt') @langapp('mobile')
                        :</span> <a
                    href="tel:{{  $company->mobile  }}">{{  $company->mobile  }}</a>
                </li>
                <li class="m-xs">
                    <span class="text-muted">@icon('solid/fax') @langapp('fax')  : </span> <a
                href="tel:{{  $company->fax  }}">{{  $company->fax  }}</a>
            </li>
            <li class="m-xs">
                <span class="text-muted">@icon('solid/gavel') @langapp('tax')
                : </span> {{  $company->tax_number  }}
            </li>
            <li class="m-xs">
                <span class="text-muted">@icon('solid/envelope') @langapp('email')  : </span> <a
            href="mailto:{{  $company->email  }}">{{  $company->email  }}</a>
        </li>
        
    </ul>
    <div class="line"></div>
    <small class="text-uc text-xs text-muted">@langapp('social')  </small>
    <div class="m-xs">
        @if(!empty($company->skype))
        <a href="skype:{{ $company->skype }}?call" class="btn btn-rounded btn-info btn-icon shadowed">
        @icon('brands/skype')</a>
        @endif
        @if(!empty($company->twitter))
        <a href="{{ $company->twitter }}" target="_blank" class="btn btn-rounded btn-twitter btn-icon shadowed">
            @icon('brands/twitter')
        </a>
        @endif
        @if(!empty($company->facebook))
        <a href="{{ $company->facebook }}" target="_blank" class="btn btn-rounded btn-info btn-icon shadowed">
            @icon('brands/facebook')
        </a>
        @endif
        @if(!empty($company->linkedin))
        <a href="{{ $company->linkedin }}" target="_blank" class="btn btn-rounded btn-primary btn-icon shadowed">
            @icon('brands/linkedin')
        </a>
        @endif
        @if(!empty($company->website))
        <a href="{{ $company->website }}" target="_blank" class="btn btn-rounded btn-danger btn-icon shadowed">
            @icon('solid/link')
        </a>
        @endif
    </div>
    <div class="line"></div>
    <small class="text-uc text-xs text-muted">@langapp('address')  </small>
    @if(!empty($company->address1))
    <small class="text-uc text-xs text-muted">@langapp('address') 1</small>
    <p>{{ $company->address1 }}</p>
    @endif
    @if(!empty($company->address2))
    <small class="text-uc text-xs text-muted">@langapp('address') 2</small>
    <p>{{ $company->address2 }}</p>
    @endif
    @if(!empty($company->city))
    <small class="text-uc text-xs text-muted">@langapp('city')</small>
    <p>{{ $company->city }}</p>
    @endif
    @if(!empty($company->state))
    <small class="text-uc text-xs text-muted">@langapp('state')</small>
    <p>{{ $company->state }}</p>
    @endif
    @if(!empty($company->zip_code))
    <small class="text-uc text-xs text-muted">@langapp('zipcode')</small>
    <p>{{ $company->zip_code }}</p>
    @endif
    @if(!empty($company->country))
    <small class="text-uc text-xs text-muted">@langapp('country')</small>
    <p>{{ $company->country }}</p>
    @endif
    @if(!empty($company->locale))
    <small class="text-uc text-xs text-muted">@langapp('locale')</small>
    <p>{{ $company->locale }}</p>
    @endif
    @if(!empty($company->currency))
    <small class="text-uc text-xs text-muted">@langapp('currency')</small>
    <p>{{ $company->currency }}</p>
    @endif
    <div class="map">
        <a href="{{ $company->maplink }}" rel="nofollow" target="_blank">
            <img src="//maps.googleapis.com/maps/api/staticmap?center={{ $company->map }}&amp;zoom=14&amp;scale=2&amp;size=600x340&amp;maptype=roadmap&amp;format=png&amp;visual_refresh=true&amp;key=AIzaSyAzrmdGlvKbFu9F7vPaY0Jg74q1WQo7B0w" alt="Google Map">
            
        </a>
    </div>
    @widget('CustomFields\Extras', ['custom' => $company->custom])
    <small class="text-uc text-xs text-muted">
    @langapp('vaults')
    <a href="{{ route('extras.vaults.create', ['module' => 'clients', 'id' => $company->id]) }}" class="btn btn-xs btn-danger pull-right" data-toggle="ajaxModal">@icon('solid/plus')</a>
    </small>
    <div class="line"></div>
    @widget('Vaults\Show', ['vaults' => $company->vault])
    <div class="line"></div>
    <small class="text-uc text-xs text-muted">@langapp('tags')  </small>
    <div class="m-xs">
        @php
        $data['tags'] = $company->tags;
        @endphp
        @include('partial.tags', $data)
    </div>
</div>
</section>
</section>
</div>
<div class="col-md-7">
<section class="scrollable wrapper">
<section class="comment-list block">
<article class="comment-item" id="comment-form">
    <a class="pull-left thumb-sm avatar">
        <img src="{{ avatar() }}" class="img-circle">
    </a>
    <span class="arrow left"></span>
    <section class="comment-body">
        <section class="panel panel-default">
            @widget('Comments\CreateWidget', ['commentable_type' => 'clients' , 'commentable_id' => $company->id])
            
            
        </section>
    </section>
</article>
@widget('Comments\ShowComments', ['comments' => $company->comments])
</section>
</section>
</div>
@push('pagescript')
@include('comments::_ajax.ajaxify')
@include('partial.ajaxify')
@endpush