<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('create') </h4>
        </div>
        {!! Form::open(['route' => 'contacts.api.save', 'class' => 'bs-example form-horizontal ajaxifyForm validator']) !!}
        <div class="modal-body">
            <input type="hidden" name="company" value="{{ $client }}">
            <input type="hidden" name="url" value="{{ url()->previous() }}">
            <span id="status"></span>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('fullname') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="John Doe" name="name" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('username') @required</label>
                <div class="col-lg-8">
                    <input class="form-control" id='username' type="text" placeholder="johndoe" name="username" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('email') @required</label>
                <div class="col-lg-8">
                    <input class="form-control" id='email' type="email" placeholder="me@domain.com" name="email" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('password') </label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <input type="text" name="password" class="form-control" rel="gp" data-size="12"
                        data-character-set="a-z,A-Z,0-9,#">
                        <span class="input-group-btn"><button type="button" class="btn btn-default getNewPass">
                        @icon('solid/sync-alt')</button></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('phone') </label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="phone" placeholder="961-681-5085">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label"></label>
                <div class="col-lg-8">
                <div class="form-check text-muted">
                    <label>
                        <input type="hidden" name="invite"  value="0">
                        <input type="checkbox" name="invite"  value="1">
                        <span class="label-text">Send invitation email</span>
                    </label>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                {!! closeModalButton() !!}
                {!! renderAjaxButton() !!}
                
            </div>
        </div>
        {!! Form::close() !!}
    </div>


    @include('partial.ajaxify')

    @push('pagescript')
    <script type="text/javascript">
    $(document).ready(function () {
    
    function randString(id) {
        var dataSet = $(id).attr('data-character-set').split(',');
        var possible = '';
        if ($.inArray('a-z', dataSet) >= 0) {
            possible += 'abcdefghijklmnopqrstuvwxyz';
        }
        if ($.inArray('A-Z', dataSet) >= 0) {
            possible += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        if ($.inArray('0-9', dataSet) >= 0) {
            possible += '0123456789';
        }
        if ($.inArray('#', dataSet) >= 0) {
            possible += '![]{}()%&*$#^<>~@|';
        }
        var text = '';
            for (var i = 0; i < $(id).attr('data-size'); i++) {
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            }
        return text;
    }

        $('input[rel="gp"]').each(function () {
            $(this).val(randString($(this)));
        });
        $(".getNewPass").click(function () {
            var field = $(this).closest('div').find('input[rel="gp"]');
            field.val(randString(field));
        });
        $('input[rel="gp"]').on("click", function () {
            $(this).select();
        });
    });
    </script>

    @endpush

    @stack('pagescript')

