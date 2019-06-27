<?php

namespace Modules\Users\Observers;

use Illuminate\Support\Facades\Storage;
use Modules\Clients\Entities\Client;
use Modules\Deals\Entities\Deal;
use Modules\Users\Entities\Profile;
use Modules\Users\Entities\User;
use Modules\Users\Entities\UserHasDepartment;
use Spatie\Permission\Models\Role;

class UserObserver
{
    /**
     * Listen to the User creating event.
     *
     * @param User $user
     */
    public function creating(User $user)
    {
        if (is_null($user->calendar_token)) {
            $user->calendar_token = str_random(60);
        }
    }

    /**
     * Listen to the User created event.
     *
     * @param User $user
     */
    public function created(User $user)
    {
        $user->profile()->create([
            'avatar' => 'default_avatar.png',
        ]);
        if (!$user->hasAnyRole(Role::all())) {
            $user->assignRole(get_option('default_role', 'client'));
        }
        if (is_null($user->access_token)) {
            $user->update(['access_token' => $user->createToken('Access Token')->accessToken]);
        }
    }

    /**
     * Listen to the User saved event.
     *
     * @param User $user
     */
    public function saved(User $user)
    {
        if (request()->has('department')) {
            UserHasDepartment::where('user_id', $user->id)->delete();
            if (request('department') != 0) {
                foreach (request('department') as $dept) {
                    $user->departments()->create(['department_id' => $dept]);
                }
            }
        }
    }

    /**
     * Listen to User deleting event.
     *
     * @param User $user
     */
    public function deleting(User $user)
    {
        $user->comments()->each(
            function ($comment) {
                $comment->delete();
            }
        );
        $user->feeds()->each(
            function ($activity) {
                $activity->delete();
            }
        );

        $user->messages()->each(
            function ($message) {
                $message->delete();
            }
        );

        $user->tickets()->each(
            function ($ticket) {
                $ticket->delete();
            }
        );

        $user->uploads()->each(
            function ($file) {
                $file->delete();
            }
        );
        $user->timesheet()->each(
            function ($tm) {
                $tm->delete();
            }
        );

        $user->quickAccess()->each(
            function ($qa) {
                $qa->delete();
            }
        );

        $user->deals()->each(
            function ($deal) {
                $deal->delete();
            }
        );

        $user->issues()->each(
            function ($issue) {
                $issue->delete();
            }
        );
        $user->assignments()->each(
            function ($assignment) {
                $assignment->delete();
            }
        );
        $user->articles()->each(
            function ($article) {
                $article->delete();
            }
        );
        $user->announcements()->each(
            function ($announcement) {
                $announcement->delete();
            }
        );
        $user->expenses()->each(
            function ($expense) {
                $expense->delete();
            }
        );
        $user->leads()->each(
            function ($lead) {
                $lead->delete();
            }
        );
        $user->todos()->each(
            function ($todo) {
                $todo->delete();
            }
        );
        $user->appointments()->each(
            function ($appointment) {
                $appointment->delete();
            }
        );
        $user->schedules()->each(
            function ($event) {
                $event->delete();
            }
        );
        $user->cannedResponses()->each(
            function ($response) {
                $response->delete();
            }
        );
        $user->links()->each(
            function ($link) {
                $link->delete();
            }
        );
        $user->signatures()->each(
            function ($signature) {
                $signature->delete();
            }
        );
        $user->feedbacks()->each(
            function ($feedback) {
                $feedback->delete();
            }
        );
        $user->vault()->each(
            function ($vault) {
                $vault->delete();
            }
        );
        $user->calls()->each(
            function ($call) {
                $call->delete();
            }
        );
        $user->departments()->each(
            function ($department) {
                $department->delete();
            }
        );

        if (optional($user->profile)->avatar != 'default_avatar.png') {
            Storage::delete(config('system.avatar_dir') . '/' . optional($user->profile)->avatar);
        }

        Client::wherePrimaryContact($user->id)->update(['primary_contact' => 0]);
        Deal::whereContactPerson($user->id)->update(['contact_person' => 0]);

        optional($user->profile)->delete();
    }
}
