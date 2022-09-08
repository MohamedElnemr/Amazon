<?php

namespace Modules\Payment\Models;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'duration',
        'price',
        'stripe_plan_id',
    ];

    public function store()
    {
        return $this->belongsToMany(Store::class , 'store_plan' , 'store_id' , 'plan_id');
    }
}
