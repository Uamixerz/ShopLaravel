@extends('layouts.app')
@section('content')
    <section class="py-5 bg-white">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{asset('uploads/600_'.$product->images()->get()->first()->url)}}" alt="..."></div>
                <div class="col-md-6">
                    <div class="small mb-1">SKU: BST-498</div>
                    <h1 class="display-5 fw-bolder">{{$product->name}}</h1>
                    <div class="fs-5 mb-5">
                        <h6 class="text-muted text-decoration-line-through my-auto m-0 ps-1" style="font-weight: bold;">{{$product->price}} ₴</h6>
                        <h5 class="text-danger my-auto m-0 ps-1" style="font-weight: bold;">{{$product->price}} ₴</h5>
                    </div>
                    <p class="lead">{{$product->description}}</p>
                    <div class="d-flex">
                        <button onclick="addToCookieArray({{$product->id}})" class="btn btn-outline-dark flex-shrink-0" type="button">
                            <i class="bi-cart-fill me-1"></i>
                            Добавити до кошика
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h1 class="pb-3">Переглянуті вами товари</h1>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">

                @foreach($products as $product)
                    @include('product.component.item', ['$product' => $product, 'name' => 'Popular'])
                @endforeach

            </div>
        </div>
    </section>
@endsection
