@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">
        <aside class="aside-lg" id="subNav">
            <header class="dk header b-b">
                <div class="padder-v">
                    @langapp('messages')
                    <a href="{{ route('messages.new') }}" class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right">
                        @icon('solid/paper-plane') @langapp('send')
                    </a>
                </div>
                
            </header>
                <section class="scrollable">
                    <section class="slim-scroll msg-thread" data-height="500px" id="sender-list">
                        @include('messages::partials.search')
                        @include('messages::threads')
                    </section>
                </section>
        </aside>
        <aside class="bg-light lter b-l" id="email-list">
            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-4 col-sm-offset-8 m-b-xs">
                            
                            
                        </div>
                    </div>
                </header>
                <section class="scrollable wrapper bg">
                    
                </section>
            </section>
        </aside>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@endsection
@push('pagescript')
@include('stacks.js.list')

<script>
    var options = {
        valueNames: [ 'sender-name' ]
    };
    var senderList = new List('sender-list', options);
</script>
@endpush