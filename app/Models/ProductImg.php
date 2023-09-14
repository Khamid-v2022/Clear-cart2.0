<?php

namespace App\Models;

    use App\Models\Product;
    use Illuminate\Database\Eloquent\Model;

    class ProductImg extends Model
    {
        protected $table = 'products_imgs';

        protected $fillable = [
            'product_id', 'img_path', 'is_main',
        ];
    }
