<?php

namespace Modules\Tickets\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Knowledgebase\Entities\Knowledgebase;
use Modules\Tickets\Emails\AnswerBotMail;
use Modules\Tickets\Entities\Ticket;

class AnswerBot implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;
    /**
     * Delete the job if its models no longer exist.
     *
     * @var bool
     */
    public $deleteWhenMissingModels = true;

    protected $ticket;

    /**
     * Create a new job instance.
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $articles = Knowledgebase::where('description', 'like', '%' . $this->ticket->subject . '%')
            ->take(5)->get();
        if ($articles->count() > 0) {
            \Mail::to($this->ticket->user)->send(new AnswerBotMail($this->ticket, $articles));
        }
    }
}
