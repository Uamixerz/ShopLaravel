@extends('layouts.app')
@section('content')
<div>
    <p>Показ продуктів <a class="btn btn-outline-success" href="{{route('product.create')}}">Створити</a></p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Category</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>
                    @foreach($product->images()->get() as $image)
                        <img src="{{asset('uploads/150_'.$image->url)}}" class="img-thumbnail" alt="...">
                    @endforeach
                </td>
                <td>{{$product->name}}</td>
                <td>{{ substr($product->description, 0, 40) }}...</td>
                <td>{{$product->price}}</td>
                <td>{{$product->category->name}}</td>
                <td><a class="btn btn-warning" href="{{route('product.edit',$product->id)}}">Редагувати</a></td>
                <td><form action="{{ route('product.destroy', $product->id) }}" method="POST">
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
