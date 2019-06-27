<?php

namespace Modules\Installer\Helpers;

use Exception;
use Illuminate\Http\Request;

class EnvironmentManager
{
    /**
     * @var string
     */
    private $envPath;

    /**
     * @var string
     */
    private $envExamplePath;

    /**
     * Set the .env and .env.example paths.
     */
    public function __construct()
    {
        $this->envPath        = base_path('.env');
        $this->envExamplePath = base_path('.env.example');
    }

    /**
     * Get the content of the .env file.
     *
     * @return string
     */
    public function getEnvContent()
    {
        if (!file_exists($this->envPath)) {
            if (file_exists($this->envExamplePath)) {
                copy($this->envExamplePath, $this->envPath);
            } else {
                touch($this->envPath);
            }
        }

        return file_get_contents($this->envPath);
    }

    /**
     * Get the the .env file path.
     *
     * @return string
     */
    public function getEnvPath()
    {
        return $this->envPath;
    }

    /**
     * Get the the .env.example file path.
     *
     * @return string
     */
    public function getEnvExamplePath()
    {
        return $this->envExamplePath;
    }

    /**
     * Save the edited content to the .env file.
     *
     * @param  Request $input
     * @return string
     */
    public function saveFileClassic(Request $input)
    {
        $message = 'Your .env file settings has been saved';

        try {
            file_put_contents($this->envPath, $input->get('envConfig'));
        } catch (Exception $e) {
            $message = 'Unable to save the .env file, Please create it manually';
        }

        return $message;
    }

    /**
     * Save the form content to the .env file.
     *
     * @param  Request $request
     * @return string
     */
    public function saveFileWizard(Request $request)
    {
        $results = 'Your .env file settings has been saved';

        $envFileData =
        'APP_NAME=\'' . request('app_name', 'Workice') . "'\n" .
        'APP_ENV=' . request('environment', 'production') . "\n" .
        'APP_KEY=' . 'base64:bODi8VtmENqnjklBmNJzQcTTSC8jNjBysfnjQN59btE=' . "\n" .
        'APP_DEBUG=' . request('app_debug', 'false') . "\n" .
        'DEBUGBAR_ENABLED=' . request('debugbar_enabled', 'false') . "\n" .
        'APP_LOG_LEVEL=' . request('app_log_level', 'debug') . "\n" .
        'APP_URL=' . request('app_url', 'https://app.workice.com') . "\n\n" .
        'REDIRECT_HTTPS=' . request('redirect_https', 'false') . "\n" .
        'LARAVEL_PAGE_SPEED_ENABLE=' . request('laravel_page_speed_enable', 'true') . "\n\n" .
        'DB_CONNECTION=' . request('database_connection', 'mysql') . "\n" .
        'DB_HOST=' . request('database_hostname', 'homestead') . "\n" .
        'DB_PORT=' . request('database_port', '3306') . "\n" .
        'DB_DATABASE=' . request('database_name', 'homestead') . "\n" .
        'DB_USERNAME=' . request('database_username', 'root') . "\n" .
        'DB_PASSWORD=' . request('database_password', 'secret') . "\n\n" .
        'BROADCAST_DRIVER=' . request('broadcast_driver', 'log') . "\n" .
        'LOG_CHANNEL=' . request('log_channel', 'daily') . "\n" .
        'CACHE_DRIVER=' . request('cache_driver', 'file') . "\n" .
        'SESSION_DRIVER=' . request('session_driver', 'file') . "\n" .
        'QUEUE_DRIVER=' . request('queue_driver', 'database') . "\n\n" .
        'REDIS_HOST=' . request('redis_hostname', '127.0.0.1') . "\n" .
        'REDIS_PASSWORD=' . request('redis_password', 'null') . "\n" .
        'REDIS_PORT=' . request('redis_port', '6379') . "\n\n" .
        'MAIL_DRIVER=' . request('mail_driver', 'smtp') . "\n" .
        'MAIL_HOST=' . request('mail_host', 'smtp.mailtrap.io') . "\n" .
        'MAIL_PORT=' . request('mail_port', '587') . "\n" .
        'MAIL_USERNAME=' . request('mail_username', 'null') . "\n" .
        'MAIL_PASSWORD=' . request('mail_password', 'null') . "\n" .
        'MAIL_ENCRYPTION=' . request('mail_encryption', 'null') . "\n\n" .
        'PUSHER_APP_ID=' . request('pusher_app_id', '') . "\n" .
        'PUSHER_APP_KEY=' . request('pusher_app_key', '') . "\n" .
        'PUSHER_APP_SECRET=' . request('pusher_app_secret', '') . "\n" .
        'PUSHER_APP_CLUSTER=' . request('pusher_app_cluster', 'ap2') . "\n" .
        'CACHE_PREFIX=' . request('cache_prefix', 'workice') . "\n" .
        'SESSION_LIFETIME=' . request('session_lifetime', '120') . "\n" .
        'FILESYSTEM_DRIVER=' . request('filesystem_driver', 'local') . "\n\n" .
        'MAIL_FROM_ADDRESS=' . request('mail_from_address', 'hello@example.com') . "\n" .
        'MAIL_FROM_NAME=\'' . request('app_name', 'Workice') . "'\n" .
        'BACKUP_DISKS=' . request('backups_disks', 'local') . "\n" .
        'BACKUPS_MAIL_ALERT=' . request('backups_mail_alert', '') . "\n" .
        'BACKUPS_SLACK_WEBHOOK=' . request('backups_slack_webhook', '') . "\n" .
        'BACKUPS_SLACK_CHANNEL=' . request('backups_slack_channel', '') . "\n\n" .
        'TRANSLATION_SOURCE=' . request('translation_source', 'mixed_db') . "\n" .
        'SQS_PUB_KEY=' . request('sqs_pub_key', 'your-public-key') . "\n" .
        'SQS_SEC_KEY=' . request('sqs_sec_key', 'your-secret-key-key') . "\n" .
        'SQS_PREFIX=' . request('sqs_prefix', 'https://sqs.us-east-1.amazonaws.com/your-account-id') . "\n" .
        'SQS_QUEUE_NAME=' . request('sqs_queue_name', 'your-queue-name') . "\n" .
        'SQS_REGION=' . request('sqs_region', 'us-east-1') . "\n\n" .
        'SENTRY_DSN=' . request('sentry_dsn', '') . "\n\n" .
        'NOCAPTCHA_SECRET=' . request('nocaptcha_secret', '') . "\n" .
        'NOCAPTCHA_SITEKEY=' . request('nocaptcha_sitekey', '') . "\n" .
        'CONTENT_SECURITY_POLICY_REPORT_URI=' . request('content_security_policy_report_uri', '') . "\n" .
        'SECURITY_HEADER_HSTS_ENABLE=' . request('security_header_hsts_enable', 'true') . "\n\n" .
        'GOOGLE_CLIENT_ID=' . request('google_client_id', '') . "\n" .
        'GOOGLE_CLIENT_SECRET=' . request('google_secret_id', '') . "\n" .
        'LINKEDIN_CLIENT_ID=' . request('linkedin_client_id', '') . "\n" .
        'LINKEDIN_CLIENT_SECRET=' . request('linkedin_secret_id', '') . "\n" .
        'TWITTER_CLIENT_ID=' . request('twitter_client_id', '') . "\n" .
        'TWITTER_CLIENT_SECRET=' . request('twitter_client_secret', '') . "\n" .
        'GITHUB_CLIENT_ID=' . request('github_client_id', '') . "\n" .
        'GITHUB_CLIENT_SECRET=' . request('github_client_secret', '') . "\n" .
        'GITLAB_CLIENT_ID=' . request('gitlab_client_id', '') . "\n" .
        'GITLAB_CLIENT_SECRET=' . request('gitlab_client_secret', '') . "\n" .
        'FACEBOOK_CLIENT_ID=' . request('facebook_client_id', '') . "\n" .
        'FACEBOOK_CLIENT_SECRET=' . request('facebook_client_secret', '') . "\n" .
        'DROPBOX_AUTHORIZATION_TOKEN=' . request('dropbox_authorization_token', '') . "\n" .
        'MAILGUN_DOMAIN=' . request('mailgun_domain', '') . "\n" .
        'MAILGUN_SECRET=' . request('mailgun_secret', '') . "\n\n" .
        'SES_KEY=' . request('ses_key', '') . "\n" .
        'SES_SECRET=' . request('ses_secret', '') . "\n" .
        'SES_REGION=' . request('ses_region', 'us-east-1') . "\n" .
        'SPARKPOST_SECRET=' . request('sparkpost_secret', '') . "\n" .
        'EMAIL_TRACKING_ENABLE=' . request('email_tracking_enable', 'true') . "\n\n" .
        'AWS_ACCESS_KEY_ID=' . request('aws_access_key_id', '') . "\n" .
        'AWS_SECRET_ACCESS_KEY=' . request('aws_secret_access_key', '') . "\n" .
        'AWS_DEFAULT_REGION=' . request('aws_default_region', '') . "\n" .
        'AWS_BUCKET=' . request('aws_bucket', '') . "\n" .
        'NEXMO_KEY=' . request('nexmo_key', '') . "\n" .
        'NEXMO_SECRET=' . request('nexmo_secret', '') . "\n" .
        'NEXMO_FROM=' . request('nexmo_from', '15556666666') . "\n" .
        'STRIPE_KEY=' . request('stripe_key', '') . "\n" .
        'STRIPE_SECRET=' . request('stripe_secret', '') . "\n" .
        'STRIPE_WEBHOOK_SECRET=' . request('stripe_webhook_secret', '') . "\n" .
        'MOLLIE_KEY=' . request('mollie_key', '') . "\n" .
        '2CHECKOUT_PUBLISHABLE_KEY=' . request('2checkout_publishable_key', '') . "\n" .
        '2CHECKOUT_PRIVATE_KEY=' . request('2checkout_private_key', '') . "\n" .
        '2CHECKOUT_SELLER_ID=' . request('2checkout_seller_id', '') . "\n" .
        'RAZORPAY_KEY=' . request('razorpay_key', '') . "\n" .
        'RAZORPAY_SECRET=' . request('razorpay_secret', '') . "\n" .
        'BRAINTREE_MERCHANT_ID=' . request('braintree_merchant_id', '') . "\n" .
        'BRAINTREE_PUBLIC_KEY=' . request('branitree_public_key', '') . "\n" .
        'BRAINTREE_PRIVATE_KEY=' . request('braintree_private_key', '') . "\n" .
        'WEPAY_ACCOUNT_ID=' . request('wepay_account_id', '') . "\n" .
        'WEPAY_CLIENT_ID=' . request('wepay_client_id', '') . "\n" .
        'WEPAY_SECRET_ID=' . request('wepay_secret_id', '') . "\n" .
        'WEPAY_ACCESS_TOKEN=' . request('wepay_access_token', '') . "\n" .
        'PAYTM_ENV=' . request('paytm_env', 'production') . "\n" .
        'PAYTM_MERCHANT_ID=' . request('paytm_merchant_id', '') . "\n" .
        'PAYTM_MERCHANT_KEY=' . request('paytm_merchant_key', '') . "\n" .
        'PAYTM_WEBSITE=' . request('paytm_website', '') . "\n" .
        'PAYTM_INDUSTRY_TYPE=' . request('paytm_industry_type', 'Retail') . "\n\n" .
        'DAILY_DIGEST_ENABLED=' . request('daily_digest_enabled', 'true') . "\n" .
        'ACTIVITY_DAYS=' . request('activity_days', '180') . "\n" .
        'EMAIL_VERIFICATION=' . request('email_verification', 'false') . "\n" .
        'ALERT_TODO_DAYS=' . request('alert_todo_days', '2') . "\n\n" .
        'ENABLE_DRIFT=' . request('enable_drift', 'false') . "\n" .
        'ENABLE_CRISP=' . request('enable_crisp', 'false') . "\n" .
        'ENABLE_TAWK=' . request('enable_tawk', 'false') . "\n" .
        'ENABLE_ONESIGNAL=' . request('enable_onesignal', 'false') . "\n";
        'DELETE_AFTER=' . request('delete_after', '') . "\n";

        try {
            file_put_contents($this->envPath, $envFileData);
        } catch (Exception $e) {
            $results = 'Unable to save the .env file, Please create it manually.';
        }

        return $results;
    }
}
