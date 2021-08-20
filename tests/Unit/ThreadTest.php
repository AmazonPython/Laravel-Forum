<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
//use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest
{
    use DatabaseMigrations;

    public function setUP()
    {
        parent::setUp();

        $this->thread = create('App\Thread');
    }

    function a_thread_can_make_a_string_path()
    {
        $thread = make('App\Thread');

        $this->assertEquals('/threads/', $thread->channel->slug . '/' . $thread->id, $thread->path());
    }

    function threadReplies()
    {
        $thread = factory('App\Thread')->create();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $thread->replies);
    }

    function a_thread_has_a_creator()
    {
        $this->assertInstanceOf('App\User', $thread->creator);
    }
}
