<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">📤 Testing Email</h4>
        </div>

    {!! Form::open(['route' => 'settings.send.mail', 'class' => 'bs-example ajaxifyForm']) !!}

        <div class="modal-body">
            <div class="form-group">
                <label class="control-label">Email @required</label>
                    <input type="email" class="form-control" name="recipient" placeholder="you@domain.com" required>
                
            </div>

            <div class="form-group">
                <label class="control-label">@langapp('subject') @required</label>
                    <input type="text" class="form-control" name="subject" placeholder="Test Email" required>
            </div>


            <div class="form-group">
                <label class="control-label">@langapp('message')</label>
                    <textarea name="message" class="form-control markdownEditor"></textarea>
            </div>

        </div>
        <div class="modal-footer">
            {!! closeModalButton() !!}
            {!! renderAjaxButton('send') !!}
        </div>

        {!! Form::close() !!}
    </div>

</div>

@push('pagescript')
	@include('stacks.js.markdown')
	@include('partial.ajaxify')
@endpush

@stack('pagescript')

