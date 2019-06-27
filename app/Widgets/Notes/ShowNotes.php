<?php

namespace App\Widgets\Notes;

use Arrilot\Widgets\AbstractWidget;

class ShowNotes extends AbstractWidget
{

     /**
      * The configuration array.
      *
      * @var array
      */
    protected $config = [
        'notes' => [],
        'noteable_type' => '',
        'noteable_id' => '',
        'title' => '',
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data['notes'] = $this->config['notes'];
        $data['noteable_type'] = $this->config['noteable_type'];
        $data['noteable_id'] = $this->config['noteable_id'];
        $data['title'] = $this->config['title'];

        return view(
            'widgets.notes.show_notes', [
            'config' => $this->config,
            ]
        )->with($data);
    }
}
