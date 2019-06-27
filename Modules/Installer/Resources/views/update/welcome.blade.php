@extends('installer::layouts.master-update')

@section('title', 'Welcome to updater')
@section('container')
    <p class="paragraph text-center">
    	Welcome to update wizard
    </p>
    <div class="buttons">
        <a href="{{ route('LaravelUpdater::overview') }}" class="button">Next</a>
    </div>
@stop
