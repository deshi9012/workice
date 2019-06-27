<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@icon('solid/comments', 'fa-1x') @langapp('comments')  </h4>
    </div>
    <div class="modal-body">


        <div class="padder">

                <section class="comment-list block">

                     <article class="comment-item" id="comment-form">
                <a class="pull-left thumb-sm avatar">
                    <img src="{{ avatar() }}" class="img-circle">
                </a>
                <span class="arrow left"></span>
                <section class="comment-body">
                    <section class="panel panel-default">

                        @widget('Comments\CreateWidget', ['commentable_type' => 'estimates' , 'commentable_id' => $estimate->id])
                        
            
                    </section>
                </section>
            </article>




                    @widget('Comments\ShowComments', ['comments' => $estimate->comments])



                

                </section>


        </div>


    </div>

</div>    


</div>

@push('pagescript')
@include('stacks.js.markdown')
@include('comments::_ajax.ajaxify')
@endpush


@stack('pagescript')