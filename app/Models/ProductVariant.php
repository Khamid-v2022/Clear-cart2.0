<?php

namespace App\Models;

    use App\Models\ProductCategory;
    use App\Models\Setting;
    use Illuminate\Database\Eloquent\Model;

    class ProductVariant extends Model
    {
        protected $table = 'product_variants';

        protected $fillable = [
            'product_id', 'title', 'price'
        ];

        
    }
