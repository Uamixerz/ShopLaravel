<li class="nav-item">
    <button class="btn btn-outline-dark" type="submit" data-bs-toggle="modal" onclick="uploadBasket()"
            data-bs-target="#basketModal">
        <i class="bi-cart-fill me-1"></i>
        Корзина
        <span id="productCount" class="badge bg-dark text-white ms-1 rounded-pill">0</span>
    </button>
</li>
@include('home.basket.orderModalContent')

<div class="modal fade" id="basketModal" tabindex="-1" aria-labelledby="basketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="basketModalLabel"><i class="bi-cart-fill me-1"></i> Корзина</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Зображення</th>
                        <th scope="col">Назва</th>
                        <th scope="col">Ціна</th>
                        <th scope="col">Кількість</th>
                    </tr>
                    </thead>
                    <tbody id="tableBasketTbody">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <p id="sumItems" name="sumItems" class="text-bg-light">Всього: 0 грн</p>
                @include('home.basket.orderModalBtn')
            </div>
        </div>
    </div>
</div>

<script>
    let sumAll = 0;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    document.addEventListener('DOMContentLoaded', function () {
        let existingData = getCookieData('cart');
        let dataArray = existingData ? JSON.parse(existingData) : [];
        UpdateCount(dataArray);
    });

    function UpdateCount(dataArray) {

        productCountEl = document.getElementById('productCount');
        if (productCountEl) {
            let sum = 0;
            for (let i = 0; i < dataArray.length; i++) {
                sum += parseInt(dataArray[i].count);
            }
            productCountEl.innerHTML = sum;
        }
    }

    async function uploadBasket() {
        try {
            const response = await axios.get('/order/basket', {

                headers: {
                    'X-CSRF-TOKEN': csrfToken, // Передача CSRF-токена в заголовке
                },
            });
            updateTableBasket(response.data);
            console.log("Success ", response.data);
        } catch (error) {
            console.error("Error:", error);
        }
    }

    function setCountProductInBasket(count, price, productId) {
        let existingData = getCookieData('cart');
        let dataArray = existingData ? JSON.parse(existingData) : [];

        for (let i = 0; i < dataArray.length; i++) {
            if (dataArray[i].id === productId) {
                sumAll -= dataArray[i].count * price;
                sumAll += count * price;
                if (count > 0)
                    dataArray[i].count = count;
                else {
                    let element = document.getElementById('basket_item_' + productId);
                    if (element) {
                        element.remove();
                    }
                    dataArray.splice(i, 1);
                }
                break;
            }
        }


        document.cookie = "cart=" + JSON.stringify(dataArray) + "; path=/";
        UpdateAllSum();
        UpdateCount(dataArray);
    }

    function updateTableBasket(products) {
        const tableBody = document.getElementById('tableBasketTbody');
        tableBody.innerHTML = '';
        sumAll = 0;

        products.forEach(product => {
            const row = tableBody.insertRow();
            row.id = 'basket_item_' + product.id;
            const cell1 = row.insertCell(0);

            const cell2 = row.insertCell(1);
            const cell3 = row.insertCell(2);
            const cell4 = row.insertCell(3);
            const cell5 = row.insertCell(4);

            const p = document.createElement('p');
            p.className = 'form-control text-center';
            p.innerText = product.name;
            cell2.appendChild(p);
            const priceP = document.createElement('p');
            priceP.className = 'form-control text-center';
            priceP.innerText = product.price;
            cell3.appendChild(priceP);

            if (product.url) {
                const img = document.createElement('img');
                img.src = '{{asset(('uploads/300_'))}}' + product.url;
                img.className = "card-img-top";
                cell1.appendChild(img);
            } else {
                cell1.innerHTML = 'Фото відсутнє';
            }
            const input = document.createElement('input');
            input.min = '1';
            input.className = 'form-control text-center';
            input.type = 'number';
            input.value = product.count;
            input.onchange = function () {
                setCountProductInBasket(input.value, product.price, product.id);
            };
            sumAll += product.count * product.price;
            cell4.appendChild(input);


            const iconDelete = document.createElement('i');
            iconDelete.className = "bi bi-trash3-fill";
            iconDelete.onclick = function () {
                setCountProductInBasket(0, product.price, product.id);
            };

            cell5.appendChild(iconDelete);
        });
        UpdateAllSum();
    }

    function UpdateAllSum() {
        const textSum = document.getElementsByName('sumItems');
        for (let i = 0; i < textSum.length; i++) {
            textSum[i].innerHTML = ' Загальна вартість: ' + sumAll + ' грн ';
        }
    }

    function getCookieData(cookieName) {
        let name = cookieName + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) === 0) {
                return c.substring(name.length, c.length);
            }
        }
        return null;
    }
</script>
