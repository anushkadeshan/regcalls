<?php

namespace App\Models\Apps\Ecommerce;

use App\Models\Apps\Ecommerce\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = 'template';

    public $fillable = [
        'title',
        'type',
        'availability',
        'is_active',
        'added_by',
        'status',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function items()
    {
        return $this->belongsToMany(Product::class, 'stock_items', 'stock_id', 'product_id')->withPivot('price','real_price','quantity');
    }
}
