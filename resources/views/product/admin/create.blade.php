@extends('admin.index')
@section('content')

        <form action="{{ route('product.store') }}" class="d-flex flex-column justify-content-center" style="width: 700px; height: 80vh" method="POST" enctype="multipart/form-data">
            @csrf
            <h1>Добавлення продукту</h1>
            @include('component.inputAdmin', ['name' => 'name', 'type'=>"text", 'labelInfo' => 'Назва'])
            <div class="mb-3 mt-3 form-group">
                <textarea name="description" type="text" class="form-control" id="description"
                          placeholder="Опис"></textarea>
                @error('description')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            @include('component.inputAdmin', ['name' => 'price', 'type'=>"number", 'labelInfo' => 'Ціна'])
            <p class="mb-0 mt-2">Категорія:</p>
            <select name="category_id" class="form-select" aria-label="Default select example">
                <option selected>Виберіть категорію продукта</option>
                @foreach($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{old('category_id') == $category->id ? ' selected' : ''}}>{{ $category->name }}</option>
                @endforeach

            </select>
            @include('component.imageInput', ['countImage' => 6, 'postUrl'=>"/admin/product/image"])
            <button type="submit" class="btn btn-primary">Створити</button>
        </form>

@endsection
