<section class="" id="taskapp">
    <aside>
        <section class="">
        	

            <header class="header">

                <a href="{{ route('extras.call.create', ['module' => 'deals', 'id' => $deal->id]) }}" data-toggle="ajaxModal" class="btn btn-success btn-sm pull-right btn-icon" id="new-call" data-rel="tooltip" title="@langapp('log_call')">
                     @icon('solid/phone')
                </a>
                


            </header>
            

            <section class="">

            	<div class="sortable">

            		<div class="call-list">
                    	<ol class="dd-list activity-list">

            		@widget('Calls\ShowCalls', ['calls' => $deal->calls()->where(function ($query) {
                        $query->orWhere('user_id', Auth::id())->orWhere('assignee', Auth::id());
                    })->get()])
            		
            			</ol>
            		</div>

            	</div>



            	

                    
            </section>
        </section>
    </aside>
    
@push('pagestyle')
<link rel=stylesheet href="{{ getAsset('plugins/nestable/nestable.css') }}">
@endpush
@push('pagescript')
    @include('extras::_ajax.callsjs')
@endpush
</section>