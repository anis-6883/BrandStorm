@extends('frontend.app')

@section('title', 'My Order List')

@section('content')
    
    <section id="package_details">
        <div class="conatiner mt-5 mb-5">
            <div class="row">
                <div class="col-md-8 m-auto">
                    <h3>Your Order List:</h3>
                    @foreach ($orders as $order)
                    <div class="card mb-3">
                        <div class="card-header">
                          Order Serial: {{ $loop->iteration }}
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">{{ $order->package->package_title }}</h5>
                          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                          <p class="card-text"><b>Subscription:</b> {{ $order->package->subscription_type }}</p>
                          <p class="card-text"><b>Package Cost:</b> {{ $order->package->package_cost }}$</p>
                        </div>
                        <div class="card-footer text-muted">
                            Time: {{ $order->package->created_at->diffForHumans() }}
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </section>

    @include('frontend.include._services')

@endsection