<?php

namespace Modules\Users\Jobs;

use App\Entities\Phone;
use App\Entities\Vault;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Comments\Entities\Comment;
use Modules\Comments\Transformers\CommentsResource;
use Modules\Estimates\Entities\Estimate;
use Modules\Estimates\Transformers\EstimatesResource;
use Modules\Expenses\Entities\Expense;
use Modules\Expenses\Transformers\ExpensesResource;
use Modules\Extras\Transformers\CallsResource;
use Modules\Invoices\Entities\Invoice;
use Modules\Invoices\Transformers\InvoicesResource;
use Modules\Notes\Entities\Note;
use Modules\Notes\Transformers\NotesResource;
use Modules\Payments\Entities\Payment;
use Modules\Payments\Transformers\PaymentsResource;
use Modules\Tickets\Entities\Ticket;
use Modules\Tickets\Transformers\TicketsResource;
use Modules\Users\Emails\GDPRData;
use Modules\Users\Entities\User;
use Modules\Users\Transformers\UserResource;
use Modules\Users\Transformers\VaultsResource;

class GDPRExportData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    protected $user;
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->data = [];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->personalData();
        $this->ticketsData();
        $this->notesData();
        $this->messagesData();
        $this->invoicesData();
        $this->paymentsData();
        $this->expensesData();
        $this->estimatesData();
        $this->commentsData();
        $this->callsData();
        $this->vaultsData();
        $this->zipData();
        $this->emailData();
        $this->cleanFolder();
    }

    protected function personalData()
    {
        $this->data['profile'] = new UserResource($this->user);
        \Storage::put('tmp/' . $this->user->id . '/personal.json', json_encode($this->data['profile']));
    }
    protected function ticketsData()
    {
        $tickets               = Ticket::where('user_id', $this->user->id)->whereNull('archived_at')->get();
        $this->data['tickets'] = new TicketsResource($tickets);
        \Storage::put('tmp/' . $this->user->id . '/tickets.json', json_encode($this->data['tickets']));
    }
    protected function notesData()
    {
        $notes               = Note::where('user_id', $this->user->id)->get();
        $this->data['notes'] = new NotesResource($notes);
        \Storage::put('tmp/' . $this->user->id . '/notes.json', json_encode($this->data['notes']));
    }
    protected function messagesData()
    {
        $messages               = \Modules\Messages\Facades\Talk::getInboxAll();
        $this->data['messages'] = $messages;
        \Storage::put('tmp/' . $this->user->id . '/messages.json', json_encode($this->data['messages']));
    }
    protected function invoicesData()
    {
        $invoices               = Invoice::where('client_id', $this->user->profile->company)->whereNull('archived_at')->get();
        $this->data['invoices'] = new InvoicesResource($invoices);
        \Storage::put('tmp/' . $this->user->id . '/invoices.json', json_encode($this->data['invoices']));
    }
    protected function paymentsData()
    {
        $payments               = Payment::where('client_id', $this->user->profile->company)->whereNull('archived_at')->get();
        $this->data['payments'] = new PaymentsResource($payments);
        \Storage::put('tmp/' . $this->user->id . '/payments.json', json_encode($this->data['payments']));
    }
    protected function expensesData()
    {
        $expenses               = Expense::where('client_id', $this->user->profile->company)->whereNull('archived_at')->get();
        $this->data['expenses'] = new ExpensesResource($expenses);
        \Storage::put('tmp/' . $this->user->id . '/expenses.json', json_encode($this->data['expenses']));
    }
    protected function estimatesData()
    {
        $estimates               = Estimate::where('client_id', $this->user->profile->company)->whereNull('archived_at')->get();
        $this->data['estimates'] = new EstimatesResource($estimates);
        \Storage::put('tmp/' . $this->user->id . '/estimates.json', json_encode($this->data['estimates']));
    }
    protected function commentsData()
    {
        $comments               = Comment::where('user_id', $this->user->id)->get();
        $this->data['comments'] = new CommentsResource($comments);
        \Storage::put('tmp/' . $this->user->id . '/comments.json', json_encode($this->data['comments']));
    }
    protected function callsData()
    {
        $calls               = Phone::where('user_id', $this->user->id)->get();
        $this->data['calls'] = new CallsResource($calls);
        \Storage::put('tmp/' . $this->user->id . '/calls.json', json_encode($this->data['calls']));
    }
    protected function vaultsData()
    {
        $vaults               = Vault::where('user_id', $this->user->id)->get();
        $this->data['vaults'] = new VaultsResource($vaults);
        \Storage::put('tmp/' . $this->user->id . '/vaults.json', json_encode($this->data['vaults']));
    }
    protected function zipData()
    {
        $storage = storage_path('app/tmp/');
        $files   = glob($storage . $this->user->id . '/*.json');
        $zip     = \App\Facades\ZipFacade::create($storage . 'user_' . $this->user->id . '_data.zip');
        $zip->add($files);
        $zip->close();
    }
    protected function emailData()
    {
        \Mail::to($this->user)->send(new GDPRData($this->user));
    }
    protected function cleanFolder()
    {
        \Storage::deleteDirectory('tmp/' . $this->user->id);
        if (\Storage::exists('tmp/user_' . $this->user->id . '_data.zip')) {
            \Storage::delete('tmp/user_' . $this->user->id . '_data.zip');
        }
    }
}
