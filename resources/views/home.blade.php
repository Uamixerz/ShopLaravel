@extends('layouts.app')
@section('content')
    <header>
        @include('home.header.header')
    </header>

    <!-- Section-->
    <section class="">
        @foreach($labels as $label)
            <div class="container px-4 px-lg-5 mt-5">
                <h1 class="pb-3">{{$label->name}}</h1>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">
                    @foreach($label->products()->get() as $labelProduct)
                            @include('product.component.item', ['product' => $labelProduct->product()->get()->first(), 'name' => $label->name])
                    @endforeach
                </div>
            </div>
        @endforeach


    </section>

@endsection
