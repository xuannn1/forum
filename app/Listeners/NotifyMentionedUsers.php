<?php

namespace App\Listeners;

use App\Events\ThreadReceivedNewReply;
use App\User;
use App\Notifications\YouWereMentioned;

class NotifyMentionedUsers
{

    /**
     * Handle the event.
     *
     * @param  ThreadReceivedNewReply  $event
     * @return void
     */
    public function handle(ThreadReceivedNewReply $event)
    {
        // 找到被 @ 的所有用户名
        // 对每一个被提到的用户，创建成一个集合
        // 并且将每一个值都传给回调函数，通过用户名来获取对应的用户实例
        // 如果对应的用户实例不存在，则会被 filter 过滤掉
        // 然后通知每一个用户
        User::whereIn('name', $event->reply->mentionedUsers())
            ->get()
            ->each(function ($user) use ($event){
                $user->notify(new YouWereMentioned($event->reply));
            });
    }
}
