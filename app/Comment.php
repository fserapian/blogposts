<?php

namespace App;

use App\BlogPost;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    // Laravel will look for blog_post_id
    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(Comment::CREATED_AT, 'desc');
    }

    public static function boot()
    {
        parent::boot();

        // static::addGlobalScope(new LatestScope());
    }
}
