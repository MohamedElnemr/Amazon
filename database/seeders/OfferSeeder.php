<?php

namespace Database\Seeders;

use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

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
