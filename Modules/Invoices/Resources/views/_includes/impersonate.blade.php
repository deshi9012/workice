@if($invoice->company->primary_contact)
<a class="btn btn-sm btn-dark pull-right btn-responsive" data-placement="bottom" data-rel="tooltip" href="{{  route('users.impersonate', ['id' => $invoice->company->contact->id ])  }}" title="View as Client">
    @icon('solid/user-secret') @langapp('as_client')
</a>
@endif