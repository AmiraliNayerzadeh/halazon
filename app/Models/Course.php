<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'type',
        'image',
        'description',
        'teacher_id',
        'age_from',
        'age_to',
        'class_duration',
        'weeks',
        'minutes',
        'capacity',
        'price',
        'discount_price',
        'homework',
        'status',
        'is_draft',
        'slug',
        'meta_title',
        'meta_keywords',
        'meta_description',
        ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_course');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    public function parts()
    {
        return $this->hasMany(PartTime::class);
    }

    public function schedules()
    {
        return $this->hasMany(CourseSchedule::class);

    }

    public function headlines()
    {
        return $this->hasMany(Headline::class);
    }

    public function favorits()
    {
        return $this->morphMany(Favorite::class ,'favoriteable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class ,'commentable');
    }

    public function degrees()
    {
        return $this->belongsToMany(Degree::class);
    }



}
