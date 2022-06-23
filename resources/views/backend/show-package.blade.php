@extends('backend.master')

@section('title', 'Show Package Details')

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
                <li class="breadcrumb-item active"><a href="{{ route('package.index') }}">Show Package</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Show Package</h4>
                        <a class="btn btn-info ml-4 mt-4" href="{{ route('package.edit', $package->id) }}">Edit Package</a>
                        <div class="table-responsive mt-3">
                            <table class="table table-striped table-bordered zero-configuration">

                                <tbody>
                                    
                                    <tr>
                                        <th style="color: blue">Attribute</th>
                                        <th style="color: blue">Value</th>
                                    </tr>
                                    <tr>
                                        <th>Package ID</th>
                                        <td>{{ $package->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Category</th>
                                        <td>{{ $package->subcategory->category->category_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Subcategory</th>
                                        <td>{{ $package->subcategory->subcategory_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Package Title</th>
                                        <td>{{ $package->package_title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Package Slug</th>
                                        <td>{{ $package->package_slug }}</td>
                                    </tr>
                                    <tr>
                                        <th>Package Order</th>
                                        <td>{{ $package->package_order ?: 'NULL' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Package Summary</th>
                                        <td>{!! $package->package_summary ?: 'NULL' !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Package Description</th>
                                        <td>{!! $package->package_description ?: 'NULL' !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Package Image</th>
                                        <td>
                                            @if ($package->package_image != null)
                                                <img id="master_img" src="{{ asset('uploads/packages/' . $package->package_image) }}" alt="No Image" width="80px" height="80px">  
                                            @else
                                                <img id="master_img" src="{{ asset('assets/backend/images/no-image.png') }}" alt="No Image" width="80px" height="80px">
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Package Cost</th>
                                        <td>{{ $package->package_cost }}$</td>
                                    </tr>
                                    <tr>
                                        <th>Package Subscription Type</th>
                                        <td>{{ $package->subscription_type ?: 'NULL' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Package Discount Price</th>
                                        <td>{{ $package->package_discount_pct ?: 'NULL' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Discount Start Date</th>
                                        <td>{{ $package->discount_start_date ?: 'NULL' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Discount End Date</th>
                                        <td>{{ $package->discount_end_date ?: 'NULL' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Duration Hour</th>
                                        <td>{{ $package->duration_hour ?: 'NULL' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Reach Head</th>
                                        <td>{{ $package->reach_head ?: 'NULL' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Print Ad Size</th>
                                        <td>{{ $package->print_ad_size ?: 'NULL' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bill Board Location</th>
                                        <td>{{ $package->billboard_location ?: 'NULL' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Video Length</th>
                                        <td>{{ $package->video_length ?: 'NULL' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Package Status</th>
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
                                    </tr>
                                    <tr>
                                        <th>Created At</th>
                                        <td>
                                            {{ date('d-m-Y', strtotime($package->created_at)) }}
                                            {{-- {{ $package->created_at->diffForHumans() }} --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Updated At</th>
                                        <td>{{ date('d-m-Y', strtotime($package->updated_at)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom_js')
    
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