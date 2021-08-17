<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    function guest_may_not_create_threads()
    {
        $this->expectException('Illuminate\Auth\AutheticationException');

        $thread = factory('App\Thread')->make();

        $this->post('threads', $thread->toArray());
    }

    function an_authenticated_user_can_create_new_forum_thread()
    {
        $this->actingAs(factory('App\User')->create());

        $thread = factory('App\Thread')->make();

        $this->post('threads', $thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
