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
        'course_id' ,
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
