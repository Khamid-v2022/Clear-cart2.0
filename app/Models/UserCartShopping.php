<?php

namespace App\Models;

    use App\Models\User;
    use Illuminate\Database\Eloquent\Model;

    class UserCartShopping extends Model
    {
        protected $table = 'users_carts_shoppings';

        protected $fillable = [
            'user_id', 'delivery_method', 'delivery_price', 'drop_name', 'drop_street', 'drop_postal_code', 'drop_city', 'drop_country', 'total_price', 'is_done',
        ];

        public function getUser()
        {
            $user = User::where('id', $this->user_id)->get()->first();

            if ($user != null) {
                return $user;
            }

            return (object) [
                'name' => 'n/A',
            ];
        }

        public function isDone()
        {
            return $this->is_done == 1;
        }

        public function done()
        {
            $this->update([
                'is_done' => 1,
            ]);
        }

        public function getOrders()
        {
            $orders = [];

            foreach (UserCartEntry::where('shopping_id', $this->id)->get() as $cartEntry) {
                $order = UserOrder::where('id', $cartEntry->order_id)->get()->first();

                if ($order != null) {
                    $orders[] = $order;
                }
            }

            return $orders;
        }

        public function getFirstOrder(){
            $order = null;
            $cartEntry = UserCartEntry::where('shopping_id', $this->id)->first();
            if($cartEntry)
                $order = UserOrder::where('id', $cartEntry->order_id)->first();
            return $order;
        }


        // public function getOrderDetail()
        // {
        //     return UserOrder::where('order_header_id', $this->id)->get();
        // }

        public function getFormattedPriceWithShipping(){
            $after = '';

            return number_format(($this->total_price + $this->delivery_price) / 100, 2, ',', '.').' '.Setting::getShopCurrency().$after;
        }

        public function getFormattedPrice($price){
            $after = '';

            return number_format($price / 100, 2, ',', '.').' '.Setting::getShopCurrency().$after;
        }
    }
