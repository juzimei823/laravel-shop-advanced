<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        'province',
        'city',
        'district',
        'address',
        'zip',
        'contact_name',
        'contact_phone',
        'last_used_at',
    ];
    //解决的疑问
    // The attributes that should be mutated to dates.
    //
    protected $dates = ['last_used_at'];
    //解决的疑问
    //将访问器的属性追加的模型对象数组中
    protected $appends = ['full_address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //定义的访问器
    public function getFullAddressAttribute()
    {
        return "{$this->province}{$this->city}{$this->district}{$this->address}";
    }
}
