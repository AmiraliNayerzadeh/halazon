<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartTime extends Model
{
    protected $fillable = [
        'title' ,
        'course_id' ,
        'status' ,
    ];

    protected static function booted()
    {
        static::deleting(function ($partTime) {
            $partTime->schedules()->delete();
        });
    }


    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function schedules()
    {
        return $this->hasMany(CourseSchedule::class , 'schedule_id');
    }

    public function courseOrders()
    {
        return $this->hasMany(CourseOrder::class);
    }

}
