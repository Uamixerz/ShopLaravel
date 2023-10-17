<div class="col mb-5">
    <div class="card h-100">
        <!-- Product image-->
        <div id="carousel{{$product->id}}" class="carousel slide carousel-dark">
            <div class="carousel-inner">
                @foreach($product->images()->get() as $key => $image)
                    <div class="carousel-item {{ $key===0 ?'active':''}}">
                        <img src="{{asset('uploads/600_'.$image->url)}}" class="card-img-top" alt="...">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{$product->id}}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel{{$product->id}}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- Product details-->
        <div class="card-body p-4">
            <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder">{{$product->name}}</h5>
                <!-- Product price-->

                <h6>{{$product->description}}</h6>
            </div>
        </div>
        <!-- Product actions-->
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center">
                <p class="text-bg-success">{{$product->price}} грн</p>
            </div>
                <div class="text-center"><button onclick="addToCookieArray({{$product->id}})" class="btn btn-outline-success mt-auto" href="#">Купити</button></div>
        </div>
    </div>
</div>

<script>


    function addToCookieArray(productId) {
        let existingData = getCookieData('cart');
        let dataArray = existingData ? JSON.parse(existingData) : [];
        console.log('data arr',dataArray);

        let found = false;

        for (let i = 0; i < dataArray.length; i++) {
            if (dataArray[i].id === productId) {
                dataArray[i].count++;
                found = true;
                break;
            }
        }

        if (!found) {
            dataArray.push({ 'id': productId, 'count': 1 });
        }

        document.cookie = "cart=" + JSON.stringify(dataArray) + "; path=/";

        UpdateCount(dataArray);
    }




</script>
