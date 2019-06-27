<?php

namespace Modules\Contacts\Console;

use Ddeboer\Imap\SearchExpression;
use Ddeboer\Imap\Search\Flag\Unseen;
use Ddeboer\Imap\Server;
use Illuminate\Console\Command;
use Modules\Users\Entities\User;
use Storage;

class ContactEmails extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'contacts:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for contact emails via IMAP.';

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
        if (settingEnabled('contact_mail_imap') && config('system.imap_enabled') === true) {
            $server = new Server(
                get_option('contact_mail_host'),
                get_option('contact_mail_port'),
                get_option('contact_mail_flags')
            );
            $connection = $server->authenticate(get_option('contact_mail_username'), get_option('contact_mail_password'));
            $mailbox    = $connection->getMailbox(get_option('contact_mailbox'));

            $search = new SearchExpression();
            $search->addCondition(new Unseen());

            $messages = $mailbox->getMessages($search);

            foreach ($messages as $message) {
                $subject = $message->getSubject();
                $from    = $message->getFrom();
                $body    = is_null($message->getBodyHtml()) ? $message->getBodyText() : $message->getBodyHtml();

                if (!is_null($from)) {
                    $user = User::where('email', $from->getAddress())->first();

                    if (isset($user->id)) {
                        // Save email to database
                        $email = $user->emails()->create([
                            'to'          => 0,
                            'from'        => $user->id,
                            'subject'     => $subject,
                            'message'     => $body,
                            'mail_folder' => get_option('contact_mailbox'),
                            'meta'        => $message->getTo(),
                        ]);
                        $uploadDir = 'uploads/emails';
                        foreach ($message->getAttachments() as $file) {
                            $fileName = genUnique() . '_' . $file->getFilename();
                            Storage::put($uploadDir . '/' . $fileName, $file->getDecodedContent());
                            $email->files()->create(
                                [
                                    'filename'    => $fileName, 'title' => $email->subject,
                                    'path'        => $uploadDir, 'ext'  => strtolower($file->getType() . '/' . $file->getSubtype()),
                                    'size'        => round($file->getBytes() / 1024, 2),
                                    'adapter'     => config('filesystems.default'),
                                    'description' => $email->subject . ' file uploaded via email',
                                    'user_id'     => $user->id,
                                ]
                            );
                        }
                    }
                }
                $message->markAsSeen();
            }
        }
        $this->info('Contact emails synced successfully');
    }
}
