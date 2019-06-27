<div class="row">
    <div class="col-lg-12">
        <section class="m-xs">
        @can('expenses_create')
            <header class="panel-heading">
            <a href="{{  route('expenses.create', ['project' => $project->id])  }}" class="btn btn-dark btn-sm" data-toggle="ajaxModal">
                    @icon('solid/plus') @langapp('create')  
            </a>
            </header>
        @endcan


        <div id="ajaxData"></div>



            
        </section>
    </div>
</div>

@push('pagescript')
  @include('projects::_scripts._expenses')
@endpush
