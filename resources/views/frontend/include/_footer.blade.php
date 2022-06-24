<section id="contact_us" style="background: #f8f9fa; padding: 50px;">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <p><b>Contact Us:</b></p>
                <p>Email: contact@brandstorm.com</p>
                <p>Phone: +88-0175-974-****</p>
            </div>
            <div class="col-md-4">
                <p><b>Services:</b></p>
                <p>Digital Marketing</p>
                <p>Social Media Marketing</p>
                <p>SEO Marketing</p>
                <p>Print Media Marketing</p>
            </div>
            <div class="col-md-4">
                <p><b>Subscribe for Updates:</b></p>
                <div class="mb-3">
                    <input type="email" class="form-control" id="subscription" placeholder="name@example.com">
                  </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('assets/frontend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/sweetalert2@11.js') }}"></script>

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })


    @if (session()->has('success'))
        Toast.fire({
        icon: 'success',
        title: '{{ session('success') }}'
        })
    @endif

    @if (session()->has('error'))
        Toast.fire({
        icon: 'error',
        title: '{{ session('error') }}'
        })
    @endif

    @if (session()->has('warning'))
        Toast.fire({
        icon: 'warning',
        title: '{{ session('warning') }}'
        })
    @endif
    
</script>

@yield('custom_js')