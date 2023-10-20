@extends('admin.index')
@section('content')
    <div class="m-5">
        <a class="btn btn-success" href="{{route('homeLabel.create')}}">
            Створити label
            <i class="bi bi-bookmark-fill"></i>

        </a>
        @include('admin.homeLabel.component.tableLabel')
    </div>

@endsection
