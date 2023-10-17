<?php

namespace App\Http\Controllers\Order;



use App\Http\Requests\Order\StoreRequest;
use App\Models\Order;

class OrderController extends BaseController
{

    public function index(){
        $orders = Order::all();
        return view('order.admin.show', compact('orders'));
    }
    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->service->store($data);
    }
    public function get_basket(){
        return response()->json($this->service->indexBasket());
    }
}
