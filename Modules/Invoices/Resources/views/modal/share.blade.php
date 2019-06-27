<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-success">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('share') </h4>
        </div>
        <div class="modal-body">
            <p class="h3">
                Share this link to access the Invoice
            </p>
            <input type="text" class="form-control" onfocus="this.select();" onmouseup="return false;"
                   value="{{ URL::signedRoute('invoices.guest', $id) }}">

        </div>
        <div class="modal-footer">
            {!! closeModalButton() !!}
            <a href="{{ URL::signedRoute('invoices.guest', $id) }}" class="btn btn-{{ get_option('theme_color') }} btn-rounded" target="_blank">
            @icon('solid/share-alt') @langapp('preview') </a>

        </div>
    </div>
</div>
