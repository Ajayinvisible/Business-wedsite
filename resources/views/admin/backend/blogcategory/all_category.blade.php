@extends('admin.admin_mater')

@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Category-modal">
                    Add Blog Category
                </button>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">All Blog Category</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th width="3%">S.n</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th width="9%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $category)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $category->category_name }}</td>
                                            <td>{{ $category->category_slug }}</td>
                                            <td>
                                                <button type="button" id="{{ $category->id }}" class="btn btn-success rounded" data-bs-toggle="modal"
                                                    data-bs-target="#CategoryEdit-modal" onclick="categoryEdit(this.id)">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>   
                                                <a href="{{ route('delete.blog.category', $category->id) }}"
                                                    class="btn btn-danger rounded">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div> <!-- content -->

    {{-- modal --}}
    <div class="modal fade" id="Category-modal" tabindex="-1" aria-labelledby="Category-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="Category-modalLabel">Blog Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store.blog.category') }}" method="POST">
                        @csrf
                        <div class="form-group col-md-12">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="name" name="category_name"
                                placeholder="Enter Blog Category Name">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- edit modal --}}
    <div class="modal fade" id="CategoryEdit-modal" tabindex="-1" aria-labelledby="CategoryEdit-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="CategoryEdit-modalLabel">Edit Blog Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update.blog.category') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="cat_id" id="cat_id">
                        <div class="form-group col-md-12">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="cat" name="category_name"
                                placeholder="Enter Blog Category Name">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function categoryEdit(id) {
            $.ajax({
                url: "/edit/" + id + "/blog/category",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#cat_id').val(data.id);
                    $('#cat').val(data.category_name);
                }
            });
        }
    </script>
@endsection
