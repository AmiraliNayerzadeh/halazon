<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $fillable= ['title' , 'user_id' , 'responder' , 'supportable_id' , 'supportable_type' , 'message' , 'parent_id' , 'status'];

    public function getStatusTranslatedAttribute()
    {
        $translations = [
            'open' => 'باز',
            'in-progress' => 'در حال انجام',
            'closed' => 'بسته شده',
            'answered' => 'پاسخ داده شده',
        ];

        return $translations[$this->status] ?? $this->status;
    }




    public function user()
    {
        return $this->belongsTo(User::class) ;
    }

    public function responder()
    {
        return $this->belongsTo(User::class) ;
    }

    public function supportable()
    {
        return $this->morphTo();
    }


    public function parent()
    {
        return $this->belongsTo(Support::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Support::class, 'parent_id');
    }


}
