<section class="wrapper bg overflow-x-auto">
                
                <div class="row">
                    
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body collapse in animated fadeInUpBig">
                                <div class="card-block">
                                    <div class="overflow-hidden">
                                        <div id="todo-lists-basic-demo"
                                            class="lobilists-wrapper lobilists single-line sortable ps-container ps-theme-dark ps-active-x">

                                            @php
                                            $cards = App\Entities\Category::tasks()->orderBy('order', 'asc')->get();
                                            @endphp
                                            @foreach ($cards as $card)

                                            @include('tasks::_includes._card')

                                            @endforeach
                                            <div class="modal modal-static fade" id="processing-modal"
                                                role="dialog" aria-hidden="true">
                                                <div class="modal-dialog processing-modal">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="text-center">
                                                                @icon('solid/sync-alt', 'fa-4x fa-spin')
                                                                <h4>@langapp('processing')</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>





            </section>


@push('pagescript')

<script type="text/javascript">
$(document).ready(function () {
    var kanbanCol = $('.scrumboard');
    draggableInit();
});
function draggableInit() {
    var sourceId;
    $('[draggable=true]').bind('dragstart', function (event) {
        sourceId = $(this).parent().attr('id');
        event.originalEvent.dataTransfer.setData("text/plain", event.target.getAttribute('id'));
    });
    $('.scrumboard').bind('dragover', function (event) {
        event.preventDefault();
    });
    $('.scrumboard').bind('drop', function (event) {
        var children = $(this).children();
        var targetId = children.attr('id');
        if (sourceId != targetId) {
        var elementId = event.originalEvent.dataTransfer.getData("text/plain");
        $('#processing-modal').modal('toggle');
        setTimeout(function () {
            var element = document.getElementById(elementId);
            task_id = element.getAttribute('id');

            axios.post('/api/v1/tasks/'+task_id+'/status', {
                'id': task_id,
                'status': targetId
            })
            .then(function (response) {
                toastr.success(response.data, '@langapp('success') ');
            })
            .catch(function (error) {
                toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
            });


            
            children.prepend(element);
            $('#processing-modal').modal('toggle');
        }, 1000);
        }
        event.preventDefault();
    });
}
</script>
@endpush