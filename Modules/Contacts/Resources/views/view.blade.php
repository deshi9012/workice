@extends('layouts.app')
@section('content')
<section id="content">
  <section class="vbox">
    <header class="header bg-white b-b b-light">
      <p class="">{{ $contact->name }}</p>
      
      @can('contacts_delete')
      
      <a href="{{ route('users.delete', ['id' => $contact->id]) }}" data-toggle="ajaxModal" class="btn btn-sm btn-danger pull-right">
        @icon('solid/trash-alt') @langapp('delete')
      </a>
      
      @endcan
      @can('deals_create')
      
      <a href="{{ route('deals.create', ['contact' => $contact->id, 'company' => $contact->profile->company]) }}" data-toggle="ajaxModal" class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right">
        @icon('solid/award') @langapp('deal')
      </a>
      
      @endcan
    </header>
    <section class="scrollable">
      <section class="hbox stretch">
        <aside class="aside-lg bg-light lter b-r">
          <section class="vbox">
            <section class="scrollable bg">
              <div class="wrapper">
                <div class="clearfix m-b">
                  <a href="#" class="pull-left thumb m-r">
                    <img src="{{ $contact->profile->photo }}" class="img-circle">
                  </a>
                  <div class="clear">
                    <div class="h3 m-t-xs m-b-xs">{{ $contact->name }}</div>
                    <small class="text-muted">@icon('solid/id-badge') {{ $contact->profile->job_title }}</small>
                  </div>
                </div>
                <div class="panel wrapper panel-success">
                  <div class="row">
                    <div class="col-xs-6">
                      <a href="#">
                        <span class="m-b-xs h4 block"> {{ $contact->comments->count() }}</span>
                        <small class="text-muted">@langapp('comments') </small>
                      </a>
                    </div>
                    <div class="col-xs-6">
                      <a href="#">
                        <span class="m-b-xs h4 block">{{ $contact->activities->count() }}</span>
                        <small class="text-muted">@langapp('activity') </small>
                      </a>
                    </div>
                  </div>
                </div>
                
                <div>
                  @if(!empty($contact->email))
                  <small class="text-uc text-xs text-muted">@langapp('email') </small>
                  <p>{{ $contact->email }}</p>
                  @endif
                  
                  @if($contact->profile->company > 0)
                  <small class="text-uc text-xs text-muted">@langapp('company_name') </small>
                  <p>
                    <a href="{{ route('clients.view', $contact->profile->company) }}">{{ $contact->profile->business->name }}</a>
                  </p>
                  @endif
                  @if(!empty($contact->profile->address))
                  <small class="text-uc text-xs text-muted">@langapp('address') </small>
                  <p>{{ $contact->profile->address }}</p>
                  @endif
                  @if(!empty($contact->profile->phone))
                  <small class="text-uc text-xs text-muted">@langapp('phone') </small>
                  <p>{{ $contact->profile->phone }}</p>
                  @endif
                  @if(!empty($contact->profile->mobile))
                  <small class="text-uc text-xs text-muted">@langapp('mobile') </small>
                  <p>{{ $contact->profile->mobile }}</p>
                  @endif
                  @if(!empty($contact->profile->city))
                  <small class="text-uc text-xs text-muted">@langapp('city') </small>
                  <p>{{ $contact->profile->city }}</p>
                  @endif
                  @if(!empty($contact->profile->state))
                  <small class="text-uc text-xs text-muted">@langapp('state') </small>
                  <p>{{ $contact->profile->state }}</p>
                  @endif
                  @if(!empty($contact->profile->zip_code))
                  <small class="text-uc text-xs text-muted">@langapp('zipcode') </small>
                  <p>{{ $contact->profile->zip_code }}</p>
                  @endif
                  @if(!empty($contact->profile->country))
                  <small class="text-uc text-xs text-muted">@langapp('country') </small>
                  <p>{{ $contact->profile->country }}</p>
                  @endif
                  @if(!empty($contact->locale))
                  <small class="text-uc text-xs text-muted">@langapp('locale') </small>
                  <p>{{ $contact->locale }}</p>
                  @endif
                  
                  <div class="line"></div>
                  <small class="text-uc text-xs text-muted">Connection</small>
                  <p class="m-t-sm">
                    @if(!empty($contact->profile->twitter))
                    <a href="https://twitter.com/{{ $contact->profile->twitter }}" class="btn btn-rounded btn-twitter btn-icon">@icon('brands/twitter')
                      @endif
                      
                      @if(!empty($contact->profile->skype))
                      <a href="skype:{{ $contact->profile->skype }}?call" class="btn btn-rounded btn-info btn-icon">@icon('brands/skype')</a>
                      @endif
                      
                      <a href="{{ route('contacts.email', $contact->id) }}" class="btn btn-rounded btn-dracula btn-icon" data-toggle="ajaxModal">
                        @icon('solid/envelope-open')
                      </a>
                    </p>
                    
                    
                    
                  </div>
                </div>
              </section>
            </section>
          </aside>
          <aside class="bg-white">
            <section class="vbox">
              
              <section class="scrollable bg">

                @widget('Emails\SendContactEmail', ['id' => $contact->id, 'subject' => optional($contact->emails->first())->subject])


                @widget('Emails\ShowEmails', ['emails' => $contact->emails])

                
                
                
                
              </section>
            </section>
          </aside>
          
        </section>
      </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
  </section>
  @push('pagestyle')
    @include('stacks.css.datepicker')
@endpush
@push('pagescript')
@include('stacks.js.datepicker')
@include('stacks.js.markdown')
    <script>
        $('.datetimepicker-input').datetimepicker({showClose: true, showClear: true, minDate: moment() });
   
    $( "#sendLater" ).click(function() {
      $("#queueLater").show("fast");
      $( ".datetimepicker-input" ).focus();
    });

        function insertMessage(d) {
        axios.post('{{ route('extras.canned_responses') }}', {
          "response_id": d
        })
        .then(function (response) {
          $("textarea#cannedResponse").val(response.data.message);
        })
        .catch(function (error) {
          toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
        });
}
    </script>
@endpush
  @endsection