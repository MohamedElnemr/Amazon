<?php

namespace Modules\Vendor\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Vendor\Entities\Store;
use Illuminate\Support\Facades\Hash;



class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $store = new Store();
        $store->name = "Store";
        $store->email = "store@gmail.com";
        $store->password = Hash::make(123456);
        $store->save();

        $store = new Store();
        $store->name = "Store1";
        $store->email = "store1@gmail.com";
        $store->password = Hash::make(123456);
        $store->save();

        $store = new Store();
        $store->name = "Store2";
        $store->email = "store2@gmail.com";
        $store->password = Hash::make(123456);
        $store->save();
    }
}
