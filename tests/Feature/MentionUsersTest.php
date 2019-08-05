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

    /** @test */
    function it_can_fetch_all_mentioned_users_starting_with_the_given_characters()
    {
        create('App\User', ['name' => 'youki']);
        create('App\User', ['name' => 'yanki']);
        create('App\User', ['name' => 'youzu']);

        $results = $this->json('GET', '/api/users', ['name' => 'you']);

        $this->assertCount(2, $results->json());
    }

}
