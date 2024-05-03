<?php

namespace Modules\Posts\src\Models;

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
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'author');
    }
}
