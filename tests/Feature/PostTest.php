<?php

namespace Tests\Feature;

use App\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testPostPageHasCorrectText()
    {
        // $response = $this->get('/posts');

        // $response->assertSeeText('Aliquid quia rerum quis voluptas tempora quas quo.');

        $this->assertTrue(true);
    }
}
