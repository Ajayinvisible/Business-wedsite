@php
    $financial = App\Models\Financial::firstOrFail();
@endphp
<div class="lonyo-section-padding4 position-relative">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 order-lg-2">
                <div class="lonyo-content-thumb" data-aos="fade-up" data-aos-duration="700">
                    <img src="{{ asset($financial->image) }}" alt="{{ $financial->title }}  ">
                </div>
            </div>
            <div class="col-lg-7 d-flex align-items-center">
                <div class="lonyo-default-content pr-50" data-aos="fade-right" data-aos-duration="700">
                    <h2 id="financial-title" contenteditable="{{ auth()->check() ? 'true' : 'false' }}"
                        data-id="{{ $financial->id }}">{{ $financial->title }}</h2>
                    <p id="financial-description" contenteditable="{{ auth()->check() ? 'true' : 'false' }}"
                        data-id="{{ $financial->id }}" class="data">{{ $financial->description }}</p>
                    <div class="mt-50">
                        <ul class="tabs">
                            <li class="active-tab">
                                <i class="{{ $financial->undefine_icon }}"></i>
                                <h4>{{ $financial->undefine_title }}</h4>
                            </li>
                            <li>
                                <i class="{{ $financial->real_icon }}"></i>
                                <h4>{{ $financial->real_title }}</h4>
                            </li>
                        </ul>
                        <ul class="tabs-content">
                            <li>
                                {{ $financial->undefine_description }}
                            </li>
                            <li>
                                {{ $financial->real_description }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lonyo-content-shape2"></div>
</div>
{{-- csrf token --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const titleElement = document.getElementById('financial-title');
        const descriptionElement = document.getElementById('financial-description');

        function saveChanges(element) {
            let financialId = element.dataset.id;
            let field = element.id === 'financial-title' ? 'title' : 'description';
            let newValue = element.innerText.trim();

            fetch(`/edit-financial/${financialId}`, {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        "Content-Type": 'application/json'
                    },
                    body: JSON.stringify({
                        [field]: newValue
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log(`${field} updated successfully`);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
        //auto save on enter

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                saveChanges(e.target);
            }
        });

        //auto save on blur
        titleElement.addEventListener('blur', function() {
            saveChanges(titleElement);
        })

        descriptionElement.addEventListener('blur', function() {
            saveChanges(descriptionElement);
        });
    });
</script>
