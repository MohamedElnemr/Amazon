<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adresses = ['العجمي' , 'الهانوفيل ', 'Canada' , 'USA ', 'England'];

        foreach($adresses as $address)
        {
            Address::create([
                'address'=>$address,
                'user_id'=>1
            ]);
        }
    }
}
