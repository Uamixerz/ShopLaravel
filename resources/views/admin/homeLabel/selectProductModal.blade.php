<button class="btn btn-success mt-3" type="button" data-bs-toggle="modal" data-bs-target="#selectProductModal">
    ДОБАВИТИ ПРОДУКТ ДО LABEL
</button>
@include('home.basket.orderModalContent')

<div class="modal fade" id="selectProductModal" tabindex="-1" aria-labelledby="selectProductModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-black">
                <h1 class="modal-title fs-5 text-white" id="selectProductModalLabel">Вибір товару</h1>
                <button type="button" class="btn bi bi-x-lg text-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                                <th>Price</th>
                                <th>Category</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($products as $key => $product)
                                <tr>
                                    <td>
                                        <img src="{{asset('uploads/150_'.$product->images()->get()->first()->url)}}"
                                             class="img-thumbnail" alt="...">
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td >
                                        <button id="selectProduct{{$product->id}}" class="btn btn-warning" type="button"
                                                onclick="addProduct(this, {{$key}}, {{$product->id}})">Вибрати
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="{{asset('js/datatables-simple-demo.js')}}"></script>
<script>
    window.addEventListener('load', function() {
        @if(isset($label))
        let products = <?php echo json_encode($label->products()->get()); ?>;
        for (let i = 0; i < products.length; i++) {
            const btn = document.getElementById('selectProduct' + products[i].product_id);
            btn.click()
        }
        @endif
    });

    function addProduct(btn, key, id) {

        btn.innerHTML = '<i class="bi bi-check-lg"></i>';
        btn.className = 'btn btn-success';
        console.log('remove for',btn);
        btn.onclick = function () {
            removeProductHtml(id,key);
        }


        addProductHtml(key);
    }

    function removeProductHtml(id, key) {
        console.log('remove');
        const element = document.getElementById('product_' + id);
        element.remove();
        const btn = document.getElementById('selectProduct' + id);
        btn.className = 'btn btn-warning';
        btn.innerHTML = 'Вибрати';
        btn.onclick = function () {
            addProduct(btn, key, id);
        }
    }

    function addProductHtml(key) {
        let products = <?php echo json_encode($products); ?>;
        console.log('products ', products);
        const div1 = document.getElementById('divProductsLabel');
        let div = document.createElement("div");
        div.id = 'product_' + products[key].id;
        div.className = "col mb-5";
        div.style.minWidth = "190px";
        div.innerHTML = `
    <div class="card bg-white h-100" style="min-width: 166px">
        <!-- Product image-->
        <div>
            <img src="{{asset('uploads/300_')}}${products[key].url}" class="card-img-top" alt="...">
        </div>
        <!-- Product details-->
        <div class="card-body p-4 pt-0 pb-0">
            <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder">${products[key].name}</h5>
            </div>
        </div>
        <input type='hidden' name='products[]' value='${products[key].id}'></input>
        <!-- Product actions-->
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent row">
            <div class="text-start col-8 d-flex flex-column align-items-start col-lg-8">
                <h5 class="text-danger my-auto m-0 ps-1" style="font-weight: bold;">${products[key].price} ₴</h5>
            </div>
            <div class="text-center d-flex flex-column align-items-center col pe-0">
                <button onclick="removeProductHtml(${products[key].id})" class="btn text-danger mt-auto p-0" href="#">
                    <i class="bi bi-x-lg p-0" style="font-size: 2rem;"></i>
                </button>
            </div>
        </div>
    </div>
`;
        div1.appendChild(div);
    }

</script>
