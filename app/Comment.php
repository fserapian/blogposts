<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    // Laravel will look for blog_post_id
    public function blogPost()
    {
        return $this->belongsTo('App\BlogPost');
    }
}
