<?php

namespace App\Services\Category;


use App\Models\Category;
use App\Models\CategoryImage;
use App\Services\Image;
use Illuminate\Support\Facades\Log;

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
        $img = CategoryImage::create(['url' => $url]);
        return (['id' => $img->id, 'url' => $img->url]);
    }
    public function imageDestroy(CategoryImage $image)
    {
        $this->serviceImage->destroy($image->url);
        $image->delete();
    }

    public function store($data)
    {
        $category = Category::create($data);
        CategoryImage::whereIn('id', $data['images'])->update(['category_id' => $category->id]);
        $category->save();
    }

    public function update(Category $category, $data)
    {
        $category->update($data);
        CategoryImage::whereIn('id', $data['images'])->update(['category_id' => $category->id]);
        $category->save();
    }

    public function destroy(Category $category)
    {
        $category->images()->delete();
        $category->delete();
    }
}
