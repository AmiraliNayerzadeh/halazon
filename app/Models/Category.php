<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable =[
        'title',
        'title_en',
        'image',
        'description',
        'parent_id',
        'slug',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];


    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

//    public function products()
//    {
//        return $this->belongsToMany(Category::class, 'medicine_category_product', 'category_id', 'product_id');
//    }


}
