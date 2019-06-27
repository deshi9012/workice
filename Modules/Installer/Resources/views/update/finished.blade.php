@extends('installer::layouts.master-update')

@section('title', 'Finished')
@section('container')
    <p class="paragraph text-center">{{ session('message')['message'] }}</p>
    <div class="buttons">
        <a href="{{ url('/') }}" class="button">Exit</a>
    </div>
@stop
