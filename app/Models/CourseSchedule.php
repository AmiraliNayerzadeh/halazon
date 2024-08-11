<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSchedule extends Model
{
    protected $fillable = [
        'course_id',
        'schedule_id',
        'teacher_id',
        'day_id',
        'start_time',
        'start_date',
    ];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function parts()
    {
        return $this->belongsTo(PartTime::class , 'schedule_id');
    }

    public function day()
    {
        return $this->belongsTo(Day::class);
    }



}
