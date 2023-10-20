<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-black">
                <h1 class="modal-title fs-5" id="orderModalLabel"><i class="bi bi-bag-heart-fill"></i> Оформлення
                    замовлення</h1>
                <button type="button" class="btn bi bi-x-lg text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="ps-4 pe-4 pt-4">
                <div class="row gx-3">
                    <div  class="col-md-6 ">
                        @include('component.inputAdmin', ['name' => 'firstName','labelInfo' => 'Ім\'я','type' => 'text','value' => isset(auth()->user()->firstName) ? auth()->user()->firstName : null])
                        <div id="firstNameError" style="min-height: 20px"></div>
                    </div>

                    <div class="col-md-6">
                        @include('component.inputAdmin',['name' => 'lastName','labelInfo'=>'Прізвище','type'=>'text','value' => isset(auth()->user()->lastName) ? auth()->user()->lastName : null])
                        <div id="lastNameError"></div>
                    </div>

                </div>
                @include('component.inputAdmin',['name' => 'phone','labelInfo'=>'Номер телефону','type'=>'phone','value' => isset(auth()->user()->phone) ? auth()->user()->phone : null])
                <div id="phoneError"></div>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Зображення</th>
                        <th scope="col">Назва</th>
                        <th scope="col">Кількість</th>
                        <th scope="col">Ціна</th>
                    </tr>
                    </thead>
                    <tbody id="tableOrderTbody">
                    </tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td name="sumItems" class=" "></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer d-flex align-items-center justify-content-center">
                <button onclick="storeOrder()" type="button" class="btn btn-outline-success ">Замовити</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function storeOrder() {
        const formData = new FormData();
        const nameInput = document.getElementById('firstName');
        formData.append('firstName', nameInput.value);
        const lastNameInput = document.getElementById('lastName');
        formData.append('lastName', lastNameInput.value);
        const phoneInput = document.getElementById('phone');
        formData.append('phone', phoneInput.value);
        try {
            const response = await axios.post('/order', formData, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken, // Передача CSRF-токена в заголовке
                },
            });
            $('#orderModal').modal('hide');
            updateTableBasket([]);
            UpdateCount([]);
        } catch (error) {
            console.error("Error:", error.response.data.errors);
            const errors = error.response.data.errors;
            const firstNameError = document.getElementById('firstNameError');
            firstNameError.innerHTML = errors.firstName ? `<p class="text-danger alert p-0">${errors.firstName[0]}</p>` : '';
            const lastNameError = document.getElementById('lastNameError');
            lastNameError.innerHTML = errors.lastName ? `<p class="text-danger alert p-0">${errors.firstName[0]}</p>` : '';
            const phoneError = document.getElementById('phoneError');
            phoneError.innerHTML = errors.phone ? `<p class="text-danger alert p-0">${errors.firstName[0]}</p>` : '';
        }
    }

</script>


