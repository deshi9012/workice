<div class="row">

    <div class="col-lg-12">

        <div class="alert alert-warning small">
           @icon('solid/exclamation-circle') Always make a backup before updating
           @admin
           <a href="#" class="btn btn-xs btn-{{ get_option('theme_color') }} pull-right" id="updatesBtn" data-rel="tooltip" title="Check for updates now">@icon('solid/code-branch') @langapp('check_for_updates')</a>
           <a href="#" class="btn btn-{{ get_option('theme_color') }} btn-xs pull-right" id="backupBtn">@icon('solid/database') Backup</a>
           @endadmin
        </div>

        <div class="alert alert-info small">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p><strong>CRON: </strong> <code>* * * * * php /path-to-your-project/artisan schedule:run >/dev/null</code></p>
            <p><strong>Via URL</strong> <code>{{ route('artisan.schedule', ['token' => get_option('cron_key')]) }}</code></p>
        </div>

        <div class="m-xs">
            <span class="text-dark">Laravel Version</span>: <span class="text-muted">{{ app()->version() }}</span>
        </div>
        <div class="line"></div>
        @php
            $latest = getLastVersion();
        @endphp
        <div class="m-xs">
            <span class="text-dark">Workice CRM Version</span>: <span class="text-muted">{{ getCurrentVersion()['version'] }}</span>
            @if (isset($latest['id']))
                <span class="label label-success">{{ $latest['attributes']['build'] <= getCurrentVersion()['build'] ? 'Latest Version' : 'Update v.'.$latest['attributes']['version'].' Available' }}</span>
            @endif
            
        </div>
        <div class="line"></div>
        <div class="m-xs">
            <span class="text-dark">Build</span>: <span class="text-muted">{{ getCurrentVersion()['build'] }}</span>
        </div>
        <div class="line"></div>
        <div class="m-xs">
            <span class="text-dark">OS Version</span>: <span class="text-muted">{{ php_uname('s') }}</span>
        </div>
        <div class="line"></div>
        <div class="m-xs">
            <span class="text-dark">PHP Version</span>: <span class="text-muted">{{ phpversion() }}</span>
        </div>
        <div class="line"></div>
        <div class="m-xs">
            <span class="text-dark">Your App Name</span>: <span class="text-muted">{{ config('app.name') }}</span>
        </div>
        <div class="line"></div>
        <div class="m-xs">
            <span class="text-dark">Timezone</span>: <span class="text-muted">{{ date_default_timezone_get() }}</span>
        </div>
        <div class="line"></div>
        <div class="m-xs">
            <span class="text-dark">Server Time</span>: <span class="text-muted">{{ dateTimeFormatted(now()) }}</span>
        </div>
        <div class="line"></div>
        @if(!settingEnabled('demo_mode'))
        <div class="m-xs">
            <span class="text-dark">Purchase Code</span>: <span class="text-muted">{{ get_option('purchase_code') }}</span>
        </div>
        <div class="line"></div>
        @endif
        
    
    </div>
</div>

@push('pagescript')
    <script>
        $("#backupBtn").click(function() {
        axios.get('{{ route('updates.backup') }}')
        .then(function (response) {
            toastr.success(response.data.message, '@langapp('response_status') ');
        })
        .catch(function (error) {
            toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
        });

        
    });
        $("#updatesBtn").click(function() {
        axios.get('{{ route('updates.check') }}')
        .then(function (response) {
            toastr.success(response.data.message, '@langapp('response_status') ');
        })
        .catch(function (error) {
            toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
        });
    });
    </script>
@endpush
