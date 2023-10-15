@extends('admin.index')
@section('content')
    <div>
        <h1 class="mt-4">Категорії <a class="btn btn-outline-success" href="{{route('category.create')}}">створити</a>
        </h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Таблиця продуктів
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </tfoot>
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
                            <td><a class="btn btn-warning"
                                   href="{{route('category.edit',$category->id)}}">Редагувати</a></td>
                            <td>
                                <form action="{{ route('category.destroy', $category->id) }}" method="POST">
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
