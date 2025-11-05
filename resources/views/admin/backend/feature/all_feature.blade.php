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
                            <h5 class="card-title mb-0">All Features</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th width="3%">S.n</th>
                                        <th>Name</th>
                                        <th>Icon</th>
                                        <th>Description</th>
                                        <th width="9%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($features as $key => $feature)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $feature->title }}</td>
                                            <td><i class="{{ $feature->icon }} fs-3"></i></td>
                                            <td>{!! Str::limit($feature->description, 50, '...') !!}</td>
                                            <td>
                                                <a href="{{ route('edit.feature', $feature->id) }}"
                                                    class="btn btn-success rounded">
                                                    <i class="fa-solid fa-pen-to-square"></i></a>
                                                <a href="{{ route('delete.feature', $feature->id) }}"
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
