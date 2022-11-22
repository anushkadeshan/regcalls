<?php

namespace App\Models\Apps\Ecommerce;

use App\Models\Attribute;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = 'template';

    public $fillable = [
        'title',
        'code',
        'short_title',
        'is_free',
        'type',
        'is_active',
        'pre_login',
        'price',
        'real_price',
        'quantity',
        'main_image',
        'images',
        'tech_specs',
        'details',
        'downloads',
        'status',
        'stock_id',
        'expiry_date',
        'added_by',
        'approved_by',
    ];

    protected $casts = [
        'is_free' => 'boolean',
        'is_active' => 'boolean',
        'pre_login' => 'boolean',
        'downloads' => 'json',
        'images' => 'json'
    ];

    public function getRouteKeyName(){
        return 'id';
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_values', 'product_id', 'attribute_id')->withPivot('value')->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id')->withTimestamps();
    }

}
