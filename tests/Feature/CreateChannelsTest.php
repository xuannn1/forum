<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class CreateChannelsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function non_administrator_can_not_view_channels()
    {
        $this->withExceptionHandling();
        $this->signIn();

        $channel = create('App\Channel');

        $this->get('/channels')->assertStatus(403);
        // $this->get('/channels')->assertSee($channel->name);
    }

    /** @test */
    function administrator_can_view_channels()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $channel = create('App\Channel');

        $this->get('/channels')->assertSee($channel->name);
    }

    /** @test */
    function non_administrators_can_not_create_a_channel()
    {
        $this->withExceptionHandling();
        $this->signIn();

        $channel = make('App\Channel');

        $this->post('/channels', $channel->toArray())
            ->assertStatus(403);
    }

    /** @test */
    public function administrator_can_create_a_channel()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $channel = make('App\Channel');

        $response = $this->post('/channels', $channel->toArray());

        $this->get('/channels')->assertSee($channel->name);
    }

    /** @test */
    function non_administrator_can_not_delete_a_channel()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $channel = create('App\Channel');

        $this->json('DELETE', '/channels/' . $channel->slug)->assertStatus(403);
    }

    /** @test */
    function administrator_can_delete_a_channel()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $channel = create('App\Channel');

        $this->json('DELETE', '/channels/' . $channel->slug);

        $this->assertDatabaseMissing('channels', ['slug' => $channel->slug]);
    }

    /** @test */
    function non_administrator_can_not_update_a_channel()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $channel = create('App\Channel');

        $this->patch('/channels/' . $channel->slug, [
            'name' => 'foobar',
            'slug' => 'foobar'
        ])->assertStatus(403);
    }

    /** @test */
    function administrator_can_update_a_channel()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $channel = create('App\Channel');

        $this->patch('/channels/' . $channel->slug, [
            'name' => 'foobar',
            'slug' => 'foobar'
        ]);

        $this->assertEquals('foobar', $channel->fresh()->name);
        $this->assertEquals('foobar', $channel->fresh()->slug);
    }


}
