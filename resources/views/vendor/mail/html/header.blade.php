<tr>
    <td class="header">
    	@if(config('system.logo_on_emails'))
    	<img src="{{ getStorageUrl(config('system.media_dir').'/'.get_option('company_logo')) }}" height="50">
    	@endif
        <a href="{{ $url }}">
            {{ $slot }}
        </a>
    </td>
</tr>
