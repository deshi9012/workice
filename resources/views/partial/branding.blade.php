<footer id="footer" class="login-footer">
    <div class="text-center text-muted padder">
        <p>
            <small>Powered by <a href="{{ config('system.saleurl') }}" target="_blank">Workice CRM</a> v{{ getCurrentVersion()['version']  }}
            <br>&copy; {{ date('Y') }} <a href="{{ get_option('company_domain') }}"
            target="_blank">{{ get_option('company_name') }}</a>
            </small>
        </p>
    </div>
</footer>