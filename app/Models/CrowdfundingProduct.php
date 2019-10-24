<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrowdfundingProduct extends Model
{
    //

//    protected $table = 'crowdfunding_product';
//
//
//    protected $primaryKey = 'id';
  //定义众筹的状态

    const STATUS_SUCCESS='success';

    const STATUS_FAIL = 'fail';

    const STATUS_FUNDING = 'funding';


    public static $statusMap = [

        self::STATUS_SUCCESS => '众筹成功',
        self::STATUS_FAIL => '众筹失败',
        self::STATUS_FUNDING => '众筹中',


    ];


   protected $fillable = [
       //目标金额     //众筹的目标金额     //参与的用户数量 //众筹的状态   //结束时间
       'total_amount', 'target_amount', 'user_count','status', 'end_at'
   ];

    //不需要created_at   updated_at  字段

    public $timestamps = false;   //关闭自动更新时间



    // end_at 会自动转为 Carbon 类型
    protected $dates = ['end_at'];


    //对应的关联模型

    public function product(){

                      //外键就是当前关联名称_加上id
        return $this->belongsTo(Product::class);
    }

    //定义一个访问器 获取当前众筹的进度

    public function getPercentAttribute($key)
    {


        $value = $this->attributes['total_amount']/$this->attributes['target_amount'];
        //解决疑问
        //number_format 函数的使用
        return floatval(number_format($value*100,2,'.',''));

    }
}
