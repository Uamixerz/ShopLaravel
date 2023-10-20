@extends('admin.index')
@section('content')
    <form action="{{ route('category.store') }}" class="d-flex flex-column justify-content-center" style="width: 700px; height: 80vh" method="POST" enctype="multipart/form-data">
        @csrf
        <h1>Добавлення категорії</h1>
        @include('component.inputAdmin', ['name' => 'name', 'type'=>"text", 'labelInfo' => 'Назва'])
        <div class="mb-0 mt-3 form-group">
            <textarea name="description" type="text" class="form-control" id="description" placeholder="Опис"></textarea>
            @error('description')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        @include('component.imageInput', ['countImage' => 1, 'postUrl'=>"/admin/category/image"])
        <button type="submit" class="btn btn-primary">Створити</button>
    </form>

@endsection
