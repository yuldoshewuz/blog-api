<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'title', 'slug', 'body', 'image', 'status'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if ($value && Storage::disk('public')->exists($value)) {
                    return asset('storage/' . $value);
                }

                return asset('storage/no-image.png');
            }
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

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

    protected $appends = ['is_liked'];

    public function getIsLikedAttribute()
    {
        if (!auth('sanctum')->check()) return false;
        return $this->likes()->where('user_id', auth('sanctum')->id())->exists();
    }
}
