<?php

namespace App;

use App\Model;
use App\Order;
class Client extends Model
{
    protected $casts = [
        'phone' => 'array'
    ];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
