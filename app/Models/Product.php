<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Product extends Model
{

    const TYPE_NORMAL = 'normal';

    const TYPE_CROWDFUNDING = 'crowdfunding';

    const TYPE_SECKILL = 'seckill';


    public static $typeMap = [
        self::TYPE_NORMAL => '普通商品',

        self::TYPE_CROWDFUNDING => '众筹商品',

        self::TYPE_SECKILL =>  '秒杀商品'
    ];


    protected $fillable = [
        'title','long_title', 'description', 'image', 'on_sale',
        'rating', 'sold_count', 'review_count', 'price','type'
    ];

    //属性类型转换

    //cast 翻译 铸件模子   on_sale在数据库是整形类型  如果 通过  属性类型转换 模型调用属性的时候  将始终转换成boolean型
    protected $casts = [
        'on_sale' => 'boolean', // on_sale 是一个布尔类型的字段
    ];

   //关联众筹商品模型

    public function crowdfunding(){

         return $this->hasOne(CrowdfundingProduct::class);


    }
   //与商品属性关联
    public function properties(){

        return $this->hasMany(ProductProperty::class);
    }



    // 与商品SKU关联
    public function skus()
    {
        return $this->hasMany(ProductSku::class);
    }

    //与栏目cagegory 栏目关联

    public function category(){


        return $this->belongsTo(Category::class);
    }

    //与秒杀商品关联


    public function seckill(){


        return $this->hasOne(SeckillProduct::class);
    }

    public function getImageUrlAttribute()
    {
        // 如果 image 字段本身就已经是完整的 url 就直接返回
        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }
        return \Storage::disk('public')->url($this->attributes['image']);
    }
    //商品属性访问器

    public function getGroupedPropertiesAttribute(){


        return $this->properties->groupBy('name')->map(function($property){

                return $property->pluck('value')->all();
        });

    }



    public function toESArray(){

          $arr = Arr::only($this->toArray(),[

              'id',
              'type',
              'title',
              'category_id',
              'long_title',
              'on_sale',
              'rating',
              'sold_count',
              'review_count',
              'price',



          ]);

        // 如果商品有类目，则 category 字段为类目名数组，否则为空字符串
        $arr['category'] = $this->category ? explode(' - ', $this->category->full_name) : '';
        // 类目的 path 字段
        $arr['category_path'] = $this->category ? $this->category->path : '';
        // strip_tags 函数可以将 html 标签去除
        $arr['description'] = strip_tags($this->description);
        // 只取出需要的 SKU 字段
        $arr['skus'] = $this->skus->map(function (ProductSku $sku) {
            return Arr::only($sku->toArray(), ['title', 'description', 'price']);
        });
        // 只取出需要的商品属性字段
        $arr['properties'] = $this->properties->map(function (ProductProperty $property) {
            return Arr::only($property->toArray(), ['name', 'value']);
        });

        return $arr;


    }
}
