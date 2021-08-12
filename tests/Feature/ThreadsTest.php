<?php

namespace Tests\Feature;

use phpDocumentor\Reflection\Types\Parent_;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        Parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    /**
     threads test
     */
    public function index()
    {
        //$thread = factory('App\Thread')->create();

        $response = $this->get('/threads');
        $response->assertSee($this->thread->title);
    }

    public function show()
    {
        //$thread = factory('App\Thread')->create();

        $response = $this->get('/threads/' . $this->thread->id);
        $response->assertSee($this->thread->title);
    }
}
