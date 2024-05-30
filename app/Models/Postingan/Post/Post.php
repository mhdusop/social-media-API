<?php

namespace App\Models\Postingan\Post;

/**
 * import models
 */

use App\Models\Postingan\Comment\Comment;
use App\Models\Postingan\Like\Like;
use App\Models\User\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'description', 'images'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = is_array($value) ? implode(',', $value) : $value;
    }

    public function getImagesAttribute($value)
    {
        return explode(',', $value);
    }
}
