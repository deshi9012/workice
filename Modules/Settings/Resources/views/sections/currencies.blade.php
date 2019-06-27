<div class="row">
    
    <div class="col-lg-12">
<section class="panel panel-default">
                    <header class="panel-heading">@langapp('currencies')
                        <a href="{{ route('settings.currencies.create') }}" class="btn btn-xs btn-{{ get_option('theme_color') }} pull-right" data-toggle="ajaxModal">@langapp('create')</a>
                    </header>
                    <div class="table-responsive">
                    <table class="table table-striped m-b-none">
                      <thead>
                        <tr>
                          <th>@langapp('code')</th>
                          <th>@langapp('title')</th>
                          <th>Symbol</th>
                          <th>@langapp('xrate')</th>           
                          <th>Sample</th>           
                          <th width="70"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach (App\Entities\Currency::all() as $currency)
                        <tr>                    
                          <td class="text-bold">{{ $currency->code }}</td>
                          <td>{{ $currency->title }}</td>
                          <td class="text-bold">{{ $currency->symbol }}</td>
                          <td class="">{{ $currency->xrate }}</td>
                          <td class="">{{ formatCurrency($currency->code, 1000.65) }}</td>
                          <td class="">
                              <a href="{{ route('settings.currencies.edit', $currency->id) }}" data-toggle="ajaxModal">@icon('solid/pencil-alt')</a>
                              <a href="{{ route('settings.currencies.delete', $currency->id) }}" data-toggle="ajaxModal" class="text-right">@icon('solid/trash-alt')</a>
                          </td>
                        </tr>
                        @endforeach
                       
                      </tbody>
                    </table>

                    </div>

                  </section>
                

               

    </div>
    
</div>
