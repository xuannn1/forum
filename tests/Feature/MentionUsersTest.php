<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class MentionUsersTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function mentioned_users_in_a_reply_are_notified()
    {
        $youki = create('App\User', ['name' => 'youki']);
        $this->signIn($youki);

        $youzu = create('App\User', ['name' => 'youzu']);

        $thread = create('App\Thread');

        $reply = make('App\Reply', [
            'body' => '@youzu look at this.@youyou'
        ]);

        $this->json('post', $thread->path().'/replies', $reply->toArray());

        $this->assertCount(1, $youzu->notifications);
    }


}
