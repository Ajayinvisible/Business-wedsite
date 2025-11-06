@php
    $usability = App\Models\Usability::firstOrFail();
@endphp

<div class="lonyo-section-padding bg-heading position-relative sectionn">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="lonyo-video-thumb">
                    <img src="{{ asset($usability->image) }}" alt="">
                    <a class="play-btn video-init" href="{{ $usability->youtube_link }}">
                        <img src="{{ asset('frontend/assets/images/v1/play-icon.svg') }}" alt="">
                        <div class="waves wave-1"></div>
                        <div class="waves wave-2"></div>
                        <div class="waves wave-3"></div>
                    </a>
                </div>
            </div>
            <div class="col-lg-7 d-flex align-items-center">
                <div class="lonyo-default-content lonyo-video-section pl-50" data-aos="fade-up" data-aos-duration="500">
                    <h2 id="usability-title" contenteditable="{{ auth()->check() ? 'true' : 'false' }}"
                        data-id="{{ $usability->id }}">{{ $usability->title }}</h2>
                    <p id="usability-description" contenteditable="{{ auth()->check() ? 'true' : 'false' }}"
                        data-id="{{ $usability->id }}">{{ $usability->description }}</p>
                    <div class="mt-50" data-aos="fade-up" data-aos-duration="700">
                        <a class="lonyo-default-btn video-btn" href="{{ $usability->link }}">Download the app</a>
                    </div>
                </div>
            </div>
        </div>

        @php
            $connects = App\Models\Connect::whereIn('id', [1, 2, 3])
                ->get()
                ->keyBy('id');
        @endphp

        <div class="row">
            @foreach ($connects as $connect)
                <div class="col-xl-4 col-md-6">
                    <div class="lonyo-process-wrap" data-aos="fade-up" data-aos-duration="500">
                        <div class="lonyo-process-number">
                            <img src="{{ asset('frontend/assets/images/v1/n' . $connect->id . '.svg') }}"
                                alt="">
                        </div>
                        <div class="lonyo-process-title">
                            <h4 class="editable-title" contenteditable="{{ auth()->check() ? 'true' : 'false' }}"
                                data-id="{{ $connect->id }}">{{ $connect->title }}</h4>
                        </div>
                        <div class="lonyo-process-data">
                            <p class="editable-description" contenteditable="{{ auth()->check() ? 'true' : 'false' }}"
                                data-id="{{ $connect->id }}">{{ $connect->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="border-bottom" data-aos="fade-up" data-aos-duration="500"></div>
        </div>
    </div>
</div>


{{-- csrf token --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const titleElement = document.getElementById('usability-title');
        const descriptionElement = document.getElementById('usability-description');

        function saveChanges(element) {
            let usabilityId = element.dataset.id;
            let field = element.id === 'usability-title' ? 'title' : 'description';
            let newValue = element.innerText.trim();

            fetch(`/edit-usability/${usabilityId}`, {
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

<script>
    document.addEventListener('DOMContentLoaded', function() {

        function saveChanges(element) {
            let connectId = element.dataset.id;
            // ✅ Fixed quotes around the class name
            let field = element.classList.contains('editable-title') ? 'title' : 'description';
            let newValue = element.innerText.trim();

            fetch(`/edit-connect/${connectId}`, {
                method: 'POST',
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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

        // ✅ Auto-save on Enter
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                saveChanges(e.target);
                e.target.blur(); // optional: blur to show save finished
            }
        });

        // ✅ Auto-save on blur
        document.querySelectorAll('.editable-title, .editable-description').forEach(function(element) {
            element.addEventListener('blur', function() {
                saveChanges(element);
            });
        });
    });
</script>
