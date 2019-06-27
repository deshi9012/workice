<?php

return [

    /*
     * Server
     *
     * Reference: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Server
     *
     * Note: when server is empty string, it will not add to response header
     */

    'server'                            => '',

    /*
     * X-Content-Type-Options
     *
     * Reference: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-Content-Type-Options
     *
     * Available Value: 'nosniff'
     */

    'x-content-type-options'            => 'nosniff',

    /*
     * X-Download-Options
     *
     * Reference: https://msdn.microsoft.com/en-us/library/jj542450(v=vs.85).aspx
     *
     * Available Value: 'noopen'
     */

    'x-download-options'                => 'noopen',

    /*
     * X-Frame-Options
     *
     * Reference: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-Frame-Options
     *
     * Available Value: 'deny', 'sameorigin', 'allow-from <uri>'
     */

    'x-frame-options'                   => 'sameorigin',

    /*
     * X-Permitted-Cross-Domain-Policies
     *
     * Reference: https://www.adobe.com/devnet/adobe-media-server/articles/cross-domain-xml-for-streaming.html
     *
     * Available Value: 'all', 'none', 'master-only', 'by-content-type', 'by-ftp-filename'
     */

    'x-permitted-cross-domain-policies' => 'none',

    /*
     * X-XSS-Protection
     *
     * Reference: https://blogs.msdn.microsoft.com/ieinternals/2011/01/31/controlling-the-xss-filter
     *
     * Available Value: '1', '0', '1; mode=block'
     */

    'x-xss-protection'                  => '1; mode=block',

    /*
     * Referrer-Policy
     *
     * Reference: https://w3c.github.io/webappsec-referrer-policy
     *
     * Available Value: 'no-referrer', 'no-referrer-when-downgrade', 'origin', 'origin-when-cross-origin',
     *                  'same-origin', 'strict-origin', 'strict-origin-when-cross-origin', 'unsafe-url'
     */

    'referrer-policy'                   => 'no-referrer-when-downgrade',

    /*
     * HTTP Strict Transport Security
     *
     * Reference: https://developer.mozilla.org/en-US/docs/Web/Security/HTTP_strict_transport_security
     *
     * Please ensure your website had set up ssl/tls before enable hsts.
     */

    'hsts'                              => [
        'enable'              => env('SECURITY_HEADER_HSTS_ENABLE', false),

        'max-age'             => 31536000,

        'include-sub-domains' => true,
    ],

    /*
     * Public Key Pinning
     *
     * Reference: https://developer.mozilla.org/en-US/docs/Web/Security/Public_Key_Pinning
     *
     * hpkp will be ignored if hashes is empty.
     */

    'hpkp'                              => [
        'hashes'              => [
            // [
            //     'algo' => 'sha256',
            //     'hash' => 'hash-value',
            // ],
        ],

        'include-sub-domains' => false,

        'max-age'             => 15552000,

        'report-only'         => false,

        'report-uri'          => null,
    ],

    /*
     * Content Security Policy
     *
     * Reference: https://developer.mozilla.org/en-US/docs/Web/Security/CSP
     *
     * csp will be ignored if custom-csp is not null. To disable csp, set custom-csp to empty string.
     *
     * Note: custom-csp does not support report-only.
     */

    'custom-csp'                        => env('SECURITY_HEADER_CUSTOM_CSP', null),

    'csp'                               => [
        'report-only'                          => false,

        'report-uri'                           => env('CONTENT_SECURITY_POLICY_REPORT_URI', false),

        'upgrade-insecure-requests'            => false,

        // enable or disable the automatic conversion of sources to https
        'https-transform-on-https-connections' => true,

        'base-uri'                             => [
            //
        ],

        'default-src'                          => [
            'self' => true,
        ],

        'child-src'                            => [
        ],
        'worker-src'                           => [
            'allow' => [
                'blob:',
            ],
        ],
        'frame-src'                            => [
            'allow' => [
                'https://*.stripe.com',
                'https://*.twitter.com',
                'https://onesignal.com',
                'https://*.paypal.com',
                'https://*.razorpay.com',
                'https://*.braintreegateway.com',
                'https://*.driftt.com',
                'https://va.tawk.to',
                'https://*.google.com',
                'https://*.codecanyon.net',
            ],
        ],

        'script-src'                           => [
            'allow'         => [
                'https://*.googleapis.com',
                'https://code.jquery.com',
                'https://www.googletagmanager.com',
                'https://www.google-analytics.com',
                'https://*.pusher.com',
                'https://cdnjs.cloudflare.com',
                'http://cdnjs.cloudflare.com',
                'https://www.gstatic.com',
                'https://cdn.jsdelivr.net',
                'https://static.filestackapi.com',
                'https://unpkg.com',
                'https://*.stripe.com',
                'https://use.fontawesome.com/',
                'https://*.newrelic.com',
                'https://bam.nr-data.net',
                'https://*.crisp.chat',
                'https://cdn.datatables.net',
                'https://platform.twitter.com',
                'https://*.onesignal.com',
                'https://onesignal.com',
                'https://*.paypalobjects.com',
                'https://*.paypal.com',
                'https://*.2checkout.com',
                'https://*.razorpay.com',
                'https://*.braintreegateway.com',
                'https://*.driftt.com',
                'https://embed.tawk.to',
                'https://*.google.com',
                'https://*.googleadservices.com',

            ],

            'hashes'        => [
                // ['sha256' => 'hash - value'],
            ],

            'nonces'        => [
                //
            ],
            'unsafe-inline' => true,
            'unsafe-eval'   => true, // TODO check this
            'self'          => true,
        ],

        'style-src'                            => [
            'allow'         => [
                'https: //fonts.googleapis.com',
                'http: //fonts.googleapis.com',
                'https://maxcdn.bootstrapcdn.com',
                'https://www.gstatic.com',
                'https://cdn.datatables.net',
                'https://cdn.jsdelivr.net/',
                'https://static.filestackapi.com',
                'https://*.crisp.chat',
                'https://onesignal.com',
                'https://*.stripe.com',
                'https://*.braintreegateway.com',
            ],

            'self'          => true,

            'unsafe-inline' => true,
        ],

        'img-src'                              => [
            'allow' => [
                '*',
                'data:',
            ],

            'types' => [
                //
            ],

            'self'  => true,

            'data'  => true,
        ],

        /*
         * The following directives are all use 'allow' and 'self' flag.
         *
         * Note: default value of 'self' flag is false.
         */

        'font-src'                             => [
            'allow' => [
                'https://fonts.gstatic.com',
                'http://fonts.gstatic.com',
                'https://maxcdn.bootstrapcdn.com',
                'https://*.crisp.chat',
                'https://static-v.tawk.to',
                'data:',
            ],
            'data'  => 'fonts.gstatic.com',
            'self'  => true,
        ],

        'connect-src'                          => [
            'allow' => [
                'https://*.pusher.com',
                'wss://*.pusher.com',
                'wss://*.pusherapp.com',
                'https://*.cloudflare.com',
                'wss://*.relay.crisp.chat',
                'https://*.crisp.chat',
                'https://*.filestackapi.com',
                'https://s3.amazonaws.com',
                'https://*.gitbench.com',
                'https://*.stripe.com',
                'https://*.workice.com',
                'https://*.paypal.com',
                'https://*.braintree-api.com',
                'https://*.braintreegateway.com',
                'https://*.google-analytics.com',
                'https://*.tawk.to',
                'wss://*.tawk.to',

            ],
            'self'  => true,
        ],

        'form-action'                          => [
            'allow' => [
                'https://*.twitter.com',
                'https://*.paypal.com',
                'https://*.mollie.com',
                'https://va.tawk.to',
            ],
            'self'  => true,
        ],

        'frame-ancestors'                      => [
            //
        ],

        'media-src'                            => [
            //
        ],

        'object-src'                           => [
            //
        ],

        /*
         * plugin-types only support 'allow'.
         */

        'plugin-types'                         => [
            //
        ],
    ],

];
