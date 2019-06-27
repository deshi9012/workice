<?php

namespace App\Widgets\Comments;

use Arrilot\Widgets\AbstractWidget;

class CreateWidget extends AbstractWidget
{

     /**
      * The configuration array.
      *
      * @var array
      */
    protected $config = [
        'commentable_type' => '',
        'commentable_id' => '',
        'hasFiles' => false,
        'cannedResponse' => false
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data['commentable_type'] = $this->config['commentable_type'];
        $data['commentable_id'] = $this->config['commentable_id'];
        $data['hasFiles'] = $this->config['hasFiles'];
        $data['cannedResponse'] = $this->config['cannedResponse'];
        return view(
            'widgets.comments.create_widget', [
            'config' => $this->config,
            ]
        )->with($data);
    }
}
