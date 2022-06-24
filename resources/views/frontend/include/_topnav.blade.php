@php
    $categories = App\Models\Category::where('category_status', 'Active')->orderBy('category_order')->get();
@endphp


<section id="top-nav">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/backend/images/BrandStorm.png') }}" alt="" width="150px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#packages" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Packages
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($categories as $category)
                            <li><a class="dropdown-item" href="#">{{ $category->category_name }}</a></li>   
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#contact_us">Contact Us</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('package.orderedPackage') }}">Ordered</a>
                </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#packages" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Account
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a href="{{ route('user.myOrders') }}" class="dropdown-item">My Orders</a></li>
                                <li>
                                    <form action="{{ route('user.logout') }}" method="POST">
                                    @csrf
                                        <button class="dropdown-item">Logout</button>
                                    </form>
                                </li>   
                        </ul>
                    </li>

                @else
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('user.login') }}">Login</a>
                    </li>
                @endauth
                
                
            </ul>
        </div>
        </div>
    </nav>
</section>