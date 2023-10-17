<?php

namespace App\Services\Order;


use App\Models\Order;
use App\Models\Product;

class Service
{

    public function store($data){
        if (isset(auth()->user()->id))
            $data['user_id'] = auth()->user()->id;
        $order = Order::create($data);
        $products = $this->getBasket();
        foreach ($products as $product) {
            $order->products()->create([
                'product_id' => $product['id'],
                'count' => $product['count']
            ]);
        }
        setcookie('cart', json_encode([]), time() + (86400 * 30), "/");
    }


    public function indexBasket()
    {
        $ids = $this->getBasket();
        $idsFor = $ids->pluck('id');
        $products = Product::whereIn('id', $idsFor)->get();

        foreach ($products as $product) {
            $product->url = $product->images()->first()->url;
            foreach ($ids as $item) {
                if ($product->id === $item['id']) {
                    $product->count = $item['count'];
                    break;
                }
            }
        }
        return $products;
    }

    public function getBasket()
    {
        if (isset($_COOKIE['cart'])) {
            $cart_data = json_decode($_COOKIE['cart'], true);
            return collect($cart_data);// Декодування JSON даних у масив
        }
        return collect([]);
    }
}
