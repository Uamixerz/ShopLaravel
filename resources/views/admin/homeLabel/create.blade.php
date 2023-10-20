@extends('admin.index')
@section('content')
    <form action="{{ route('homeLabel.store') }}" class="mt-5"
          style="width: 800px; height: 80vh" method="POST" enctype="multipart/form-data">
        @csrf
        <h1>Добавлення label</h1>
        @include('component.inputAdmin', ['name' => 'name', 'type'=>"text", 'labelInfo' => 'Назва'])
        @include('admin.homeLabel.selectProductModal')
        <div class="mt-3 container px-4">
            <div id="divProductsLabel" class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">

            </div>
        </div>
        <button class="btn btn-success">Добавити</button>
    </form>

@endsection
