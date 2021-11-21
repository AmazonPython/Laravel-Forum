<?php

namespace Tests\Feature;

use Tests\TestCase;

class ParticipateInForum extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = factory('App\User')->create();

        $thread = factory('App\Thread')->create();

        $reply = factory('App\Reply')->create();

        $this->post('threads/'.$thread->id.'/replies', $reply->toArray());
    }
}
