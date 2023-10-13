@extends('layouts/app')
@section('content')
    <form action="{{ route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        @include('component.inputAdmin', ['name' => 'name', 'type'=>"text", 'value'=>$product->name])
        <div class="mb-3 form-group">
            <label for="description" class="form-label">Опис</label>
            <textarea name="description" type="text" class="form-control" id="description"
                      placeholder="description">{{$product->description}}</textarea>
        </div>
        @include('component.inputAdmin', ['name' => 'price', 'type'=>"number", 'value'=>$product->price])

        <select name="category_id" class="form-select" aria-label="Default select example">
            <option value="{{$product->category_id}}" selected>{{$product->category->name}}</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        @include('component.imageInput', ['countImage' => 6, 'postUrl'=>"/product/image"])

        <button type="submit" class="btn btn-warning">Редагувати</button>
    </form>
@endsection
