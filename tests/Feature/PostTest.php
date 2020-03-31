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
    public function testThereIsNoBlogPostsIfDatabaseIsEmpty()
    {
        $response = $this->get('posts');

        $response->assertSeeText('No blog posts at the moment');
    }

    public function testThereIsOneBlogPost() {
        // Arrange
        $post = new BlogPost();
        $post->title = 'Sqlite Post';
        $post->content = 'This post should go to sqlite database in memory';
        $post->save();

        // Act
        $response = $this->get('/posts');

        // Assert
        $response->assertSeeText('Sqlite Post');
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Sqlite Post',
            'content' => 'This post should go to sqlite database in memory',
        ]);
    }
}
