@extends('layouts.app')
@section('content')
<div>
    <p>Показ категорій</p><a class="btn btn-outline-success" href="{{route('category.create')}}">Створити</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>
                @foreach($category->images()->get() as $image)
                    <img src="{{asset('uploads/150_'.$image->url)}}" class="img-thumbnail" alt="...">
                @endforeach
                </td>
                <td>{{$category->name}}</td>
                <td>{{$category->description}}</td>
                <td><a class="btn btn-warning" href="{{route('category.edit',$category->id)}}">Редагувати</a></td>
                <td><form action="{{ route('category.destroy', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Видалити</button>
                    </form></td>
            </tr>
        @endforeach


        </tbody>
    </table>
</div>
@endsection
