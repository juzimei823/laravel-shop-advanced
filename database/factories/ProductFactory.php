<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    // 从数据库中随机取一个类目
    $category = \App\Models\Category::query()->where('is_directory', false)->inRandomOrder()->first();
    $image = $faker->randomElement([
        "https://img13.360buyimg.com/n2/jfs/t1/27711/26/11757/124411/5c91df19E796814ce/bfc545cc61f1dfcb.jpg",
        "https://img12.360buyimg.com/n2/jfs/t16627/321/2366275380/441398/65729ffb/5af00006Nc55cbdc1.jpg",
        "https://img13.360buyimg.com/n2/jfs/t15025/199/2578930356/568338/3565de0/5aab3d42Nc3944801.jpg",
        "https://img14.360buyimg.com/n2/jfs/t17602/133/911056395/354551/dfca9420/5ab0b4f8N9daf9cca.jpg",
        "https://img11.360buyimg.com/n2/jfs/t1/36451/25/3009/108263/5cb737fbEfabaf003/2bf7bfe33e505cc3.jpg",
        "https://img10.360buyimg.com/n2/jfs/t1/30594/15/8135/146882/5c9ce28fE71f6775f/2237b4e8c31eeb84.jpg",
        "https://img10.360buyimg.com/n1/s160x160_jfs/t1/83004/11/11470/136796/5d8dc23eE46b41c4f/6f3cef9a8a0abaa7.jpg",
    ]);

    return [
        'title'        => $faker->word,
        'long_title'   =>$faker->sentence,
        'description'  => $faker->sentence,
        'image'        => $image,
        'on_sale'      => true,
        'rating'       => $faker->numberBetween(0, 5),
        'sold_count'   => 0,
        'review_count' => 0,
        'price'        => 0,
        'category_id'  => $category ? $category->id : null,
    ];
});
