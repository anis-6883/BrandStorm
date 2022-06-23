@extends('backend.master')

@section('title', 'List Category')

@section('custom_css')
    <link href="{{ asset('assets/backend/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        .table td,
        .table th {
            min-width: 80px;
            text-align: center;
        }
    </style>
@endsection

@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('category.index') }}">Category List</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Category List</h4>
                        <a class="btn btn-info ml-4 mt-4" href="{{ route('category.create') }}">Add Category</a>
                        <h5 class="ml-4 mt-4">Total Category: <span class="badge bg-dark">{{ count($categories) }}</span></h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Category Name</th>
                                    <th>Category Order</th>
                                    <th>Category Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ Str::of($category->category_name)->limit(30) }}</td>
                                        <td>{{ $category->category_order }}</td>
                                        <td>
                                            @if ($category->category_status == "Active")
                                                <button id="status{{ $category->id }}" onclick="chnageStatus({{ $category->id }})" class="badge badge-success px-2">
                                                    Active
                                                </button>
                                            @else
                                                <button id="status{{ $category->id }}" onclick="chnageStatus({{ $category->id }})" class="badge badge-danger px-2">
                                                    Inactive
                                                </button>
                                            @endif
                                        </td>
                                        <td>{{ date('d F, Y', strtotime($category->created_at)) }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">

                                                <a class="btn btn-info btn-xs mr-2" href="{{ route('category.edit', $category->id) }}">Edit</a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="basicModal{{ $category->id }}">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete Category</h5>
                                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">Are you sure to delete <b>"{{ $category->category_name }}"</b> Category? </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Never Mind</button>
                                                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Button trigger modal -->
                                                <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#basicModal{{ $category->id }}">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Category Name</th>
                                    <th>Category Order</th>
                                    <th>Category Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #/ container -->
@endsection

@section('custom_js')
    <script src="{{ asset('assets/backend/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>

    <script>
        function chnageStatus(category_id) {
            $(function() {
                var statusBtn = $(`#status${category_id}`);
                var statusText = statusBtn.text();
                $.ajax({
                    url: "{{ route('category.updateStatus') }}",
                    type: "POST",
                    data: {
                        category_id,
                        statusText: statusText === "Active" ? "Inactive" : "Active",
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(result) {
                        if (result) {
                            if (statusText === "Active") {
                                statusBtn.text("Inactive");
                                statusBtn.removeClass("badge-success");
                                statusBtn.addClass("badge-danger");
                            } else {
                                statusBtn.text("Active");
                                statusBtn.removeClass("badge-danger");
                                statusBtn.addClass("badge-success");
                            }
                        }
                    }
                });
            });
        }
    </script>

@endsection