<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected $table = 'orders';

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')->select('order_id', 'product_id', 'quantity', 'total', 'products.name', 'products.price');
    }
}
