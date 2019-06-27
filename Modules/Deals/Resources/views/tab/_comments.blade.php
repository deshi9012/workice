<div class="col-lg-12">
    <section class="panel panel-body">
        <section class="comment-list block">



            <article class="comment-item" id="comment-form">
                <a class="pull-left thumb-sm avatar">
                    <img src="{{ avatar() }}" class="img-circle">
                </a>
                <span class="arrow left"></span>
                <section class="comment-body">
                    <section class="panel panel-default">

                         @widget('Comments\CreateWidget', ['commentable_type' => 'deals' , 'commentable_id' => $deal->id])
                        
            
                    </section>
                </section>
            </article>


           

            @widget('Comments\ShowComments', ['comments' => $deal->comments])

            

        </section>
    </section>
</div>


@include('comments::_ajax.ajaxify')