<div class="modal-dialog">
    <div class="modal-content">
        @if($type == 'hosting')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@langapp('hosting_account')  </h4>
            </div>
            <div class="modal-body">
                <ul class="list-group no-radius">
                    <li class="list-group-item">
                    <span class="pull-right">
                        {{  $client->hosting_company  }}
                    </span>
                        @langapp('hosting_company')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                        {{  $client->hostname  }}
                    </span>
                        @langapp('hostname')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                        {{  $client->account_username  }}
                    </span>
                        @langapp('account_username')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                        {{  $client->account_password  }}
                    </span>
                        @langapp('account_password')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                        {{  $client->port  }}
                    </span>
                        @langapp('port')  
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                {!! closeModalButton() !!}
            </div>
        @endif
        @if ($type == 'bank')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@langapp('bank_account')  </h4>
            </div>
            <div class="modal-body">
                <ul class="list-group no-radius">
                    <li class="list-group-item">
                    <span class="pull-right">
                        {{  $client->bank  }}
                    </span>
                        @langapp('bank')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                        {{  $client->bic  }}
                    </span>
                        SWIFT/BIC
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                        {{  $client->sortcode  }}
                    </span>
                        Sort Code
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                        {{  $client->account_holder  }}
                    </span>
                        @langapp('account_holder')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                        {{  $client->account  }}
                    </span>
                        @langapp('account')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                        {{  $client->iban  }}
                    </span>
                        IBAN
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                {!! closeModalButton() !!}
            </div>
        @endif
    </div>
</div>