@extends('frontend.app')

@section('title', 'Ordered Package')

@section('content')
    
    <section id="package_details">
        <div class="conatiner mt-5 mb-5">
            <div class="row">
                <div class="col-md-8 m-auto">
                    <div class="card">
                        <div class="card-header text-center">
                          Ordered Package Information
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">{{ $order->package->package_title }}</h5>
                          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                          <p class="card-text"><b>Subscription:</b> {{ $order->package->subscription_type }}</p>
                          <p class="card-text"><b>Package Cost:</b> {{ $order->package->package_cost }}$</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal">
                            Confirm Order
                          </button>
                          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            Delete Order
                          </button>
                          

                        </div>
                        <div class="card-footer text-muted text-center">
                            Ordered Package Information
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </section>

      <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm Message</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure to confirm the "{{ $order->package->package_title }}" package order?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Not Yet!</button>
            <form action="{{ route('package.confirmOrder', $order->id) }}" method="POST">
                @csrf
                @method('POST')
                <button type="submit" class="btn btn-primary">Confirm Order!</button>
            </form>
            </div>
        </div>
        </div>
    </div>

      <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm Message</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you want to delete the "{{ $order->package->package_title }}" package order?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Not Yet!</button>
            <form action="{{ route('package.deleteOrder', $order->id) }}" method="POST">
                @csrf
                @method('POST')
                <button type="submit" class="btn btn-danger">Delete Order!</button>
            </form>
            </div>
        </div>
        </div>
    </div>

    @include('frontend.include._services')

@endsection