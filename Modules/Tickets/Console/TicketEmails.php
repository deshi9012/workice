<?php

namespace Modules\Tickets\Console;

use Ddeboer\Imap\SearchExpression;
use Ddeboer\Imap\Search\Flag\Unseen;
use Ddeboer\Imap\Server;
use Illuminate\Console\Command;
use Modules\Tickets\Entities\Ticket;
use Modules\Users\Entities\User;
use Storage;

class TicketEmails extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tickets:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for email replies for tickets.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Check if IMAP is enabled for tickets and system wide
        if (settingEnabled('ticket_mail_imap') && config('system.imap_enabled') === true) {
            $server = new Server(
                get_option('ticket_mail_host'),
                get_option('ticket_mail_port'),
                get_option('ticket_mail_flags')
            );
            $connection = $server->authenticate(get_option('ticket_mail_username'), get_option('ticket_mail_password'));
            $mailbox    = $connection->getMailbox(get_option('ticket_mailbox'));

            $search = new SearchExpression();
            $search->addCondition(new Unseen());

            $messages = $mailbox->getMessages($search);

            foreach ($messages as $message) {
                $subject = $message->getSubject();
                $from    = $message->getFrom();
                $body    = is_null($message->getBodyHtml()) ? $message->getBodyText() : $message->getBodyHtml();

                if (!is_null($from)) {
                    $code   = strBetween('[', ']', $subject);
                    $ticket = Ticket::where('code', $code)->first();

                    $user = User::firstOrCreate(['email' => $from->getAddress()], [
                        'name'     => $from->getName(),
                        'username' => $from->getAddress(),
                        'password' => genNumber(),
                    ]);

                    if (isset($ticket->id) && isset($user->id)) {
                        // Post a comment reply
                        $reply   = substr($body, 0, strpos($body, "##-"));
                        $comment = $ticket->comments()->create(
                            [
                                'user_id' => $user->id, 'parent' => 0, 'message' => strip_tags($reply, "<br>"),
                            ]
                        );
                        $uploadDir = 'uploads/comments';
                        foreach ($message->getAttachments() as $file) {
                            $fileName = genUnique() . '_' . $file->getFilename();
                            Storage::put($uploadDir . '/' . $fileName, $file->getDecodedContent());
                            $comment->files()->create(
                                [
                                    'filename'    => $fileName, 'title' => $ticket->subject,
                                    'path'        => $uploadDir, 'ext'  => strtolower($file->getType() . '/' . $file->getSubtype()),
                                    'size'        => round($file->getBytes() / 1024, 2),
                                    'description' => $ticket->subject . ' file uploaded via email',
                                    'user_id'     => $user->id,
                                ]
                            );
                        }
                    } else {
                        // Create a new ticket if the reporter exists
                        $ticket = Ticket::create(
                            [
                                'subject'  => $subject, 'department' => get_option('ticket_default_department'),
                                'priority' => '2', 'body'            => $body, 'user_id' => $user->id,
                            ]
                        );
                        $uploadDir = 'uploads/tickets';
                        foreach ($message->getAttachments() as $file) {
                            $fileName = genUnique() . '_' . $file->getFilename();
                            Storage::put($uploadDir . '/' . $fileName, $file->getDecodedContent());
                            $ticket->files()->create(
                                [
                                    'filename'    => $fileName, 'title' => $ticket->subject,
                                    'path'        => $uploadDir, 'ext'  => strtolower($file->getType() . '/' . $file->getSubtype()),
                                    'size'        => round($file->getBytes() / 1024, 2),
                                    'adapter'     => config('filesystems.default'),
                                    'description' => $ticket->subject . ' file uploaded via email',
                                    'user_id'     => $user->id,
                                ]
                            );
                        }
                    }
                }
                $message->markAsSeen();
            }
        }

        $this->info('Ticket emails synced successfully');
    }
}
