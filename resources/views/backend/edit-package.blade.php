@extends('backend.master')

@section('title', 'Edit A Package')

@section('custom_css')
    <!-- jqueryui date picker -->
    <link rel="stylesheet" href="{{asset('assets/backend/css/jquery-ui.css') }}">
    <!-- Rich Text Editor -->
    <!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
    <script src="{{ asset('assets/backend/js/richTextEditor/tinyRTE.js') }}"></script>
@endsection

@section('content')

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('package.index') }}">Manage Package</a></li>
                <li class="breadcrumb-item active">Edit Package</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Edit A Package</h4>
                        <div class="basic-form">
                            <form action="{{ route('package.update', $package->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="col-md-6">
                                        <label class="col-form-label">Category</label>
                                        <div class="mb-4">
                                            <select name="category_id" class="custom-select mr-sm-2" id="select_category" required>
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @if ($category->id == $package->subcategory->category->id) {{ "selected" }} @endif>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="col-form-label">Subcategory</label>
                                        <div class="mb-4">
                                            <select name="subcategory_id" class="custom-select mr-sm-2" id="select_subcategory" required></select>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label">Package Title</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="package_title" 
                                            class="form-control @error('package_title') is-invalid @enderror"  
                                            required autofocus autocomplete="off"
                                            value="{{ $package->package_title }}">

                                        <div class="invalid-feedback">
                                            @error('package_title')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Package Summary</label>
                                    <div class="col-sm-10 mb-4">
                                        <textarea name="package_summary" id="richTextEditor1">{{ $package->package_summary }}</textarea>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Package Description</label>
                                    <div class="col-sm-10 mb-4">
                                        <textarea name="package_description" id="richTextEditor2">{{ $package->package_description }}</textarea>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Package Cost</label>
                                    <div class="col-sm-10 mb-4">
                                        <input type="number" name="package_cost" class="form-control input-default" required autocomplete="off" value="{{ $package->package_cost }}">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Subscription Type</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="subscription_type" class="custom-select mr-sm-2" id="subscription_type" required>
                                            <option {{ $package->subscription_type == "Daily" ? "selected": "" }}>Daily</option>
                                            <option {{ $package->subscription_type == "Weekly" ? "selected": "" }}>Weekly</option>
                                            <option {{ $package->subscription_type == "Monthly" ? "selected": "" }}>Monthly</option>
                                            <option {{ $package->subscription_type == "Yearly" ? "selected": "" }}>Yearly</option>
                                        </select>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Preview</label>
                                    <div class="col-sm-10 mb-4">
                                        <td>@if ($package->package_image != null)
                                            <img 
                                            id="master_img" 
                                            src="{{ asset('uploads/packages/' . $package->package_image) }}" 
                                            alt="No Image" width="100px" height="100px">
                                        @else
                                            <img id="master_img" src="{{ asset('assets/backend/images/no-image.png') }}" 
                                            alt="No Image" width="100px" height="100px">
                                        @endif
                                        </td>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Package Image</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="file" 
                                            onchange="loadFile(event)" 
                                            name="package_image" 
                                            class="form-control input-default @error('package_image') is-invalid @enderror">

                                        <div class="invalid-feedback">
                                            @error('package_image')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Discount Percentage</label>
                                    <div class="col-sm-10 mb-4">
                                        <input type="number" name="package_discount_pct" class="form-control input-default" autocomplete="off" value="{{ $package->package_discount_pct }}">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Discount Start On</label>
                                    <div class="col-sm-10 mb-4">
                                        <input class="form-control input-default jqdatepicker" id="discount_start_date" name="discount_start_date" type="text" autocomplete="off" value="{{ $package->discount_start_date }}"/>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Discount Ends On</label>
                                    <div class="col-sm-10 mb-4">
                                        <input class="form-control input-default jqdatepicker" id="discount_end_date" name="discount_end_date" type="text" autocomplete="off" value="{{ $package->discount_end_date }}"/>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Duration Hour</label>
                                    <div class="col-sm-10 mb-4">
                                        <input type="number" name="duration_hour" class="form-control input-default" autocomplete="off" value="{{ $package->duration_hour }}">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Reach Head</label>
                                    <div class="col-sm-10 mb-4">
                                        <input type="number" name="reach_head" class="form-control input-default" autocomplete="off" value="{{ $package->reach_head }}">
                                    </div>
                                                
                                    

                                    <label class="col-sm-2 col-form-label">Print Ad Size</label>
                                    <div class="col-sm-10 mb-4">
                                        <input type="text" name="print_ad_size" class="form-control" value="{{ $package->print_ad_size }}">
                                        <div class="invalid-feedback">
                                            @error('print_ad_size')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Bill Board Location</label>
                                    <div class="col-sm-10 mb-4">
                                        <input type="text" name="billboard_location" class="form-control" value="{{ $package->billboard_location }}">
                                        <div class="invalid-feedback">
                                            @error('billboard_location')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Video Length</label>
                                    <div class="col-sm-10 mb-4">
                                        <input type="text" name="video_length" class="form-control" value="{{ $package->video_length }}">
                                        <div class="invalid-feedback">
                                            @error('video_length')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Package Order</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="number" 
                                            name="package_order" 
                                            class="form-control" 
                                            autocomplete="off"
                                            value="{{ $package->package_order }}">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="package_status" class="custom-select mr-sm-2" id="package_status">
                                            <option {{ $package->package_status == "Active" ? "selected": "" }}>Active</option>
                                            <option {{ $package->package_status == "Inactive" ? "selected": "" }}>Inactive</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button name="save_package" type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom_js')
    <script>
        $(function() {

            // ------------ ON PAGE LOAD GET CATEGORY ID AND LOAD SELETED SUBCATEGORY ------------ //
            var cat_id = $("#select_category").val();

            if (cat_id != "") {
                $.ajax({
                    url: "{{ route('package.loadSeletedSubcategory') }}",
                    type: "POST",
                    data: {
                        category_id: cat_id,
                        subcategory_id: "{{ $package->subcategory_id }}",
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response) {
                            $("#select_subcategory").html(response);
                        } else {
                            $("#select_subcategory").html("<option value=''>No Subcategory Found</option>");

                        }
                    }
                })
            }

            // ------------ WHEN CHANGE THE CATEGORY | LOAD SUBCATEGORY ------------ //
            $("#select_category").change(function() {

                let cat_id = $(this).val();
                if (cat_id != "") {
                    $.ajax({
                        url: "{{ route('package.loadSubcategory') }}",
                        type: "POST",
                        data: {
                            category_id: cat_id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response) {
                                $("#select_subcategory").html(response);
                            } else {
                                $("#select_subcategory").html("<option value=''>No Subcategory Found</option>");
                            }
                        }
                    })
                }
                else{
                    $("#select_subcategory").html("<option value=''>Select Category</option>");
                }
            })

        });

    </script>

    <script>
        var loadFile = function(event) {
            var output = document.getElementById('master_img');
            output.parentElement.classList.add("mb-4")
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>

    <script>
        tinymce.init({
        selector: '#richTextEditor1',
        // plugins: [ 'quickbars' ],
        plugins: 'lists advlist autolink link table image charmap print preview hr anchor pagebreak insertdatetime media searchreplace wordcount',
        toolbar: 'numlist bullist link table image charmap print preview hr anchor pagebreak insertdatetime media searchreplace wordcount'
        });
        tinymce.init({
            selector: '#richTextEditor2',
            // plugins: [ 'quickbars' ],
            plugins: 'lists advlist autolink link table image charmap print preview hr anchor pagebreak insertdatetime media searchreplace wordcount',
            toolbar: 'numlist bullist link table image charmap print preview hr anchor pagebreak insertdatetime media searchreplace wordcount'
        });
    </script>

    <!-- jqueryui date picker -->
    <script src="{{ asset('assets/backend/js/jquery-ui.js') }}"></script>

    <!-- jqueryui date picker -->
    <script>
    $( function() {
    $( ".jqdatepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            yearRange: '2000:2025'
        });
    });
    </script>
@endsection