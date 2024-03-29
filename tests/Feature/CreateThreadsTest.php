<?php

namespace Tests\Feature;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function guest_may_not_create_threads()
    {
        $this->expectException('Illuminate\Auth\AutheticationException');

        $thread = make('App\Thread');

        $this->post('threads', $thread->toArray());
    }

    public function an_authenticated_user_can_create_new_forum_thread()
    {
        $this->actingAs(create('App\User'));

        $thread = make('App\Thread');

        $this->post('threads', $thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
