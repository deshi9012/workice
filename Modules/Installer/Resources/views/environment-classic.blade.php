@extends('installer::layouts.master')

@section('template_title')
Step 3 | Environment Settings | Classic Editor
@endsection

@section('title')
    <i class="fas fa-code fa-fw" aria-hidden="true"></i> 
    Classic Environment Editor
@endsection

@section('container')

    <form method="post" action="{{ route('LaravelInstaller::environmentSaveClassic') }}">
        {!! csrf_field() !!}
        <textarea class="textarea" name="envConfig">{{ $envConfig }}</textarea>
        <div class="buttons buttons--right">
            <button class="button button--light" type="submit">
            	<i class="fas fa-save fa-fw" aria-hidden="true"></i>
                Save .env
            </button>
        </div>
    </form>

    @if( ! isset($environment['errors']))
        <div class="buttons-container">
            <a class="button float-left" href="{{ route('LaravelInstaller::environmentWizard') }}">
                <i class="fas fa-sliders-h fa-fw" aria-hidden="true"></i>
                Back
            </a>
            <a class="button float-right" href="{{ route('LaravelInstaller::database') }}">
                <i class="fas fa-check fa-fw" aria-hidden="true"></i>
                Save and Install
                <i class="fas fa-angle-double-right fa-fw" aria-hidden="true"></i>
            </a>
        </div>
    @endif

@endsection