<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Headline extends Model
{
    protected $fillable = [
        'title' ,
        'description' ,
        'priority' ,
        'video' ,
        'link' ,
        'attachment' ,
        'course_id' ,
        'slug' ,
        'is_free' ,
        'is_move_video',
        'arvan_video_id',
        'arvan_video_url',
        'arvan_video_player',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class ,'commentable');
    }



}
