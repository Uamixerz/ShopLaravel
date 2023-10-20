@extends('admin.index')
@section('content')
    <form action="{{ route('category.update',$category->id) }}" class="d-flex flex-column justify-content-center" style="width: 700px; height: 80vh" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <h1>Редагування категорії</h1>
        @include('component.inputAdmin', ['name' => 'name', 'type'=>"text", 'value'=>$category->name , 'labelInfo' => 'Назва'])
        <div class="mb-0 mt-3 form-group">
            <textarea name="description" type="text" class="form-control" id="description"
                      placeholder="Опис">{{$category->description}}</textarea>
        </div>
        @include('component.imageInput', ['countImage' => 1, 'postUrl'=>"/admin/category/image"])
        <button type="submit" class="btn btn-warning">Редагувати</button>
    </form>

@endsection
