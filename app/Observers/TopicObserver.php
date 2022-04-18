<?php

namespace App\Observers;

use App\Models\Topic;

// creating, created, updating, updated, saving,
// saved, deleting, deleted, restoring, restored

class TopicObserver
{
    public function saving(Topic $topic)
    {
        // 白名单过滤 topic -> body
        $topic->body = clean($topic->body, 'user_topic_body');
    }
}
