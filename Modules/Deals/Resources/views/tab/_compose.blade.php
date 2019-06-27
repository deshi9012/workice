<div class="col-lg-12">
    <section class="panel panel-body">

    {!! Form::open(['route' => 'deals.email', 'class' => 'bs-example ajaxifyForm', 'files' => true]) !!}


    <input type="hidden" name="deal_id" value="{{ $deal->id }}">
    <input type="hidden" name="from" value="{{ \Auth::user()->id }}">
        

        <div class="form-group">
                                        <label>@langapp('contact_person')   <span class="text-danger">*</span></label>
                                        <input type="text" name="to" value="{{ $deal->contact->email  }}"
                                               class="input-sm form-control" required>
                                    </div>
        <div class="form-group">
                                        <label>@langapp('subject')   <span class="text-danger">*</span></label>
                                        <input type="text" name="subject" placeholder="Add Subject" class="input-sm form-control" required>
                                    </div>


        <div class="form-group">
                                        <label>@langapp('message')   (Markdown Syntax) </label>

                                        <textarea name="message" class="form-control markdownEditor"></textarea>
                                    </div>

        <div class="form-group">
                                        <label>@langapp('files')   </label>
                                        <input type="file" name="uploads[]" multiple="">
                                    </div>


                                    <span class="pull-right">{!!  renderAjaxButton('send')  !!}</span>



    {!! Form::close() !!}

    </section>
</div>
