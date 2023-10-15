@extends('admin.index')
@section('content')

        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('component.inputAdmin', ['name' => 'name', 'type'=>"text"])
            <div class="mb-3 form-group">
                <label for="description" class="form-label">Опис</label>
                <textarea name="description" type="text" class="form-control" id="description"
                          placeholder="description"></textarea>
                @error('description')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            @include('component.inputAdmin', ['name' => 'price', 'type'=>"number"])

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
