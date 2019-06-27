<?php

namespace App\Widgets\Emails;

use Arrilot\Widgets\AbstractWidget;

class ShowEmails extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'emails' => []
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data['emails'] = $this->config['emails'];

        return view(
            'widgets.emails.show_emails', [
            'config' => $this->config,
            ]
        )->with($data);
    }
}
