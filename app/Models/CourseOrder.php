<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseOrder extends Model
{
    protected $fillable = [
       'user_id',
       'order_id',
       'course_id',
       'part_id',
       'total',
       'revenue',
       'is_settled',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
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
