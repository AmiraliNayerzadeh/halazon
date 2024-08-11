<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{


    use SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'image',
        'video',
        'user_id',
        'status',
        'slug',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'blog_category');
    }

    public function favorits()
    {
        return $this->morphMany(Favorite::class ,'favoriteable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class ,'commentable');
    }



}
