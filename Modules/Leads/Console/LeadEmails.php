<?php

namespace Modules\Leads\Console;

use Ddeboer\Imap\SearchExpression;
use Ddeboer\Imap\Search\Flag\Unseen;
use Ddeboer\Imap\Server;
use Illuminate\Console\Command;
use Modules\Leads\Entities\Lead;
use Storage;

class LeadEmails extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'leads:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for emails from lead.';

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
        if (settingEnabled('lead_mail_imap') && config('system.imap_enabled') === true) {
            $server = new Server(
                get_option('lead_mail_host'),
                get_option('lead_mail_port'),
                get_option('lead_mail_flags')
            );
            $connection = $server->authenticate(get_option('lead_mail_username'), get_option('lead_mail_password'));
            $mailbox    = $connection->getMailbox(get_option('lead_mailbox'));

            $search = new SearchExpression();
            $search->addCondition(new Unseen());

            $messages = $mailbox->getMessages($search);

            foreach ($messages as $message) {
                $subject = $message->getSubject();
                $from    = $message->getFrom();
                $body    = is_null($message->getBodyHtml()) ? $message->getBodyText() : $message->getBodyHtml();

                if (!is_null($from)) {
                    $lead = Lead::where('email', $from->getAddress())->first();

                    if (isset($lead->id)) {
                        // Save email to database
                        $email = $lead->emails()->create([
                            'to'          => 0,
                            'from'        => $lead->id,
                            'subject'     => $subject,
                            'message'     => $body,
                            'mail_folder' => get_option('lead_mailbox'),
                            'meta'        => [
                                'sender' => $from->getAddress(),
                            ],
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
                                    'user_id'     => $lead->id,
                                ]
                            );
                        }
                        $lead->unsetEventDispatcher();
                        $lead->compute();
                    } else {
                        Lead::create(['email' => $from->getAddress(), 'name' => $from->getName()]);
                    }
                }
                $message->markAsSeen();
            }
        }
        $this->info('Lead emails synced successfully');
    }
}
