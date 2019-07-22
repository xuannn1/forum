<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Activity;
use Carbon\Carbon;

class ActivityTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_records_activity_when_a_thread_is_created()
    {
        $this->signIn();
        $thread = create('App\Thread');

        $this->assertDatabaseHas('activities', [
            'type' => 'created_thread',
            'user_id' => auth()->id(),
            'subject_id' => $thread->id,
            'subject_type' => 'App\Thread'
        ]);

        $activity = Activity::first();
        $this->assertEquals($activity->subject->id, $thread->id);
    }

    /** @test */
    public function it_records_activity_when_a_reply_is_created()
    {
        $this->signIn();
        $reply = create('App\Reply');

        $this->assertEquals(2, Activity::count());
    }

    /** @test */
    function it_fetches_a_feed_for_any_user()
    {
        $this->signIn();
        //当我们有2个thread，其中一个是一星期前的
        create('App\Thread', ['user_id' => auth()->id()], 2);
        //因为我们在用RecordsActivity来创建工作流的时候，会默认将创建时间设置为当前时间。这里直接设置为一周前。
        auth()->user()->activity()->first()->update(['created_at' => Carbon::now()->subWeek()]);
        //当我们获取feed的时候
        $feed = Activity::feed(auth()->user());
        //它们将以正确的形式返回，包含两个日期：今天与一周前
        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->format('Y-m-d')
        ));
        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->subWeek()->format('Y-m-d')
        ));
    }
}
