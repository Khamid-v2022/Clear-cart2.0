<?php

namespace App\Models;
    use DB;
    use Illuminate\Database\Eloquent\Model;
    use App\Models\UserOrder;

    class UserOrderHeader extends Model
    {
        protected $table = 'users_orders_header';

        protected $fillable = [
            'user_id', 'delivery_method', 'delivery_price', 'drop_info', 'total_price'
        ];

        public function getOrderDetail()
        {
            return UserOrder::where('order_header_id', $this->id)->get();
        }
    }
