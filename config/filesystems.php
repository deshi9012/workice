<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
     */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
     */

    'cloud'   => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
     */

    'disks'   => [

        'local'     => [
            'driver' => 'local',
            'root'   => storage_path('app'),
        ],

        'public'    => [
            'driver'     => 'local',
            'root'       => storage_path('app/public'),
            'url'        => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        's3'        => [
            'driver' => 's3',
            'url'    => env('AWS_URL'),
            'key'    => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],
        'dropbox'   => [
            'driver'             => 'dropbox',
            'authorizationToken' => env('DROPBOX_AUTHORIZATION_TOKEN'),
        ],
        'ftp'       => [
            'driver'   => 'ftp',
            'host'     => env('FTP_HOST', 'ftp.example.com'),
            'username' => env('FTP_USERNAME', 'your-username'),
            'password' => env('FTP_PASSWORD', 'your-password'),

            // Optional FTP Settings...
            'port'     => env('FTP_PORT', 21),
            'root'     => env('FTP_ROOT', ''),
            'passive'  => env('FTP_PASSIVE', true),
            'ssl'      => env('FTP_SSL', true),
            'timeout'  => env('FTP_TIMEOUT', 30),
        ],
        'sftp'      => [
            'driver'   => 'sftp',
            'host'     => env('SFTP_HOST', 'example.com'),
            'username' => env('SFTP_USERNAME', 'your-username'),
            'password' => env('SFTP_PASSWORD', 'your-password'),

            // Settings for SSH key based authentication...
            // 'privateKey' => '/path/to/privateKey',
            // 'password' => 'encryption-password',

            // Optional SFTP Settings...
            'port'     => env('SFTP_PORT', 22),
            'root'     => env('SFTP_ROOT', ''),
            'timeout'  => env('SFTP_TIMEOUT', 30),
        ],
        'rackspace' => [
            'driver'    => 'rackspace',
            'username'  => env('RACKSPACE_USERNAME', 'your-username'),
            'key'       => env('RACKSPACE_KEY', 'your-key'),
            'container' => env('RACKSPACE_CONTAINER', 'your-container'),
            'endpoint'  => 'https://identity.api.rackspacecloud.com/v2.0/',
            'region'    => env('RACKSPACE_REGION', 'IAD'),
            'url_type'  => env('RACKSPACE_URL', 'publicURL'),
        ],

    ],

];
