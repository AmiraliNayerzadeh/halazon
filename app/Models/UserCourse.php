<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    protected $fillable = ['user_id' , 'course_id' , 'part_id'] ;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }


    public function part()
    {
        return $this->belongsTo(PartTime::class);
    }

}
