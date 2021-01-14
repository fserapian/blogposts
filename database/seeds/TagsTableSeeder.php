<?php

use App\Tag;
use Illuminate\Database\Seeder;

// @codingStandardsIgnoreLine
class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = collect(['Science', 'Politics', 'Sports', 'Economics', 'Entertainment']);

        $tags->each(function ($tagName) {
            $tag = new Tag();
            $tag->name = $tagName;
            $tag->save();
        });
    }
}
