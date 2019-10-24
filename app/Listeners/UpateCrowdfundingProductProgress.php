<?php

namespace App\Listeners;

use App\Events\OrderPaid;
use App\Models\Order;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpateCrowdfundingProductProgress
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderPaid  $event
     * @return void
     */
    public function handle(OrderPaid $event)
    {

        $order = $event->getOrder();
        //如果订单类型不是众筹订单无需处理

        if($order->type!==Order::TYPE_CROWDFUNDING){


             return ;
        }

        //获取该订单下的众筹商品模型
        $crowdfunding = $order->items[0]->product->crowdfunding;




    }
}
