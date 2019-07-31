<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Inspections\Spam;

class SpamTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function it_checks_for_invalid_keywords()
    {
        // 检查是否有给定的关键词出现
        $spam = new Spam();

        $this->assertFalse($spam->detect('Innocent reply here'));

        $this->expectException('Exception');

        $spam->detect('yahoo customer support');
    }

    /** @test */
    function it_checks_for_any_key_being_held_down()
    {
        // 检查是否有类似 aaaaaaa 这样的连续按键文本出现
        $spam = new Spam();

        $this->expectException('Exception');

        $spam->detect('Hello world aaaaaaaa');


    }
}
