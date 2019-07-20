<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function un_authenticated_user_may_not_add_replies()
    {
        $this->withExceptionHandling();

        $this->post('/threads/1/replies', []);

    }

    /** @test */
    function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->be($user = create('App\User'));
        $thread = create('App\Thread');
        $reply = make('App\Reply');

        $this->post('/threads/'.$thread->id.'/replies', $reply->toArray());

        $this->get(route('threads.show', $thread->id))
            ->assertSee($reply->body);
    }
}
