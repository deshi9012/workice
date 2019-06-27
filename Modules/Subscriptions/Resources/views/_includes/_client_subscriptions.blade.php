@if(Auth::user()->profile->company > 0)

                    <section class="panel panel-default">



                        <header class="panel-heading">@langapp('subscriptions')</header>

                <div class="table-responsive">
                                <table  class="table table-striped" id="client-subscriptions-table">
                                    <thead>
                                        <tr>
                                            <th class="hide"></th>
                                            <th>@langapp('name')</th>
                                            <th>@langapp('status')</th>
                                            <th>@langapp('billing_date')</th>
                                            <th>@langapp('period')</th>
                                            <th class="no-sort"></th>
                                        </tr>
                                    </thead>
                                    
                                </table>
                            </div>

</section>


                    @else

                    <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    @icon('solid/exclamation-triangle') Your account is not associated to any company.
                  </div>

                    @endif