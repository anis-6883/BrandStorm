<!DOCTYPE html>
<html lang="en-US">

@include('frontend.include._head')

<body>
    
    @include('frontend.include._topnav')

    @yield('content')

    @include('frontend.include._footer')
    
</body>
</html>