@if (isAdmin() || can('projects_view_notes'))
    <section class="panel panel-default">
        <header class="panel-heading">@icon('solid/pencil-alt') @langapp('notes')</header>
        {!! Form::open(['route' => 'notes.project', 'class' => 'ajaxifyForm']) !!}

        <input type="hidden" name="project_id" value="{{  $project->id  }}">
        <aside>
            <textarea name="notes" class="form-control markdownEditor">{{ $project->notes }}</textarea>


        </aside>

        <hr>
        <div class="m-xs">
            {!! renderAjaxButton() !!}
        </div>
    

    {!! Form::close() !!}

    </section>
    
    @push('pagescript')
    @include('stacks.js.markdown')
@endpush

@endif

