<!DOCTYPE html>
<html lang="en-US">

@include('backend.include._head')

<body>

    <!--*******************
        Preloader start
    ********************-->
	
    @include('backend.include._preloader')
	
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header Icon
        ***********************************-->
        @include('backend.include._nav-header-icon')
        <!--**********************************
            Nav header Icon End
        ***********************************-->

        <!--**********************************
            Top Nav start
        ***********************************-->
        @include('backend.include._top-nav')
        <!--**********************************
            Top Nav End
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('backend.include._sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            @yield('content')
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        @include('backend.include._footer')
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
   @include('backend.include._scripts')

</body>

</html>