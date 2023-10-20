<div class="col mb-5">
    <div class="card bg-white h-100">
        <!-- Product image-->
        <div id="{{$name.$product->id}}" onmouseover='showSecondImage(this)' onmouseout='hideSecondImage(this)'
             style="height: 223px">
            @foreach($product->images()->get() as $key => $image)
                <div class="{{ $key===0 ?'firstImage':'d-none secondImage'}}">
                    <img src="{{asset('uploads/300_'.$image->url)}}"
                         class="card-img-top" alt="...">
                </div>
            @endforeach
        </div>
        <!-- Product details-->
        <div class="card-body p-4 pb-0">
            <div class="text-center">
                <!-- Product name-->
                <form action="{{ route('product.show',$product->id) }}"   method="GET" enctype="multipart/form-data">
                    @csrf
                    <button class="btn ">
                    <h5 class="fw-bolder">{{$product->name}}</h5>
                    </button>
                </form>
            </div>
        </div>
        <div class="d-flex justify-content-center text-warning mb-2">
            <div class="bi-star-fill"></div>
            <div class="bi-star-fill"></div>
            <div class="bi-star-fill"></div>
            <div class="bi-star-fill"></div>
            <div class="bi-star"></div>
        </div>

        <!-- Product actions-->
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent row">
            <div class="text-start col-8 d-flex flex-column align-items-start col-lg-8">
                <h6 class="text-muted text-decoration-line-through my-auto m-0 ps-1" style="font-weight: bold;">{{$product->price}} ₴</h6>
                <h5 class="text-danger my-auto m-0 ps-1" style="font-weight: bold;">{{$product->price}} ₴</h5>
            </div>
            <div class="text-center d-flex flex-column align-items-center col pe-0">
                <button onclick="addToCookieArray({{$product->id}})" class="btn text-success mt-auto p-0" href="#">
                    <i class="bi bi-cart3 p-0" style="font-size: 2rem;"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>




    function showSecondImage(el) {
        let element = el.querySelector('.secondImage');
        let element1 = el.querySelector('.firstImage');
        if (element && element1) {
            element.classList.remove("d-none");
            element1.classList.add("d-none");
        }
    }

    function hideSecondImage(el) {
        let element = el.querySelector('.secondImage');
        let element1 = el.querySelector('.firstImage');
        if (element && element1) {
            element.classList.add("d-none");
            element1.classList.remove("d-none");
        }
    }
</script>
