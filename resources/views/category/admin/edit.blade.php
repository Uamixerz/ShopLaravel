@extends('admin.index')
@section('content')
    <form action="{{ route('category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        @include('component.inputAdmin', ['name' => 'name', 'type'=>"text", 'value'=>$category->name])

        <div class="mb-3 form-group">
            <label for="description" class="form-label">Опис</label>
            <textarea name="description" type="text" class="form-control" id="description"
                      placeholder="description">{{$category->description}}</textarea>
        </div>
        @include('component.imageInput', ['countImage' => 1, 'postUrl'=>"/admin/category/image"])

        <button type="submit" class="btn btn-warning">Редагувати</button>
    </form>

@endsection
