<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Carbon\Carbon;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    function it_has_an_owner()
    {
        $reply = create('App\Reply');

        $this->assertInstanceOf('App\User', $reply->owner);
    }

    /** @test */
    function it_knows_if_it_was_just_published()
    {
        $reply = create('App\Reply');

        $this->assertTrue($reply->wasJustPublished());

        $reply->created_at = Carbon::now()->subMonth();

        $this->assertFalse($reply->wasJustPublished());
    }

    /** @test */
    function it_can_detect_all_mentioned_users_in_the_body()
    {
        $reply = create('App\Reply', [
            'body' => '@youki wants to talk to @youzu'
        ]);

        $this->assertEquals(['youki', 'youzu'], $reply->mentionedUsers());
    }

    /** @test */
    function it_wraps_mentioned_usernames_in_the_body_within_anchor_tags()
    {
        $reply = create('App\Reply', [
            'body' => 'Hello @you-ki.'
        ]);

        $this->assertEquals(
            'Hello <a href="/profiles/you-ki">@you-ki</a>.',
            $reply->body
        );
    }
}
