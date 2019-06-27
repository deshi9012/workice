<?php

namespace Modules\Clients\Observers;

use Auth;
use Modules\Clients\Entities\Client;

class ClientObserver
{

    /**
     * Listen to the Client creating event.
     *
     * @param Client $client
     */
    public function creating(Client $client)
    {
        $client->code  = generateCode('clients');
        $client->owner = Auth::check() ? Auth::id() : 1;
    }

    /**
     * Listen to the Client saved event.
     *
     * @param Client $client
     */
    public function saved(Client $client)
    {
        if (request()->has('tags')) {
            $client->retag(collect(request('tags'))->implode(','));
        }
        $client->saveCustom(request('custom'));
    }

    /**
     * Listen to the Client deleting event.
     *
     * @param Client $client
     */
    public function deleting(Client $client)
    {
        $client->invoices()->each(
            function ($invoice) {
                $invoice->delete();
            }
        );

        $client->estimates()->each(
            function ($estimate) {
                $estimate->delete();
            }
        );

        $client->expenses()->each(
            function ($expense) {
                $expense->delete();
            }
        );

        $client->credits()->each(
            function ($credit) {
                $credit->delete();
            }
        );

        $client->projects()->each(
            function ($project) {
                $project->delete();
            }
        );

        $client->contacts()->each(
            function ($contact) {
                $contact->update(['company' => 0]);
            }
        );

        $client->payments()->each(
            function ($payment) {
                $payment->delete();
            }
        );

        $client->files()->each(
            function ($file) {
                $file->delete();
            }
        );

        $client->comments()->each(
            function ($comment) {
                $comment->delete();
            }
        );

        $client->activities()->each(
            function ($log) {
                $log->delete();
            }
        );

        $client->notes()->each(
            function ($note) {
                $note->delete();
            }
        );

        $client->custom()->each(
            function ($field) {
                $field->delete();
            }
        );

        $client->deals()->each(
            function ($deal) {
                $deal->delete();
            }
        );

        $client->tags()->each(
            function ($tag) {
                $tag->delete();
            }
        );
        if ($client->logo != 'default_avatar.png' && !is_null($client->logo)) {
            \Storage::delete(config('system.logos_dir') . '/' . $client->logo);
        }
    }
}
