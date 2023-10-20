@extends('admin.index')
@section('content')
    <form action="{{ route('product.update',$product->id) }}" class="d-flex flex-column justify-content-center" style="width: 700px; height: 80vh" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <h1>Редагування продукту</h1>
        @include('component.inputAdmin', ['name' => 'name', 'type'=>"text", 'value'=>$product->name, 'labelInfo' => 'Назва'])
        <div class="mb-3 mt-3 form-group">
            <textarea name="description" type="text" class="form-control" id="description"
                      placeholder="Опис">{{$product->description}}</textarea>
        </div>
        @include('component.inputAdmin', ['name' => 'price', 'type'=>"number", 'value'=>$product->price, 'labelInfo' => 'Ціна'])
        <p class="mb-0 mt-2">Категорія:</p>
        <select name="category_id" class="form-select" aria-label="Default select example">
            <option value="{{$product->category_id}}" selected>{{$product->category->name}}</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        @include('component.imageInput', ['countImage' => 6, 'postUrl'=>"/admin/product/image"])

        <button type="submit" class="btn btn-warning">Редагувати</button>
    </form>
@endsection
