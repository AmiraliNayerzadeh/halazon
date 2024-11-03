<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes ;

    protected $fillable =[
      'user_id' ,
      'method' ,
      'status' ,
      'qty' ,
      'total_pure_price' ,
      'total_discount_price' ,
      'total' ,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courseOrders()
    {
        return $this->hasMany(CourseOrder::class);
    }


    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}
