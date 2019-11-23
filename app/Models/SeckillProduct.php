<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class SeckillProduct extends Model
{
    //

    protected $fillable = ['start_at','end_at'];

    //应该转换成日期格式的属性
    //凡是在$dates数组里的属性字段会被  转成程conbar对象 从而可以操作字段时间处理属性
    protected $dates = ['start_at','end_at'];


//    public $timestamps = false;

   //自动管理模型的时间  false 关闭对updated_at  和 created_at字段的管理
    public $timestamps = false;



    //反向关联商品模型

    public function product(){

        return $this->belongsTo(Product::class);
    }

    // 定义一个名为 is_before_start 的访问器，当前时间早于秒杀开始时间时返回 true
    public function getIsBeforeStartAttribute()
    {
        return Carbon::now()->lt($this->start_at);
    }

    // 定义一个名为 is_after_end 的访问器，当前时间晚于秒杀结束时间时返回 true
    public function getIsAfterEndAttribute()
    {
        return Carbon::now()->gt($this->end_at);
    }
}
