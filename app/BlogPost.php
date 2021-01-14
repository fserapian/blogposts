<?php

namespace App;

use App\Tag;
use App\User;
use App\Scopes\LatestScope;
use App\Scopes\DeletedAdminScope;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'content', 'user_id'];

    public function comments()
    {
        // return $this->hasMany(Comment::class)->latest();
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(BlogPost::CREATED_AT, 'desc');
    }

    public function scopeMostCommented(Builder $query)
    {
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    }

    public static function boot()
    {
        static::addGlobalScope(new DeletedAdminScope());
        parent::boot();

        // static::addGlobalScope(new LatestScope());

        static::deleting(function (BlogPost $blogPost) {
            $blogPost->comments()->delete();
            Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
        });

        // Clear the cache when updating
        static::updating(function (BlogPost $blogPost) {
            Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
        });

        static::restoring(function (BlogPost $blogPost) {
            $blogPost->comments()->restore();
        });
    }
}
