<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    //当执行 php artisan db:seed  会默认加载 DatabaseSeeder run方法

   // php artisan db:seed  --class="指定的填充类"会默认加载 DatabaseSeeder run方法
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(UserAddressesSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(CouponCodesSeeder::class);
        $this->call(OrdersSeeder::class);
    }
}
