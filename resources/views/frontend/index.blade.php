@extends('frontend.app')

@section('title', 'BrandStorm')

@section('content')

<section id="slider">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                <div class="card" style="width: 18rem; height: 450px">
                    <div class="card-header text-center">
                        Special Deal
                      </div>
                    <img width="100%" src="{{ asset('uploads/packages/'. $special_deal->package_image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <a href="{{ route('package.packageDetails', $special_deal->package_slug) }}"><h5 class="card-title">{{ $special_deal->package_title }}</h5></a>
                      <p class="card-text"><b>Description:</b> {!!  Str::of($special_deal->package_description)->limit(50) !!}</p>
                      <p class="card-text"><b>Subscription:</b> {{ $special_deal->subscription_type }}</p>
                      <p class="card-text"><b>Package Cost:</b> {{ $special_deal->package_cost }}$</p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" style="height: 450px;">
                      <div class="carousel-item active">
                        <img src="{{ asset('assets/frontend/images/Slider1.jpg') }}" class="d-block w-100" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="{{ asset('assets/frontend/images/Slider3.jpg') }}" class="d-block w-100" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="{{ asset('assets/frontend/images/Slider2.jpg') }}" class="d-block w-100" alt="...">
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
            </div>
        </div>
    </div>
</section>

<section id="packages">

    <div class="container mt-5 mb-5">
        <h2 class="text-center mb-4">Our Some Packages</h2>

        <div class="row">

            @foreach ($packages as $package)
                <div class="col-md-3">
                    <div class="card" style="width: 18rem; height: 450px">
                        <img height="100%" width="100%" src="{{ asset('uploads/packages/'. $package->package_image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                        <a href="{{ route('package.packageDetails', $package->package_slug) }}"><h5 class="card-title">{{ $package->package_title }}</h5></a>
                        <p class="card-text"><b>Description:</b> {!!  Str::of($package->package_description)->limit(50) !!}</p>
                        <p class="card-text"><b>Subscription:</b> {{ $package->subscription_type }}</p>
                        <p class="card-text"><b>Package Cost:</b> {{ $package->package_cost }}$</p>
                        </div>
                    </div>
                </div>
            @endforeach
    
        </div>

        <div class="text-center mt-4">
            <a href="#" class="btn btn-warning">For More Packages...</a>
        </div>
    </div>


</section>

@include('frontend.include._services')

@endsection