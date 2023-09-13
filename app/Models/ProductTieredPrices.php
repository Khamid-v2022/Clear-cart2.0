<?php

namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class ProductTieredPrices extends Model
    {
        protected $table = 'product_tiered_prices';

        protected $fillable = [
            'product_id', 'amount', 'price'
        ];
    }
