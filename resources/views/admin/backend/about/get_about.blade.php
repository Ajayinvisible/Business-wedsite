@extends('admin.admin_mater')

@section('admin')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <div class="content">

        <div class="content">

            <!-- Start Content-->
            <div class="container-xxl">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    {{-- <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">Add about</h4>
                    </div> --}}
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Slider</h5>
                        </div><!-- end card header -->

                        <div class="card-body">

                            <form action="{{ route('update.about', $about->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $about->id }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">

                                            <div class="form-group mb-3 row">
                                                <label class="form-label">Title</label>
                                                <div class="col-lg-6 col-xl-12">
                                                    <input class="form-control" type="text" name="title"
                                                        value="{{ $about->title }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="form-label">Description</label>
                                        <div class="col-lg-12 col-xl-12">
                                            <textarea name="description" id="description" class="form-control d-none" cols="20" rows="5"></textarea>
                                            <div id="quill-editor" style="height: 250px;">
                                                {!! $about->description !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="form-label">About Photo</label>
                                        <div class="col-lg-12 col-xl-12">
                                            <input name="image" class="form-control" type="file" id="image">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <div class="col-lg-12 col-xl-12">
                                            <img id="showImage"
                                                src="{{ !empty($about->image) ? url($about->image) : url('upload/no_image.jpg') }}"
                                                class="rounded-circle avatar-md img-thumbnail float-start"
                                                alt="image profile">
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-primary">Save
                                        Changes</button>
                                </div><!--end card-body-->
                            </form><!--end form-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div> <!-- content -->
    <script>
        document.querySelectorAll('form').onsubmit = function() {
            var description = document.querySelector('#description');
            description.value = quill.root.innerHTML;
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            })
        })
    </script>
@endsection
