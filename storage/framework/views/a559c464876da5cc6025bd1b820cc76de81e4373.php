<?php if($cookieConsentConfig['enabled'] && ! $alreadyConsentedWithCookies): ?>

<?php $__env->startPush('pagescript'); ?>
    
    <script>
        toastr.options.closeButton = true;
        toastr.options.timeOut = 10000;
        toastr.options.progressBar = true;
        toastr.options.positionClass = 'toast-top-full-width';
        toastr.options.closeHtml = '<button class="js-cookie-consent-agree cookie-consent__agree">✘</button>';
        toastr.warning( '<?php echo trans('app.'.'cookie_consent_message'); ?>' , 'Cookie Consent');

        window.laravelCookieConsent = (function () {
            var COOKIE_VALUE = 1;
            function consentWithCookies() {
                setCookie('<?php echo e($cookieConsentConfig['cookie_name']); ?>', COOKIE_VALUE, 365 * 20);
                hideCookieDialog();
            }
            function cookieExists(name) {
                return (document.cookie.split('; ').indexOf(name + '=' + COOKIE_VALUE) !== -1);
            }
            function hideCookieDialog() {
                var dialogs = document.getElementsByClassName('js-cookie-consent');
                for (var i = 0; i < dialogs.length; ++i) {
                    dialogs[i].style.display = 'none';
                }
            }
            function setCookie(name, value, expirationInDays) {
                var date = new Date();
                date.setTime(date.getTime() + (expirationInDays * 24 * 60 * 60 * 1000));
                document.cookie = name + '=' + value + '; ' + 'expires=' + date.toUTCString() +';path=/<?php echo e(config('session.secure') ? ';secure' : null); ?>';
            }
            if(cookieExists('<?php echo e($cookieConsentConfig['cookie_name']); ?>')) {
                hideCookieDialog();
            }
            var buttons = document.getElementsByClassName('js-cookie-consent-agree');
            for (var i = 0; i < buttons.length; ++i) {
                buttons[i].addEventListener('click', consentWithCookies);
            }
            return {
                consentWithCookies: consentWithCookies,
                hideCookieDialog: hideCookieDialog
            };
        })();
    </script>

<?php $__env->stopPush(); ?>
    

<?php endif; ?>