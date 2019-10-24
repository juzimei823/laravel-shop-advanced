<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidRequestException;
use App\Models\Category;
use App\Models\CrowdfundingProduct;
use App\Models\Product;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    //


    public function index(Request $request){




        //检索符合条件的第一个模型
        $category = Category::where('name', '内存')->first();

        dd($category->toArray());


          //关联模型的插入和更新  以用户和用户地址为例  他们的关系是1对多的关系

//            $user = $request->user();

//          $user = Auth::user();


//          dd($user->attributes);

             //临时的隐藏模型的属性

//           echo (string) $user->makeHidden('email');

             //临时的显示模型的属性

//             echo (string) $user->makeVisible('password');

//           dd($user->toJson());


//           echo app()->environment();

//          throw new  InvalidRequestException('商品没有库存');

            //创建一个user地址模型
//           $addressData = [
//               'province'=>'河北省',
//               'city'=>'廊坊市',
//               'district'=>'香河县',
//               'address'=>'尚品之家建材城',
//               'zip'=>'038300',
//               'contact_name'=>'袁喜兵',
//               'contact_phone'=>'13834981868'
//           ];
////           $userAddress = new UserAddress($addressData);
//
//            $userAddress = UserAddress::find(5);
//
//            $userAddress->user()->associate($user);
//
//
//            $userAddress->save();

//            dd($user->addresses()->save($userAddress));


//          $fund = new CrowdfundingProduct();
//
//          dd($fund);

         //先获取所有上架的产品
//        $builder = Product::query()->where('on_sale',true);
//
//
//        if($request->input('category_id') && $category = Category::find($request->input('category_id'))){
//            //如果是父类目的话 查询出父类目所有的子类目的商品
//            if($category->is_directory){
//
//                // 则筛选出该父类目下所有子类目的商品
//
//                //with 方法相当于  left join   左边的商品会全部显示 右边条件没有的话  都为null
//
//                //has 方法相当于 inner  join   当右侧有数据时才会显示。
//
//                //显示模型关联
//
//                //whereHas  用法是  has的基础 增加where条件
//
//                $builder->whereHas('category',function($query) use ($category){
//
//
//                          $query->where('name','硬盘');
//
//                });
////                $builder->whereHas('category', function ($query) use ($category) {
////                    // 这里的逻辑参考本章第一节
////                    $query->where('path', 'like', $category->path.$category->id.'-%');
////                });
//
//
//
//            }else{
//
//                //查询子类目的商品
//
//
//                $builder->where('category_id',$category->id);
//
//
//            }
//
//
//        }
//
//
//
//        $result = $builder->get();
//
//         dd($result->toArray());

//          $category =  Category::find($request->input('category_id'));
//
//          dd($category->children); //查询所有的子集

//          dd($category->PathIds) ;

    }
}
