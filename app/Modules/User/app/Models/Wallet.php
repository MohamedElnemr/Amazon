<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class Wallet extends Model
{
    use HasFactory;
    protected $table = 'wallets';
    protected $fillable = ['value','user_id'];
    protected $hidden = ['timestamps'];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
