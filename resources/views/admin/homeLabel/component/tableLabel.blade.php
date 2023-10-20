
    <div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Таблиця labels
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>id products</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>id products</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($labels as $label)
                        <tr>
                            <td>
                                {{$label->name}}
                            </td>
                            <td>
                                @foreach($label->products()->get() as $product)
                                    {{ $product->id}} ,
                                @endforeach
                            </td>

                            <td><a class="btn btn-warning" href="{{ route('homeLabel.edit', $label->id) }}">Редагувати</a>
                            </td>
                            <td>
                                <form action="{{ route('homeLabel.destroy', $label->id) }}" method="POST">
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

