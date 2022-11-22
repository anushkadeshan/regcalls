<?php

namespace App\Models;

use App\Models\Apps\Ecommerce\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = 'template';
    public $fillable = [
        'user_id','product_id','quantity'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }
}
