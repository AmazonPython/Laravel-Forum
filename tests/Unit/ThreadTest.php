<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
//use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest
{
    use DatabaseMigrations;

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
