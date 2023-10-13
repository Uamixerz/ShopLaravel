<?php

namespace App\Http\Controllers\Category;


use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Models\CategoryImage;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function index(){
        $categories = Category::all();
        return view('category.show');
    }
    public function create(){
        return view('category.admin.create');
    }
    public function edit(Category $category){
        $images = $category->images()->get();
        return view('category.admin.edit', compact('category','images'));
    }
    public function update(UpdateRequest $request, Category $category){
        $data = $request->validated();
        $this->service->update($category, $data);
        return redirect()->route('category.index');
    }
    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->service->store($data);
        return redirect()->route('category.index');
    }
    public function destroy(Category $category){
        $this->service->destroy($category);
        return redirect()->route('category.index');
    }
    public function imageUpload(Request $request){
        $req = $this->service->imageUpload($request->file('file'));
        return response()->json($req);
    }
    public function imageShow(CategoryImage $image){
        return response()->json($image);
    }
    public function imageDestroy(CategoryImage $image){
        $this->service->imageDestroy($image);
    }
}
