<div class="row">
    <div class="col-lg-12">

    
        <section class="panel panel-default">

            {!! Form::open(['route' => 'fields.module', 'class' => 'bs-example form-horizontal']) !!} 

            <header class="panel-heading">
                    @icon('solid/cogs') @langapp('settings')  
                    </header>
            <div class="panel-body">

    


                <div class="form-group">
                    <label class="col-lg-3 control-label">@langapp('module') @required</label>
                    <div class="col-lg-9">
                        <div class="m-b">
                            <select name="module" class="form-control" required id="module">
                                <option value="clients">@langapp('clients')</option>
                                <option value="tickets">@langapp('tickets')</option>
                                <option value="deals">@langapp('deals')</option>
                                <option value="leads">@langapp('leads')</option>
                                <option value="invoices">@langapp('invoices')</option>
                                <option value="estimates">@langapp('estimates')</option>
                                <option value="expenses">@langapp('expenses')</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="select_department display-none">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('department') @required</label>
                        <div class="col-lg-9">
                            <div class="m-b">
                                <select name="department" class="form-control">
                                    <option value="0">None</option>
                                    @foreach (App\Entities\Department::all() as $d) 
                                        <option value="{{  $d->deptid  }}">{{  $d->deptname  }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="panel-footer">
                    {!!  renderAjaxButton() !!}
            </div>

{!! Form::close() !!}

        </section>
        
    </div>
</div>
@push('pagescript')
<script type="text/javascript">
    $(document).ready(function () {
        $("#module").change(function () {
            $(this).find("option:selected").each(function () {
                if ($(this).attr("value") == "tickets") {
                    $(".select_department").show();
                }
                else {
                    $(".select_department").hide();
                }
            });
        }).change();
    });
</script>
@endpush

