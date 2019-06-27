@extends('installer::layouts.master-update')

@section('title', 'Welcome to updater')
@section('container')
    <p class="paragraph text-center">There is 1 update. | There are {{ $numberOfUpdatesPending }} updates.</p>
    <div class="buttons">
        <a href="{{ route('LaravelUpdater::database') }}" class="button">Install Updates</a>
    </div>
@stop
