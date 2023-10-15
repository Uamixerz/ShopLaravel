@extends('admin.index')
@section('content')
    <div>
        <h1 class="mt-4">Продукти  <a class="btn btn-outline-success" href="{{route('product.create')}}">створити</a></h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Таблиця продуктів
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>Images</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Images</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </tfoot>
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
                            <td><a class="btn btn-warning" href="{{route('product.edit',$product->id)}}">Редагувати</a>
                            </td>
                            <td>
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Видалити</button>
                                </form>
                            </td>
                        </tr>

                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="{{asset('js/datatables-simple-demo.js')}}"></script>
@endsection
