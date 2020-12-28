<?php

use App\User;
use App\Comment;
use App\BlogPost;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        if ($this->command->confirm('Do you want to refresh the database?')) {
            $this->command->call('migrate:refresh');
            $this->command->info('Database was refreshed');
        }

        $this->call([
            UsersTableSeeder::class,
            BlogPostsTableSeeder::class,
            CommentsTableSeeder::class,
            TagsTableSeeder::class,
            BlogPostTagTableSeeder::class,
        ]);

        /* Seed data manually */
        // DB::table('users')->insert([
        //     'name' => 'Fadi Serapian',
        //     'email' => 'fadi.serapian@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ]);

        /* Seeding all in run function */
        // $defaultUser = factory(User::class)->states('default-user')->create();

        // $otherUsers = factory(User::class, 20)->create(); // *

        // $allUsers = $otherUsers->concat([$defaultUser]);

        // $posts = factory(BlogPost::class, 50)->make()->each(function ($post) use ($allUsers) { // *
        //     $post->user_id = $allUsers->random()->id;
        //     $post->save();
        // });

        // $comments = factory(Comment::class, 100)->make()->each(function ($comment) use ($posts) { // *
        //     $comment->blog_post_id = $posts->random()->id;
        //     $comment->save();
        // });

        // dd(get_class($defaultUser), get_class($others), $all->count());
    }
}
