<div class="row">
  
  <div class="col-lg-12">
    <section class="panel panel-default">
    <header class="panel-heading">Execute Artisan Commands</header>
    <div class="scrollable wrapper bg">
      <div class="row">
        <div class="col-lg-12">

          <div class="alert alert-primary small">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            You are recommended to change the <strong>artisan key</strong> by clicking on the refresh icon
          </div>

          <div class="form-group">
                                    <label>Artisan command key <a href="{{ route('commands.key') }}" class="btn btn-xs btn-info">
                                        @icon('solid/sync-alt')
                                    </a></label>
                                    <input type="text" class="form-control" readonly="readonly"
                                    value="{{ get_option('cron_key') }}">
                                </div>

          <div class="row">
            <div class="col-sm-4">
              <section class="panel panel-default">
                <header class="panel-heading ">
                  <div class="clearfix">
                    <div class="clear">
                      <div class="h3 m-t-xs m-b-xs">Queues</div>
                      <small class="text-muted">Queue functionality</small>
                    </div>
                  </div>
                </header>
                <div class="m-xs">
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#"data-rel="tooltip" title="Flush all of the failed queue jobs" data-id="queue-flush">queue:flush</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="queue-restart" title="Restart queue worker daemons after their current job">queue:restart</a>
                </div>
              </section>
            </div>
            <div class="col-sm-4">
              <section class="panel panel-default">
                <header class="panel-heading ">
                  <div class="clearfix">
                    <div class="clear">
                      <div class="h3 m-t-xs m-b-xs">Routes</div>
                      <small class="text-muted">Operate routes functionality</small>
                    </div>
                  </div>
                </header>
                <div class="m-xs">
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="route-cache" title="Create a route cache file for faster route registration">route:cache</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="route-clear" title="Remove the route cache file">route:clear</a>
                </div>
              </section>
            </div>
            <div class="col-sm-4">
              <section class="panel panel-default">
                <header class="panel-heading ">
                  <div class="clearfix">
                    <div class="clear">
                      <div class="h3 m-t-xs m-b-xs">Views</div>
                      <small class="text-muted">Operate views functionality</small>
                    </div>
                  </div>
                </header>
                <div class="m-xs">
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="view-clear" title="Clear all compiled view files">view:clear</a>
                </div>
              </section>
            </div>
          </div>
        </div>
        
      </div>
      
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-sm-4">
              <section class="panel panel-default">
                <header class="panel-heading ">
                  <div class="clearfix">
                    <div class="clear">
                      <div class="h3 m-t-xs m-b-xs">Cache</div>
                      <small class="text-muted">Operate cache functionality</small>
                    </div>
                  </div>
                </header>
                <div class="m-xs">
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="cache-clear" title="Flush the application cache">cache:clear</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="config-cache" title="Create a cache file for faster configuration loading">config:cache</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="config-clear" title="Remove the configuration cache file">config:clear</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="cache-gc" title="Garbage-collect the cache files">cache:gc</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="optimize-clear" title="Remove the cached bootstrap files">optimize:clear</a>
                </div>
              </section>
            </div>
            <div class="col-sm-4">
              <section class="panel panel-default">
                <header class="panel-heading ">
                  <div class="clearfix">
                    <div class="clear">
                      <div class="h3 m-t-xs m-b-xs">Backup</div>
                      <small class="text-muted">Operate backups functionality</small>
                    </div>
                  </div>
                </header>
                <div class="m-xs">
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="backup-clean" title="Remove all backups older than specified number of days in config">backup:clean</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="backup-run" title="Run the backup">backup:run</a>
                </div>
              </section>
            </div>
            <div class="col-sm-4">
              <section class="panel panel-default">
                <header class="panel-heading ">
                  <div class="clearfix">
                    <div class="clear">
                      <div class="h3 m-t-xs m-b-xs">@langapp('projects')</div>
                      <small class="text-muted">Operate projects functionality</small>
                    </div>
                  </div>
                </header>
                <div class="m-xs">
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="projects-balance" title="Calculates project costs">projects:balance</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="projects-monitor" title="Monitor overbudget in projects">projects:monitor</a>
                </div>
              </section>
            </div>
          </div>
        </div>
        
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-sm-4">
              <section class="panel panel-default">
                <header class="panel-heading ">
                  <div class="clearfix">
                    <div class="clear">
                      <div class="h3 m-t-xs m-b-xs">@langapp('clients')</div>
                      <small class="text-muted">Operate clients functionality</small>
                    </div>
                  </div>
                </header>
                <div class="m-xs">
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="clients-balance" title="Calculate client balances">clients:balance</a>
                </div>
              </section>
            </div>
            <div class="col-sm-4">
              <section class="panel panel-default">
                <header class="panel-heading ">
                  <div class="clearfix">
                    <div class="clear">
                      <div class="h3 m-t-xs m-b-xs">@langapp('contacts')</div>
                      <small class="text-muted">Operate contacts functionality</small>
                    </div>
                  </div>
                </header>
                <div class="m-xs">
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="contacts-emails" title="Check for contact emails via IMAP">contacts:emails</a>
                </div>
              </section>
            </div>
            <div class="col-sm-4">
              <section class="panel panel-default">
                <header class="panel-heading ">
                  <div class="clearfix">
                    <div class="clear">
                      <div class="h3 m-t-xs m-b-xs">@langapp('credits')</div>
                      <small class="text-muted">Operate credits functionality</small>
                    </div>
                  </div>
                </header>
                <div class="m-xs">
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="credits-balance" title="Calculate creditnote used credits and balances">credits:balance</a>
                </div>
              </section>
            </div>
          </div>
        </div>
        
      </div>



      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-sm-4">
              <section class="panel panel-default">
                <header class="panel-heading ">
                  <div class="clearfix">
                    <div class="clear">
                      <div class="h3 m-t-xs m-b-xs">@langapp('deals')</div>
                      <small class="text-muted">Operate deals functionality</small>
                    </div>
                  </div>
                </header>
                <div class="m-xs">
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="deals-calcstage" title="Calculates total for each deal stage">deals:calcstage</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="deals-value" title="Computes the deal value using deal currency">deals:value</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="deals-forecast" title="Calculate deal forecasts">deals:forecast</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="deals-velocity" title="Calculates the average time a deal takes all the way through your pipeline">deals:velocity</a>
                </div>
              </section>
            </div>
            <div class="col-sm-4">
              <section class="panel panel-default">
                <header class="panel-heading ">
                  <div class="clearfix">
                    <div class="clear">
                      <div class="h3 m-t-xs m-b-xs">@langapp('estimates')</div>
                      <small class="text-muted">Operate estimates functionality</small>
                    </div>
                  </div>
                </header>
                <div class="m-xs">
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="estimates-balance" title="Calculate estimate costs">estimates:balance</a>
                </div>
              </section>
            </div>
            <div class="col-sm-4">
              <section class="panel panel-default">
                <header class="panel-heading ">
                  <div class="clearfix">
                    <div class="clear">
                      <div class="h3 m-t-xs m-b-xs">@langapp('expenses')</div>
                      <small class="text-muted">Operate expenses functionality</small>
                    </div>
                  </div>
                </header>
                <div class="m-xs">
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="expenses-balance" title="Calculate expenses tax">expenses:balance</a>
                </div>
              </section>
            </div>
          </div>
        </div>
        
      </div>


      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-sm-4">
              <section class="panel panel-default">
                <header class="panel-heading ">
                  <div class="clearfix">
                    <div class="clear">
                      <div class="h3 m-t-xs m-b-xs">@langapp('invoices')</div>
                      <small class="text-muted">Operate invoices functionality</small>
                    </div>
                  </div>
                </header>
                <div class="m-xs">
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="invoices-balance" title="Calculate invoice balances">invoices:balance</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="invoices-reminders" title="Send invoice reminders">invoices:reminders</a>
                </div>
              </section>
            </div>
            <div class="col-sm-4">
              <section class="panel panel-default">
                <header class="panel-heading ">
                  <div class="clearfix">
                    <div class="clear">
                      <div class="h3 m-t-xs m-b-xs">@langapp('leads')</div>
                      <small class="text-muted">Operate leads functionality</small>
                    </div>
                  </div>
                </header>
                <div class="m-xs">
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="leads-calcstage" title="Calculates totals for each lead stage">leads:calcstage</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="leads-emails" title="Check for emails from leads">leads:emails</a>
                </div>
              </section>
            </div>
            <div class="col-sm-4">
              <section class="panel panel-default">
                <header class="panel-heading ">
                  <div class="clearfix">
                    <div class="clear">
                      <div class="h3 m-t-xs m-b-xs">@langapp('tickets')</div>
                      <small class="text-muted">Operate tickets functionality</small>
                    </div>
                  </div>
                </header>
                <div class="m-xs">
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="tickets-autoclose" title="Auto close pending tickets">tickets:autoclose</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="tickets:emails" title="Check for email replies for tickets">tickets:emails</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="tickets-feedback" title="Send feedback requests for solved tickets">tickets:feedback</a>
                </div>
              </section>
            </div>
          </div>
        </div>
        
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-sm-4">
              <section class="panel panel-default">
                <header class="panel-heading ">
                  <div class="clearfix">
                    <div class="clear">
                      <div class="h3 m-t-xs m-b-xs">@langapp('reports')</div>
                      <small class="text-muted">Operate analytics functionality</small>
                    </div>
                  </div>
                </header>
                <div class="m-xs">
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="analytics-compute" title="Compute all analytics data">analytics:compute</a>
                </div>
              </section>
            </div>
            <div class="col-sm-4">
              <section class="panel panel-default">
                <header class="panel-heading ">
                  <div class="clearfix">
                    <div class="clear">
                      <div class="h3 m-t-xs m-b-xs">Application</div>
                      <small class="text-muted">Operate application functionality</small>
                    </div>
                  </div>
                </header>
                <div class="m-xs">
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="app-balances" title="Computes projects,estimates,invoices and client balances">app:balances</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="app-activities" title="Clean user activities older than specified days">app:activities</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="app-cleancsv" title="Clean csv table after data is imported">app:cleancsv</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="app-xrates" title="Update to current exchange rates">app:xrates</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="app-flush" title="Flush cached system settings">app:flush</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="app-health" title="Scan database for potential orphan records">app:health</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="app-lang" title="Calculates translation progress for all available languages">app:lang</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="app-recurring" title="Process recurring models">app:recurring</a>
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="app-reminders" title="Send reminders">app:reminders</a>
                </div>
              </section>
            </div>
            <div class="col-sm-4">
              <section class="panel panel-default">
                <header class="panel-heading ">
                  <div class="clearfix">
                    <div class="clear">
                      <div class="h3 m-t-xs m-b-xs">Logs</div>
                      <small class="text-muted">Operate logs functionality</small>
                    </div>
                  </div>
                </header>
                <div class="m-xs">
                  <a class="btn btn-{{ get_option('theme_color') }} btn-sm btn-block m-b-xs commandBtn" href="#" data-rel="tooltip" data-id="log-clear" title="Remove every log files in the log directory">log:clear</a>
                </div>
              </section>
            </div>
          </div>
        </div>
        
      </div>
      
    </div>
    
  </section>
  
  
</div>
</div>

@push('pagescript')
    <script>
        $(".commandBtn").click(function() {
        command = $(this).data("id");
        axios.get('{{ url('/').'/settings/artisan/'.get_option('cron_key') }}/'+command)
        .then(function (response) {
            toastr.success(response.data.message, '@langapp('response_status') ');
        })
        .catch(function (error) {
            toastr.error('Failed to execute artisan command or disabled', '@langapp('response_status') ');
        });
    });
    </script>
@endpush