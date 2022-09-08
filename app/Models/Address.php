<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Address extends Model
{
    use HasFactory;
    protected $table = 'addresses';
    protected $fileable = ['country'];
    protected $hidden = [
        'created_at','updated_at'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
