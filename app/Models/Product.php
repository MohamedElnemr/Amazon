<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    //  protected $guarded = ['id'];

    protected $fillable = [
        'id',
        'name',
        'price',
        'description',
        'qty',
        'category_id',
        'stors_id',
    ];



    // protected $primaryKey ='id';
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function (Model $model) {
    //         $model->setAttribute($model->getKeyName(), Uuid::uuid4());
    //     });
    // }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'stors_id', 'id');
    }
}
