<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class CreateChannelsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_user_can_view_channels()
    {
        $this->signIn();
        $channel = create('App\Channel');

         $this->get('/channels')->assertSee($channel->name);
    }

    /** @test */
    public function a_user_can_create_a_channel()
    {
        $this->signIn();
        $channel = make('App\Channel');

        $response = $this->post('/channels', $channel->toArray());

        $this->get('/channels')->assertSee($channel->name);
    }
}
