<?php

namespace Modules\Vendor\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Modules\Vendor\Entities\Offer;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [15 , 20 , 5];
        $types = ['LE' , 'LE' , '%'];

        foreach($values as $value){
            foreach($types as $type){
                Offer::create([
                    'start'=> Carbon::now(),
                    'end'=> Carbon::now()->addDay(),
                    'value'=> $value,
                    'type'=> $type,
                ]);
            }
        }
    }
}
