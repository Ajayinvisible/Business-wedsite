@extends('admin.admin_mater')

@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                {{-- <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">All Review</h4>
                </div> --}}
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">All Review</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th width="3%">S.n</th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th width="9%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogs as $key => $blog)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $blog->blog_cat_id }}</td>
                                            <td>{{ $blog->title }}</td>
                                            <td>
                                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}"
                                                    class="rounded-circle" style="width: 50px; height: 50px;">
                                            </td>
                                            <td>{!! Str::limit($blog->description, 50, '...') !!}</td>
                                            <td>
                                                <a href="{{ route('edit.blog', $blog->id) }}"
                                                    class="btn btn-success rounded">
                                                    <i class="fa-solid fa-pen-to-square"></i></a>
                                                <a href="{{ route('delete.blog', $blog->id) }}"
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
@endsection
