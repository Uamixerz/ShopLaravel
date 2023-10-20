<div class="mb-3 form-group">
    <label for="image" class="form-label mb-0 mt-2">Зображення (Макс. кількість фото: {{$countImage}})</label>
    <input type="file" class="form-control" id="image" multiple>
    @error('images')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>

<div class="container p-0">
    <div id="preview-images" class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 ">
        @if(isset($images))
            @foreach($images as $image)
                <div class="col mb-3 " id="img_{{$image->id}}">
                    <div class="card h-100">
                        <input type="hidden" name="images[]" value="{{$image->id}}">
                        <div class="d-flex justify-content-end">
                            <i onclick="removeElement({{$image->id}})" class="fas fa-close"></i>
                        </div>
                        <img src='{{asset('uploads/300_'.$image->url)}}' alt="Preview Image">
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let countImage = 0;
    @if(isset($images))
        @foreach($images as $image)
        countImage++;
    @endforeach
    @endif
    // Викликається після завантаження сторінки, перевіряються та загружаються фотки після перегрузки сторінки
    document.addEventListener('DOMContentLoaded', function () {
        @if(old('images') && !isset($images))
        @for( $i =0; $i < count(old('images')); $i++)
            findAndCreateImage({{ old('images.'.$i)}})
        @endfor
        @endif
    });
    // по id картинки завантажується на форму
    async function findAndCreateImage(id) {
        try {
            const response = await fetch('{{$postUrl}}/' + id, {
                method: "GET",
                headers: {
                    'X-CSRF-TOKEN': csrfToken, // Передача CSRF-токена в заголовке
                },
            });
            countImage++;
            const result = await response.json();
            addImage(result.url, result.id);
            console.log("Success destroy");
        } catch (error) {
            console.error("Error:", error);
        }
    }
    // Завантаження фотки в бд
    document.getElementById('image').addEventListener('change', async function () {

        if (countImage < {{$countImage}}) {
            countImage++;
            const formData = new FormData();

            for (let i = 0; i < this.files.length; i++) {
                const imageFile = this.files[i];
                formData.append("file", imageFile);
            }
            try {
                const response = await fetch('{{$postUrl}}', {
                    method: "POST",
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken, // Передача CSRF-токена в заголовке
                    },
                });
                const result = await response.json();
                addImage(result.url, result.id);
                //console.log("Success:", JSON.stringify(result));
            } catch (error) {
                countImage--;
                console.error("Error:", error);
            }
        }
        this.value = '';
    });
    // Створення html фото на формі
    function addImage(urlImage, id) {
        const previewImagesContainer = document.getElementById('preview-images');
        const firstDiv = document.createElement('div');
        firstDiv.className = 'col mb-3 ';
        firstDiv.id = 'img_' + id;
        const customDiv = document.createElement('div');
        customDiv.className = 'card h-100';

        const innerDiv = document.createElement('div');
        innerDiv.className = 'd-flex justify-content-end';

        const forIconDiv = document.createElement('div');
        forIconDiv.onclick = function () {
            removeElement(id);
        };

        const icon = document.createElement('i');
        icon.className = 'fas fa-close';

        const imageElement = document.createElement('img');
        imageElement.src = '{{asset(('uploads/300_'))}}' + urlImage;
        imageElement.alt = 'Preview Image';

        const inputHidden = document.createElement('input');
        inputHidden.type = 'hidden';
        inputHidden.name = 'images[]';
        inputHidden.value = id;

        // Добавьте элементы в соответствующие контейнеры
        forIconDiv.appendChild(icon);
        innerDiv.appendChild(forIconDiv);
        customDiv.appendChild(inputHidden);
        customDiv.appendChild(innerDiv);
        customDiv.appendChild(imageElement);
        firstDiv.appendChild(customDiv);

        // Добавьте кастомный div в контейнер для предпросмотра изображений
        previewImagesContainer.appendChild(firstDiv);
    }
    // Видалення фото
    async function removeElement(id) {
        const element = document.getElementById('img_' + id);

        if (element) {
            const formData = new FormData();
            formData.append('id', id);

            try {
                const response = await fetch('{{$postUrl}}/' + id, {
                    method: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken, // Передача CSRF-токена в заголовке
                    },
                });
                countImage--;
                element.remove();
                console.log("Success destroy");
            } catch (error) {
                console.error("Error:", error);
            }
        } else {
            console.log("Not found");
        }
    }
</script>
