@php
    $clarifi = App\Models\Clarifie::firstOrFail();
@endphp
<section class="lonyo-section-padding6">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="lonyo-content-thumb" data-aos="fade-up" data-aos-duration="700">
                    <img src="{{ asset($clarifi->image) }}" alt="">
                </div>
            </div>
            <div class="col-lg-7 d-flex align-items-center">
                <div class="lonyo-default-content pl-50" data-aos="fade-up" data-aos-duration="700">
                    <h2 id="clarifi-title" contenteditable="{{ auth()->check() ? 'true' : 'false' }}"
                        data-id="{{ $clarifi->id }}">{{ $clarifi->title }}</h2>
                    <p id="clarifi-description" contenteditable="{{ auth()->check() ? 'true' : 'false' }}"
                        data-id="{{ $clarifi->id }}" class="data">{{ $clarifi->description }}</p>

                    <div class="lonyo-faq-wrap1 mt-50">
                        <div class="lonyo-faq-item open" data-aos="fade-up" data-aos-duration="500">
                            <div class="lonyo-faq-header">
                                <h4>Real-Time Expense Tracking:</h4>
                                <div class="lonyo-active-icon">
                                    <img class="plasicon" src="{{ asset('frontend/assets/images/v1/mynus.svg') }}"
                                        alt="">
                                    <img class="mynusicon" src="{{ asset('frontend/assets/images/v1/plas.svg') }}"
                                        alt="">
                                </div>
                            </div>
                            <div class="lonyo-faq-body">
                                <p>Automatically and syncs with bank accounts and credit cards to provide instant
                                    updates on spending, helping users stay aware of their all daily transactions.</p>
                            </div>
                        </div>
                        <div class="lonyo-faq-item" data-aos="fade-up" data-aos-duration="700">
                            <div class="lonyo-faq-header">
                                <h4>Comprehensive Financial Overview:</h4>
                                <div class="lonyo-active-icon">
                                    <img class="plasicon" src="{{ asset('frontend/assets/images/v1/mynus.svg') }}"
                                        alt="">
                                    <img class="mynusicon" src="{{ asset('frontend/assets/images/v1/plas.svg') }}"
                                        alt="">
                                </div>
                            </div>
                            <div class="lonyo-faq-body">
                                <p>Automatically and syncs with bank accounts and credit cards to provide instant
                                    updates on spending, helping users stay aware of their all daily transactions.</p>
                            </div>
                        </div>
                        <div class="lonyo-faq-item" data-aos="fade-up" data-aos-duration="900">
                            <div class="lonyo-faq-header">
                                <h4>Stress-Reducing Automation:</h4>
                                <div class="lonyo-active-icon">
                                    <img class="plasicon" src="{{ asset('frontend/assets/images/v1/mynus.svg') }}"
                                        alt="">
                                    <img class="mynusicon" src="{{ asset('frontend/assets/images/v1/plas.svg') }}"
                                        alt="">
                                </div>
                            </div>
                            <div class="lonyo-faq-body">
                                <p>Automatically and syncs with bank accounts and credit cards to provide instant
                                    updates on spending, helping users stay aware of their all daily transactions.</p>
                            </div>
                        </div>
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
        const titleElement = document.getElementById('clarifi-title');
        const descriptionElement = document.getElementById('clarifi-description');

        function saveChanges(element) {
            let clarifiId = element.dataset.id;
            let field = element.id === 'clarifi-title' ? 'title' : 'description';
            let newValue = element.innerText.trim();

            fetch(`/edit-clarifies/${clarifiId}`, {
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
