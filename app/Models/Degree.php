<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $fillable = ['title' , 'description' , 'image' , 'slug' , 'meta_title' , 'meta_keywords' , 'meta_description'] ;

    public function teachers()
    {
        return $this->hasMany(User::class) ;
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
    
    
}
