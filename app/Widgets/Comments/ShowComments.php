<?php

namespace App\Widgets\Comments;

use Arrilot\Widgets\AbstractWidget;

class ShowComments extends AbstractWidget
{

     /**
      * The configuration array.
      *
      * @var array
      */
    protected $config = [
        'comments' => [],
        'withReplies' => false
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data['comments'] = $this->config['comments'];
        $data['withReplies'] = $this->config['withReplies'];

        return view(
            'widgets.comments.show_comments', [
            'config' => $this->config,
            ]
        )->with($data);
    }
}
