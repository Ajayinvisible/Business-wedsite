@php
    $app = App\Models\App::firstOrFail();
@endphp

<section class="lonyo-cta-section bg-heading">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="lonyo-cta-thumb" data-aos="fade-up" data-aos-duration="500">
                    <img id="appImage" src="{{ asset($app->image) }}"
                        alt="{{ $app->title }}">
                    @if (auth()->check())
                        <input type="file" id="uploadImage">
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="lonyo-default-content lonyo-cta-wrap" data-aos="fade-up" data-aos-duration="700">
                    <h2 class="editable-title" contenteditable="{{ auth()->check() ? 'true' : 'false' }}"
                        data-id="{{ $app->id }}">{{ $app->title }}</h2>
                    <p class="editable-description" contenteditable="{{ auth()->check() ? 'true' : 'false' }}"
                        data-id="{{ $app->id }}">{{ $app->description }}</p>
                    <div class="lonyo-cta-info mt-50" data-aos="fade-up" data-aos-duration="900">
                        <ul>
                            <li>
                                <a href="https://www.apple.com/app-store/"><img
                                        src="{{ asset('frontend/assets/images/v1/app-store.svg') }}" alt=""></a>
                            </li>
                            <li>
                                <a href="https://playstore.com/"><img
                                        src="{{ asset('frontend/assets/images/v1/play-store.svg') }}"
                                        alt=""></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- csrf token --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    document.addEventListener('DOMContentLoaded', function() {

        function saveChanges(element) {
            let appId = element.dataset.id;
            // ✅ Fixed quotes around the class name
            let field = element.classList.contains('editable-title') ? 'title' : 'description';
            let newValue = element.innerText.trim();

            fetch(`/edit-app/${appId}`, {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        [field]: newValue
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log(`${field} updated successfully`);
                    } else {
                        console.error('Failed to update:', data);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                saveChanges(e.target);
                e.target.blur(); // optional: blur to show save finished
            }
        });

        document.querySelectorAll('.editable-title, .editable-description').forEach(function(element) {
            element.addEventListener('blur', function() {
                saveChanges(element);
            });
        });

        // Image upload handling
        let imageElement = document.getElementById('appImage');
        let uploadInput = document.getElementById('uploadImage');

        imageElement.addEventListener('click', function() {
            @if (auth()->check())
                uploadInput.click();
            @endif
        });

        uploadInput.addEventListener('change', function() {
            let file = this.files[0];
            if (!file) return;
            let formData = new FormData();
            formData.append('image', file);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute(
                'content'));
            fetch(`/upload-app-image/1`, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        imageElement.src = data.image_url;
                        console.log(`Image updated successfully`);
                    } else {
                        console.error('Failed to update:', data);
                    }
                })
                .catch(error => console.error('Error:', error));
        })


    });
</script>
