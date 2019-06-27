<?php

namespace App\Widgets\Emails;

use Arrilot\Widgets\AbstractWidget;

class SendContactEmail extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'id' => '',
        'subject' => ''
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data['id'] = $this->config['id'];
        $data['subject'] = $this->config['subject'];

        return view(
            'widgets.emails.send_contact_email', [
            'config' => $this->config,
            ]
        )->with($data);
    }
}
