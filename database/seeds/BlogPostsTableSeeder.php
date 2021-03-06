<?php

use App\User;
use App\BlogPost;
use Illuminate\Database\Seeder;

// @codingStandardsIgnoreLine
class BlogPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postsCount = (int) $this->command->ask('How many blog posts would you like to create', 50);

        $users = User::all();

        factory(BlogPost::class, $postsCount)->make()->each(function ($post) use ($users) {
            $post->user_id = $users->random()->id;
            $post->save();
        });
    }
}
