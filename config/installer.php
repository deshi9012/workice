<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Server Requirements
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel server requirements, you can add as many
    | as your application require, we check if the extension is enabled
    | by looping through the array and run "extension_loaded" on it.
    |
     */
    'core'                   => [
        'minPhpVersion' => '7.1.3',
    ],
    'requirements'           => [
        'php'    => [
            'openssl',
            'pdo',
            'mbstring',
            'tokenizer',
            'JSON',
            'cURL',
            'mysqli',
            'imap',
            'zip',
            'gd',
        ],
        'apache' => [
            'mod_rewrite',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Folders Permissions
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel folders permissions, if your application
    | requires more permissions just add them to the array list bellow.
    |
     */
    'permissions'            => [
        'storage/app/'       => '775',
        'storage/framework/' => '775',
        'storage/logs/'      => '775',
        'bootstrap/cache/'   => '775',
    ],

    /*
    |--------------------------------------------------------------------------
    | Environment Form Wizard Validation Rules & Messages
    |--------------------------------------------------------------------------
    |
    | This are the default form vield validation rules. Available Rules:
    | https://laravel.com/docs/5.4/validation#available-validation-rules
    |
     */
    'environment'            => [
        'form' => [
            'rules' => [
                'app_name'            => 'required|string|max:50',
                'environment'         => 'sometimes|string|max:50',
                'environment_custom'  => 'required_if:environment,other|max:50',
                'app_debug'           => [
                    'sometimes',
                    // Rule::in(['true', 'false']),
                ],
                'user.email'          => 'required|email',
                'user.password'       => 'required',
                'user.name'           => 'required|string:max:50',
                'app_log_level'       => 'sometimes|string|max:50',
                'app_url'             => 'required|url',
                'database_connection' => 'required|string|max:50',
                'database_hostname'   => 'required|string|max:50',
                'database_port'       => 'required|numeric',
                'database_name'       => 'required|string|max:50',
                'database_username'   => 'required|string|max:50',
                'database_password'   => 'required|string|max:50',
                'broadcast_driver'    => 'sometimes|string|max:50',
                'cache_driver'        => 'sometimes|string|max:50',
                'session_driver'      => 'sometimes|string|max:50',
                'queue_connection'    => 'sometimes|string|max:50',
                'redis_hostname'      => 'sometimes|string|max:50',
                'redis_password'      => 'sometimes|string|max:50',
                'redis_port'          => 'sometimes|numeric',
                'mail_driver'         => 'sometimes|string|max:50',
                'mail_host'           => 'sometimes|string|max:50',
                'mail_port'           => 'sometimes|string|max:50',
                'mail_username'       => 'sometimes|string|max:50',
                'mail_password'       => 'sometimes|string|max:50',
                'mail_encryption'     => 'sometimes|string|max:50',
                'pusher_app_id'       => 'max:50',
                'pusher_app_key'      => 'max:50',
                'pusher_app_secret'   => 'max:50',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Installed Middlware Options
    |--------------------------------------------------------------------------
    | Different available status switch configuration for the
    | canInstall middleware located in `canInstall.php`.
    |
     */
    'installed'              => [
        'redirectOptions' => [
            'route' => [
                'name' => 'welcome',
                'data' => [],
            ],
            'abort' => [
                'type' => '404',
            ],
            'dump'  => [
                'data' => 'Dumping a not found message.',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Selected Installed Middlware Option
    |--------------------------------------------------------------------------
    | The selected option fo what happens when an installer intance has been
    | Default output is to `/resources/views/error/404.blade.php` if none.
    | The available middleware options include:
    | route, abort, dump, 404, default, ''
    |
     */
    'installedAlreadyAction' => '',

    /*
    |--------------------------------------------------------------------------
    | Updater Enabled
    |--------------------------------------------------------------------------
    | Can the application run the '/update' route with the migrations.
    | The default option is set to False if none is present.
    | Boolean value
    |
     */
    'updaterEnabled'         => 'true',

];
