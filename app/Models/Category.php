<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use SoftDeletes;


    // در app/Models/Category.php
    protected static function booted()
    {
        static::saving(function ($category) {
            Cache::forget('header_categories');
        });

        static::deleting(function ($category) {
            Cache::forget('header_categories');
        });
    }


    protected $fillable =[
        'title',
        'title_en',
        'image',
        'description',
        'parent_id',
        'slug',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];


    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class , 'parent_id') ;
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function blogs()
    {
        return $this->belongsToMany(Blog::class);

    }
}
