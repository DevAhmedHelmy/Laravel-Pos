<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = ['product one', 'product two', 'product three'];


        foreach($products as $product)
        {
            \App\Product::create([
                'ar' => ['name' => $product, 'description' => $product . 'desc'],
                'en' => ['name' => $product, 'description' => $product . 'desc'],
                'category_id' => 1,
                'purchase_price' => 100,
                'sale_price' => 150,
                'stock' => 10
                ]);
        }
    }
}
