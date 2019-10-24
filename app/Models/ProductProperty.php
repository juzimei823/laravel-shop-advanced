<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductProperty extends Model
{
    //
    protected $fillable = [

        'name','value'
    ];
//    没有 created_at updated_at
    public  $timestamps  = false;

    public $hidden = ['created_at','updated_at'];

    //反向关联  product模型


    public function product(){

        return $this->belongsTo(Product::class);
    }
}
