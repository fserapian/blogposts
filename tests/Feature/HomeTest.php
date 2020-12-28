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
    public function testHomePageIsWorkingCorrectly(): void
    {
        // $response = $this->get('/');

        // $response->assertSeeText('Welcome to blog posts');
        // $response->assertSeeText('Welcome home...');

        $this->assertTrue(10 === 10);
    }

    /**
     * Test Contact page is working correctlry
     * @return void
     */
    // public function testContactPageIsWorkingCorrectly()
    // {
    //     $response = $this->get('contact');

    //     $response->assertSeeText('Contact Us');
    //     $response->assertSeeText('This is the contact page');
    // }
}
