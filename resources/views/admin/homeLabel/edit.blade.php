@extends('admin.index')
@section('content')
    <form action="{{ route('homeLabel.update',$label->id) }}" class="mt-5"
          style="width: 800px; height: 80vh" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <h1>Редагування label</h1>
        @include('component.inputAdmin', ['name' => 'name', 'type'=>"text", 'labelInfo' => 'Назва', 'value' => $label->name])
        @include('admin.homeLabel.selectProductModal')
        <div class="mt-3 container px-4">
            <div id="divProductsLabel" class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">

            </div>
        </div>
        <button class="btn btn-warning">Редагувати</button>
    </form>

@endsection
