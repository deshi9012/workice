<?php

namespace Modules\Knowledgebase\Listeners;

use Illuminate\Session\Store;

class ArticleEventSubscriber
{
    protected $user;
    /**
     * Session store instance
     */
    protected $session;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Store $session)
    {
        $this->user    = \Auth::id() ?? 1;
        $this->session = $session;
    }

    /**
     * Article created listener
     */
    public function onArticleCreated($event)
    {
        $data = [
            'action' => 'activity_create_article', 'icon'  => 'fa-file-text-o', 'user_id' => $this->user,
            'value1' => $event->article->subject, 'value2' => $event->article->category->name,
            'url'    => $event->article->url,
        ];
        $event->article->activities()->create($data);
    }

    /**
     * Article viewed listener
     */
    public function onArticleViewed($event)
    {
        if (!$this->isArticleViewed($event->kb)) {
            $event->kb->increment('views');
            $event->kb->views += 1;
            $this->storeViewedArticle($event->kb);
        }
        $viewed = $this->getViewedArticles();
        $this->cleanExpiredViews($viewed);
    }

    /**
     * Article updated listener
     */
    public function onArticleUpdated($event)
    {
        $data = [
            'action' => 'activity_update_article', 'icon'  => 'fa-pencil-alt', 'user_id' => $this->user,
            'value1' => $event->article->subject, 'value2' => $event->article->category->name,
            'url'    => $event->article->url,
        ];
        $event->article->activities()->create($data);
    }

    /**
     * Article deleted listener
     */
    public function onArticleDeleted($event)
    {
        $data = [
            'action' => 'activity_delete_article', 'icon'  => 'fa-trash-alt', 'user_id' => $this->user,
            'value1' => $event->article->subject, 'value2' => $event->article->category->name,
            'url'    => $event->article->url,
        ];
        $event->article->activities()->create($data);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Modules\Knowledgebase\Events\ArticleCreated',
            'Modules\Knowledgebase\Listeners\ArticleEventSubscriber@onArticleCreated'
        );
        $events->listen(
            'Modules\Knowledgebase\Events\ArticleViewed',
            'Modules\Knowledgebase\Listeners\ArticleEventSubscriber@onArticleViewed'
        );

        $events->listen(
            'Modules\Knowledgebase\Events\ArticleUpdated',
            'Modules\Knowledgebase\Listeners\ArticleEventSubscriber@onArticleUpdated'
        );
        $events->listen(
            'Modules\Knowledgebase\Events\ArticleDeleted',
            'Modules\Knowledgebase\Listeners\ArticleEventSubscriber@onArticleDeleted'
        );
    }

    private function isArticleViewed($article)
    {
        $viewed = $this->session->get('viewed_articles', []);
        return array_key_exists($article->id, $viewed);
    }
    private function storeViewedArticle($article)
    {
        $key = 'viewed_articles.' . $article->id;
        $this->session->put($key, time());
    }
    private function getViewedArticles()
    {
        return $this->session->get('viewed_articles', null);
    }
    private function cleanExpiredViews($articles)
    {
        $time         = time();
        $throttleTime = 3600;
        return array_filter(
            $articles,
            function ($timestamp) use ($time, $throttleTime) {
                return ($timestamp + $throttleTime) > $time;
            }
        );
    }
}
