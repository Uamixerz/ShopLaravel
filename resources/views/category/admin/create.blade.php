@extends('admin.index')
@section('content')
    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('component.inputAdmin', ['name' => 'name', 'type'=>"text"])
        <div class="mb-3 form-group">
            <label for="description" class="form-label">Опис</label>
            <textarea name="description" type="text" class="form-control" id="description" placeholder="description"></textarea>
            @error('description')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        @include('component.imageInput', ['countImage' => 1, 'postUrl'=>"/admin/category/image"])
        <button type="submit" class="btn btn-primary">Створити</button>
    </form>

@endsection
