<?php

namespace App\Observers;

use App\Handlers\SlugTranslateHandler;
use App\Jobs\TranslateSlug;
use App\Models\Topic;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    /**
     * 截取文章摘要并赋值
     * @param Topic $topic
     */
    public function saving(Topic $topic)
    {
        // XSS 过滤
        $topic->body = clean($topic->body, 'user_topic_body');

        // 生成话题摘录
        $topic->excerpt = make_excerpt($topic->body);

        // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
//        $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
        if (!$topic->slug) {
            //推送任务到队列
            dispatch(new TranslateSlug($topic));
        }
    }

    /**
     * 删除话题的时候同时删除旗下的评论
     * @param Topic $topic
     */
    public function deleted(Topic $topic)
    {
        \DB::table('replies')->where('topic_id', $topic->id)->delete();
    }


}
