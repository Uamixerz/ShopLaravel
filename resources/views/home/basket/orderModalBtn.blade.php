<li class="nav-item">
    <button type="button" onclick="uploadOrder()" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#orderModal">
        Замовити
    </button>
</li>

<script>

    async function uploadOrder() {
        try {
            const response = await axios.get('/order/basket', {

                headers: {
                    'X-CSRF-TOKEN': csrfToken, // Передача CSRF-токена в заголовке
                },
            });
            updateTableOrder(response.data);
            console.log("Success ", response.data);
        } catch (error) {
            console.error("Error:", error);
        }
    }
    function updateTableOrder(products) {
        const tableBody = document.getElementById('tableOrderTbody');
        tableBody.innerHTML = '';
        sumAll = 0;

        products.forEach(product => {
            const row = tableBody.insertRow();
            row.id = 'order_item_' + product.id;
            const cell1 = row.insertCell(0);

            const cell2 = row.insertCell(1);
            const cell3 = row.insertCell(2);
            const cell4 = row.insertCell(3);
            cell2.innerHTML = product.name;
            cell3.innerHTML = product.count;
            cell4.innerHTML = product.price;

            if (product.url) {
                const img = document.createElement('img');
                img.src = '{{asset(('uploads/300_'))}}' + product.url;
                img.className = "card-img-top";
                img.style.maxWidth = "70px";
                cell1.appendChild(img);
            } else {
                cell1.innerHTML = 'Фото відсутнє';
            }
        });
    }
</script>
