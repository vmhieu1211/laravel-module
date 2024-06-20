<?php

namespace Modules\Posts\src\Models;

use Illuminate\Support\Str;
use Modules\Like\src\Models\Like;
use Modules\User\src\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'images',
        'published_at',
        'status',
        'slug'
    ];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            $post->slug = static::generateSlug($post->title);
        });
    }

    protected static function generateSlug($title)
    {
        $slug = Str::slug($title);
        $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
