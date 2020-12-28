<?php

use App\User;
use App\Comment;
use App\BlogPost;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = BlogPost::all();
        $users = User::all();

        if ($posts->count() === 0) {
            $this->command->info('There are no blog posts so we cannot add any comments');
            return;
        }

        $commentsCount = (int) $this->command->ask('How many comments would you like to create', 100);


        factory(Comment::class, $commentsCount)->make()->each(function ($comment) use ($posts, $users) {
            $comment->blog_post_id = $posts->random()->id;
            $comment->user_id = $users->random()->id;
            $comment->save();
        });
    }
}
