@extends('backend.master')

@section('title', 'List Package')

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
                <li class="breadcrumb-item"><a href="{{ route('package.index') }}">Manage Package</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('package.index') }}">List Package</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Package List</h4>
                        <a class="btn btn-info ml-4 mt-4" href="{{ route('package.create') }}">Add Package</a>
                        <h5 class="ml-4 mt-4">Total Package: <span class="badge bg-dark">{{ count($packages) }}</span></h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">

                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Category</th>
                                        <th>Subcategory</th>
                                        <th>Package Name</th>
                                        <th>Status</th>
                                        <th>Package Order</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($packages as $package)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $package->subcategory->category->category_name }}</td>
                                            <td>{{ $package->subcategory->subcategory_name }}</td>
                                            <td>{{ $package->package_title }}</td>
                                            <td>
                                                @if ($package->package_status == "Active")
                                                    <button id="status{{ $package->id }}" onclick="chnageStatus({{ $package->id }})" class="badge badge-success px-2">
                                                        Active
                                                    </button>
                                                @else
                                                    <button id="status{{ $package->id }}" onclick="chnageStatus({{ $package->id }})" class="badge badge-danger px-2">
                                                        Inactive
                                                    </button>
                                                @endif
                                            </td>
                                            <td>{{ $package->package_order }}</td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($package->created_at)) }}
                                                {{-- {{ $package->created_at->diffForHumans() }} --}}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">

                                                    <a class="btn btn-primary btn-xs mr-2" href="{{ route('package.show', $package->id) }}">Details</a>

                                                    <a class="btn btn-info btn-xs mr-2" href="{{ route('package.edit', $package->id) }}">Edit</a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="basicModal{{ $package->id }}">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete package</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">Are you sure to delete <b>"{{ $package->package_title }}"</b> Sucategory? </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('package.destroy', $package->id) }}" method="POST">
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
                                                    <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#basicModal{{ $package->id }}">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Category</th>
                                        <th>package Name</th>
                                        <th>Status</th>
                                        <th>package Order</th>
                                        <th>Created Date</th>
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
    
@endsection

@section('custom_js')

    <script src="{{ asset('assets/backend/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>
    
    <script>
        function chnageStatus(package_id) {
            $(function() {
                var statusBtn = $(`#status${package_id}`);
                var statusText = statusBtn.text();
                $.ajax({
                    url: "{{ route('package.updateStatus') }}",
                    type: "POST",
                    data: {
                        package_id,
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