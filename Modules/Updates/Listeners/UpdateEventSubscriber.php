<?php

namespace Modules\Updates\Listeners;

use Modules\Updates\Notifications\ImportSuccessAlert;
use Modules\Updates\Notifications\LatestVersionAlert;
use Modules\Updates\Notifications\UpdateAvailableAlert;
use Modules\Updates\Notifications\UpdateFailedAlert;
use Modules\Updates\Notifications\UpdateRestoreAlert;
use Modules\Updates\Notifications\UpdateRestoreFailedAlert;
use Modules\Updates\Notifications\UpdateSuccessfulAlert;
use Modules\Users\Entities\User;

class UpdateEventSubscriber
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Data has been imported
     */
    public function onImportSuccessful($event)
    {
        $user = User::find($event->user);
        $user->notify(new ImportSuccessAlert());
        \Artisan::queue('app:balances');
    }

    /**
     * Running on Latest version
     */
    public function onLatestVersion($event)
    {
        $user = User::find($event->user);
        $user->notify(new LatestVersionAlert());
    }

    /**
     * Update is available
     */
    public function onUpdateAvailable($event)
    {
        $user = User::role('admin')->first();
        $user->notify(new UpdateAvailableAlert($event->latest));
    }

    /**
     * Update Failed
     */
    public function onUpdateFailed($event)
    {
        $user = User::find($event->user);
        $user->notify(new UpdateFailedAlert());
    }

    /**
     * Update Restored
     */
    public function onUpdateRestored($event)
    {
        $user = User::find($event->user);
        $user->notify(new UpdateRestoreAlert());
    }

    /**
     * Update Restore Failed
     */
    public function onUpdateRestoreFailed($event)
    {
        $user = User::find($event->user);
        $user->notify(new UpdateRestoreFailedAlert());
    }

    /**
     * Update Successfull
     */
    public function onUpdateSuccessful($event)
    {
        $user = User::find($event->user);
        $user->notify(new UpdateSuccessfulAlert());
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Modules\Updates\Events\ImportSuccessful',
            'Modules\Updates\Listeners\UpdateEventSubscriber@onImportSuccessful'
        );
        $events->listen(
            'Modules\Updates\Events\LatestVersion',
            'Modules\Updates\Listeners\UpdateEventSubscriber@onLatestVersion'
        );
        $events->listen(
            'Modules\Updates\Events\UpdateAvailable',
            'Modules\Updates\Listeners\UpdateEventSubscriber@onUpdateAvailable'
        );
        $events->listen(
            'Modules\Updates\Events\UpdateFailed',
            'Modules\Updates\Listeners\UpdateEventSubscriber@onUpdateFailed'
        );
        $events->listen(
            'Modules\Updates\Events\UpdateRestored',
            'Modules\Updates\Listeners\UpdateEventSubscriber@onUpdateRestored'
        );
        $events->listen(
            'Modules\Updates\Events\UpdateRestoreFailed',
            'Modules\Updates\Listeners\UpdateEventSubscriber@onUpdateRestoreFailed'
        );
        $events->listen(
            'Modules\Updates\Events\UpdateSuccessful',
            'Modules\Updates\Listeners\UpdateEventSubscriber@onUpdateSuccessful'
        );
    }
}
