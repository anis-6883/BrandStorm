@extends('frontend.app')

@section('title', 'Package Details')

@section('content')
    
    <section id="package_details">
        <div class="conatiner mt-5 mb-5">
            <div class="row">
                <div class="col-md-8 m-auto">
                    <div class="card">
                        <div class="card-header text-center">
                          Package Details Information
                        </div>
                        <img height="100%" width="100%" src="{{ asset('uploads/packages/'. $package->package_image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">{{ $package->package_title }}</h5>
                          <p class="card-text">
                            <b>Description: </b>
                           {!! $package->package_description !!}
                          </p>
                          <p class="card-text"><b>Subscription:</b> {{ $package->subscription_type }}</p>
                          <p class="card-text"><b>Package Cost:</b> {{ $package->package_cost }}$</p>
    
                          <form action="{{ route('package.proceedToOrder', $package->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-primary">Proceed To Order</button>
                          </form>

                        </div>
                        <div class="card-footer text-muted text-center">
                          Package Details Information
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.include._services')

@endsection