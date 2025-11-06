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
                        <h4 class="fs-18 fw-semibold m-0">Add slider</h4>
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

                            <form action="{{ route('update.financial', $financial->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $financial->id }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">

                                            <div class="form-group mb-3 row">
                                                <label class="form-label">Title</label>
                                                <div class="col-lg-6 col-xl-12">
                                                    <input class="form-control" type="text" name="title"
                                                        value="{{ $financial->title }}" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="form-label">Description</label>
                                        <div class="col-lg-12 col-xl-12">
                                            <textarea name="description" id="description" class="form-control" cols="20" rows="5">{{ $financial->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="form-label">financial Photo</label>
                                        <div class="col-lg-12 col-xl-12">
                                            <input name="image" class="form-control" type="file" id="image">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <div class="col-lg-12 col-xl-12">
                                            <img id="showImage"
                                                src="{{ !empty($financial->image) ? url($financial->image) : url('upload/no_image.jpg') }}"
                                                class="rounded-circle avatar-md img-thumbnail float-start"
                                                alt="image profile">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="col-lg-12 bg-primary text-white mb-3 p-2">
                                            <h4 class="mb-0">Financial Section Details</h4>
                                        </div>
                                        <div class="row g-5">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="undefine_title">Undefine Title</label>
                                                    <input class="form-control" type="text" name="undefine_title"
                                                        value="{{ $financial->undefine_title }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="undefine_icon">Undefine Icon</label>
                                                    <input class="form-control" type="text" name="undefine_icon"
                                                        value="{{ $financial->undefine_icon }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="undefine_description">Undefine Description</label>
                                                    <textarea name="undefine_description" id="undefine_description" class="form-control" cols="20" rows="5">{{ $financial->undefine_description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="real_title">Real Title</label>
                                                    <input class="form-control" type="text" name="real_title"
                                                        value="{{ $financial->real_title }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="real_icon">Real Icon</label>
                                                    <input class="form-control" type="text" name="real_icon"
                                                        value="{{ $financial->real_icon }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="real_description">Real Description</label>
                                                    <textarea name="real_description" id="real_description" class="form-control" cols="20" rows="5">{{ $financial->real_description }}</textarea>
                                                </div>
                                            </div>
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
