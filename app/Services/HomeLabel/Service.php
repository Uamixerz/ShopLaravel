<?php

namespace App\Services\HomeLabel;


use App\Models\HomeProductLabels;
use App\Models\Product;

class Service
{
    public function create()
    {
        return $this->getProductWithUrl();
    }

    public function getProductWithUrl(){
        $products = Product::all();
        foreach ($products as $product) {
            $product->url = $product->images()->get()->first()->url;
        }
        return $products;
    }
    public function store($data)
    {
        $label = HomeProductLabels::create($data);
        $products = $data['products'];
        foreach ($products as $product) {
            $label->products()->create(['product_id' => $product]);
        }
    }
    public function edit()
    {
        return $this->getProductWithUrl();
    }
    public function update(HomeProductLabels $label, $data)
    {
        $label->update($data);
        $products = $data['products'];
        $label->products()->delete();
        foreach ($products as $product) {
            $label->products()->create(['product_id' => $product]);
        }
        $label->save();
    }
    public function destroy(HomeProductLabels $label)
    {
        $label->delete();
    }
}
