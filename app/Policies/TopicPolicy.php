<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Topic;

class TopicPolicy extends Policy
{
    /**
     * 判断是否更新的是自己的帖子
     * @param User $user
     * @param Topic $topic
     * @return bool
     */
    public function update(User $user, Topic $topic)
    {
//         return $topic->user_id == $user->id;
        return $user->isAuthorOf($topic);
    }

    /**
     * 判断删除的是否是自己的帖子
     * @param User $user
     * @param Topic $topic
     * @return bool
     */
    public function destroy(User $user, Topic $topic)
    {
        return $user->isAuthorOf($topic);
    }
}
