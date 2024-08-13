<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{

    protected $fillable = ['cart_id', 'course_id', 'part_id', 'quantity'];

//
//    public function cart()
//    {
//        return $this->belongsTo(Cart::class);
//    }

//    public function course()
//    {
//        return $this->belongsTo(Course::class);
//    }

//    public function part()
//    {
//        return $this->belongsTo(PartTime::class);
//    }

}
