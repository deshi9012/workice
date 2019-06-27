<?php
/*
 * Credits @author: Pietro Cinaglia
 */

return [
    /*
     * Temp folder to store update before to install it.
     */
    'tmp_path'         => 'app/updates/tmp',
    'update_baseurl'   => 'https://desk.workice.com/updates/latest',
    /*
     * Set a middleware for the route: updater.update
     * Only 'auth' NOT works (manage security using 'allow_users_id' configuration)
     */

    'middleware'       => ['web', 'auth'],
    /*
    |--------------------------------------------------------------------------
    | Exclude folders from update
    |--------------------------------------------------------------------------
    |
    | Specifiy folders which should not be updated and will be skipped during the
    | update process.
    |
    | Here's already a list of good examples to skip. You may want to keep those.
    |
     */
    'exclude_folders'  => [
        'node_modules',
        'bootstrap/cache',
        'bower',
        'storage/app/uploads',
        'storage/app/public',
        'storage/app/tmp',
        'storage/framework',
        'storage/logs',
        'storage/updates',
        'vendor',
    ],
    /*
    |---------------------------------------------------------------------------
    | Register custom artisan commands
    |---------------------------------------------------------------------------
     */
    'artisan_commands' => [
        'pre_update'  => [
            'updater:prepare' => [
                'class'  => \App\Console\Commands\PreUpdateTasks::class,
                'params' => [],
            ],
        ],
        'post_update' => [
            'postupdate:cleanup' => [
                'class'  => \App\Console\Commands\PostUpdateCleanup::class,
                'params' => [],
            ],
        ],
    ],
    /*
     * Set which users can perform an update;
     * This parameter accepts: ARRAY(user_id) ,or FALSE => for example: [1]  OR  [1,3,0]  OR  false
     * Generally, ADMIN have user_id=1; set FALSE to disable this check (not recommended)
     */
    'allow_users_id'   => [1],
];
