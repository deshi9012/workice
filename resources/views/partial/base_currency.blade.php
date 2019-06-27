<div class="alert alert-primary alert-bordered">
    <button class="close" data-dismiss="alert" type="button">
        <span>×</span>
        <span class="sr-only">
            Close
        </span>
    </button>
    @langapp('amount_displayed_in_your_cur')
    <a class="alert-link" href="{{ route('settings.edit', ['section' => 'system']) }}">
        {{ get_option('default_currency') }}
    </a>
</div>