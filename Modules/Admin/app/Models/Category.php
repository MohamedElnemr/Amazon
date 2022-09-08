<?php

namespace Module\Admin\Models;

use Ramsey\Uuid\Uuid;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,SoftDeletes;


    protected $table = 'categories';
    // protected $fillable = ['name','status','parent_id'];
    protected $guarded = ['id'];
    protected $casts = ["status"=>"boolean"];
    protected $primaryKey = 'id';

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::creating(function (Model $model) {
    //         $model->setAttribute($model->getKeyName(), Uuid::uuid4());
    //     });
    // }

    // public function setNameAttribute($value){
    //     return $this->attributes["name"] = "sta".$value;

    // }


    public function childrens()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
