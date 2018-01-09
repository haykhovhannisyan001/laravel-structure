<?php

namespace App\Models\Tools;

use App\Models\BaseModel;

class ShippingItem extends BaseModel
{
    protected $table = 'shipping_item';
    protected $with = [
        'shippingAddress',
        'userData'
    ];
    public function scopeOrderType($query,$orderType)
    {
        return $query->where('order_type',$orderType);
    }

    public function shippingAddress()
    {
        return $this->hasMany('App\Models\Tools\ShippingAddress','shippment_id','id');
    }

    public function userData()
    {
        return $this->hasOne('App\Models\UserData','user_id','created_by');
    }
}
