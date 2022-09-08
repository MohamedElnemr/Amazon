<?php

namespace Modules\Vendor\Entities;

use App\Models\Category;
use Modules\Vendor\Entities\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'id', 'name', 'price', 'description', 'qty', 'category_id', 'store_id', 'brand_id'
    ];

    public $search = [
        'name', 'price'
    ];

    public $searchRealtion = [
        'category', 'brand'
    ];

    /**
     * Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Get the brand that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'category_id', 'id');
    }
    /**
     * Get the store that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'stors_id', 'id');
    }
}
