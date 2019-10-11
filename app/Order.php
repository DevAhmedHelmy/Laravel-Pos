<?php

namespace App;

use App\Model;
use App\Cient;
use App\Product;
class Order extends Model
{
    public function client ()
    {
        return $this->belongsTo(Client::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_order')->withPivot('quantity');
    }
}
