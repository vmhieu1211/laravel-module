<?php

namespace Modules\User\src\Models;

use Laravel\Sanctum\HasApiTokens;
use Modules\Like\src\Models\Like;
use Modules\Posts\src\Models\Post;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;
    public $guard = "admin";
    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'author');
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
