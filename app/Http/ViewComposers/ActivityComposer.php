<?php

namespace App\Http\ViewComposers;

use App\User;
use App\BlogPost;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class ActivityComposer
{
    public function compose(View $view)
    {
        // // Caching the data
        // $mostCommented = Cache::remember('most-commented-blog-post', 60, function () {
        //     return BlogPost::mostCommented()->take(5)->get();
        // });

        // $mostActive = Cache::remember('most-active-users', 60, function () {
        //     User::withMostPosts()->take(5)->get();
        // });

        $mostCommented = BlogPost::mostCommented()->take(2)->get();
        $mostActive = User::withMostPosts()->take(2)->get();

        $view->with('mostCommented', $mostCommented);
        $view->with('mostActive', $mostActive);
    }
}
