<?php

namespace App\Models;
    use DB;
    use Illuminate\Database\Eloquent\Model;

    class UserOrderHeader extends Model
    {
        protected $table = 'users_orders_header';

        protected $fillable = [
            'user_id', 'delivery_method', 'delivery_price', 'drop_info', 'total_price'
        ];
    }
