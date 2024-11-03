<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes ;

    protected $fillable =[
        'user_id' ,
        'order_id',
        'amount',
        'card_number',
        'traceNumber',
        'message',
        'fee',
        'code',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class) ;
    }

}
