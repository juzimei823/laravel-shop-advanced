<?php

//composer 自动加载函数
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

function ngrok_url($route_name,$params = []){

     //app()->environment() 获取项目的开发环境还是生产环境
    if(app()->environment('local') && $url = config('app.ngrok_url')){

        // route() 函数第三个参数代表是否绝对路径
               return $url.route($route_name,$params,false);

    }

       return route($route_name,$params);
}




