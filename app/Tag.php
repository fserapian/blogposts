<?php

namespace App;

use App\BlogPost;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function blogPosts()
    {
        return $this->belongsToMany(BlogPost::class)->withTimestamps();
    }
}
