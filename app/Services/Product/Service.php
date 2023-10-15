<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Models\ProductImage;
use App\Services\Image;

class Service
{
    private $serviceImage;

    public function __construct(Image\Service $serviceGet)
    {
        $this->serviceImage = $serviceGet;
    }

    public function imageUpload($image)
    {
        $url = $this->serviceImage->store($image);
        $img = ProductImage::create(['url' => $url]);
        return (['id' => $img->id, 'url' => $img->url]);
    }
    public function imageDestroy(ProductImage $image)
    {

        $this->serviceImage->destroy($image->url);
        $image->delete();
    }

    public function store($data)
    {
        $product = Product::create($data);
        ProductImage::whereIn('id', $data['images'])->update(['product_id' => $product->id]);
        $product->save();
    }

    public function update(Product $product, $data)
    {
        $product->update($data);
        ProductImage::whereIn('id', $data['images'])->update(['product_id' => $product->id]);
        $product->save();
    }

    public function destroy(Product $product)
    {
        $product->images()->delete();
        $product->delete();
    }
}
