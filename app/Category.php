<?php

namespace App;

use App\Model;
use App\Product;
class Category extends Model
{
    use \Dimsav\Translatable\Translatable;
    
    public $translatedAttributes = ['name'];
    // protected $fillable = ['code'];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
