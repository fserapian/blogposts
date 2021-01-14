<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomePageHasCorrectText()
    {
        $response = $this->get('/');

        $response->assertSeeText('Welcome to blog posts');
        $response->assertSeeText('Welcome home...');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testContactPageHasCorrectText()
    {
        $response = $this->get('/contact');

        $response->assertSeeText('Contact Us');
        $response->assertSeeText('This is the contact page');
    }
}
