<?php

namespace App\Http\Controllers\Product;


use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function index(){
        $products = Product::all();
        return view('product.show', compact('products'));
    }
    public function create(){
        $categories = Category::all();
        return view('product.admin.create', compact('categories'));
    }
    public function edit(Product $product){
        $images = $product->images()->get();
        return view('product.admin.edit', compact('product','images'));
    }

    public function update(UpdateRequest $request, Product $product){
        $data = $request->validated();
        $this->service->update($product, $data);
        return redirect()->route('product.index');
    }
    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->service->store($data);
        return redirect()->route('product.index');
    }
    public function destroy(Product $product){
        $this->service->destroy($product);
        return redirect()->route('product.index');
    }
    public function imageUpload(Request $request){
        $req = $this->service->imageUpload($request->file('file'));
        return response()->json($req);
    }
    public function imageShow(ProductImage $image){
        return response()->json($image);
    }
    public function imageDestroy(ProductImage $image){
        $this->service->imageDestroy($image);
    }
}
