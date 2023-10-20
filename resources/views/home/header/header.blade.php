<div class="container px-4 px-lg-5 my-5">
    <div class="row" id="headRow">
        <ul class="list-group list-group-flush col-4 p-0">
            @foreach($categories as $category)
                <li class="list-group-item btn text-lg-start"><h4>{{$category->name}}</h4></li>
            @endforeach
        </ul>
        <div id="carouselExampleIndicators" class="carousel slide carousel-dark col-8 p-0">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://content1.rozetka.com.ua/banner_main/image_ua/original/373339658.jpg"
                         class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://content1.rozetka.com.ua/banner_main/image_ua/original/372544021.jpg"
                         class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://content1.rozetka.com.ua/banner_main/image_ua/original/372795715.jpg"
                         class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                <i class="bi bi-arrow-left-circle-fill" style="color: black; font-size: 2rem;"></i>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                <i class="bi bi-arrow-right-circle-fill" style="color: black; font-size: 2rem;"></i>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
