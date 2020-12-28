<?php

use App\Tag;
use App\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagCount = Tag::all()->count();

        if ($tagCount === 0) {
            $this->command->info('No tags found. Skipping asigning tags to blog posts');
        }

        $minTags = $this->command->ask('Enter minimum tags on blog post', 0);
        $maxTags = min($this->command->ask('Enter maximum tags on blog post', $tagCount), $tagCount);

        BlogPost::all()->each(function ($post) use ($minTags, $maxTags) {
            $randomTagCount = random_int($minTags, $maxTags);
            $tags = Tag::inRandomOrder()->take($randomTagCount)->get()->pluck('id');
            $post->tags()->sync($tags);
        });
    }
}
