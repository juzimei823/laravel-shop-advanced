<?php

namespace App\Http\Requests;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductSku;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class SeckillOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        //验证地址是否选择
        //判断地址是否当前用户

        return [
            //

            'address_id'=>['required',

              Rule::exists('user_addresses','id')->where('user_id',$this->user()->id)
            ],

            //下单时验证
            //1.判断当前商品是否存在
            //2.判断当前商品是否上架
            //2.判断当前商品的库存
            //4.判断当前活动是否结束
            //5.判断秒杀活动是否开始
            'sku_id'=>[
                'required',
                function($attribute,$value,$fail){

                     if(!$sku = ProductSku::find($value)){

                         $fail('当前商品不存在');
                     }
                     if($sku->product->type!== Product::TYPE_SECKILL){

                         $fail('该商品不支持秒杀');
                     }
                     if(!$sku->product->is_sale){

                         $fail('该商品没有上架');
                     }
                     if($sku->product->seckill->is_before_start){

                         $fail('秒杀还没开始');
                     }
                     if($sku->product->seckill->is_after_end){

                         $fail('秒杀已结束');
                     }
                     if($sku->stock<1){

                         $fail('商品已售罄');
                     }

                    // // 筛选出包含当前 SKU 的订单
                    $order = Order::query()
                        ->where('user_id',$this->user()->id)
                        ->whereHas('items',function($query) use ($value){
                           $query->where('product_sku_id',$value);

                        })
                        ->where(function($query){
                            $query->whereNotNull('paid_at')->orWhere('closed',false);
                        })->first();

                    if($order){

                        if ($order->paid_at) {
                            return $fail('你已经抢购了该商品');
                        }
                        return $fail('你已经下单了该商品，请到订单页面支付');
                    }




                }



            ]
        ];
    }
}
