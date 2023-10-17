@extends('admin.index')
@section('content')
    <div>
        <h1 class="mt-4">Замовлення</h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Таблиця продуктів
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                        <th>Product</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                        <th>Product</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>
                                {{$order->id}}
                            </td>
                            <td>{{$order->firstName}}</td>
                            <td>{{$order->lastName}}</td>
                            <td>{{$order->phone}}</td>
                            <td>@foreach($order->products()->get() as $product_order)
                                    <div class="card">
                                        <div class="card-body">
                                            <p>{{$product_order->product()->get()[0]->name}}</p> ->
                                            кількість {{$product_order->count}}
                                        </div>

                                    </div>
                                @endforeach
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                        {{$order->status}}
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="ps-1 pe-1"><p class="btn btn-warning w-100 ">Прийнято</p>
                                        </li>
                                        <li class="ps-1 pe-1"><p class="btn btn-success w-100">Доставлено</p>
                                        </li>
                                        <li class="ps-1 pe-1"><p class="btn btn-danger w-100">Відмовлено</p>
                                        </li>
                                    </ul>
                                </div>
                            </td>

                            <td><a class="btn btn-warning">Редагувати</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="{{asset('js/datatables-simple-demo.js')}}"></script>
@endsection
