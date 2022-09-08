<?php

namespace Modules\Vendor\Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Modules\Vendor\Entities\Product;



class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->id = 1;
        $product->name = "TV";
        $product->price = 100;
        $product->description = Str::random(50);
        $product->qty = 5;
        $product->category_id = 1;
        $product->store_id = 1;
        $product->save();
    }
}
