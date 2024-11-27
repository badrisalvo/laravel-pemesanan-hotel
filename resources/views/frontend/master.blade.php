<!DOCTYPE html>
<html lang="en">
@include('frontend.head')
<body>
    <div class="wrapper">
        <div class="main-panel">
            <div class="content">
                @yield('content')
            </div>
            @include('frontend.footer')
        </div>
    </div>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- **** All JS Files ***** -->
    <!-- jQuery 2.2.4 -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Popper -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- All Plugins -->
    <script src="{{ asset('js/roberto.bundle.js') }}"></script>
    <!-- Active -->
    <script src="{{ asset('js/default-assets/active.js') }}"></script>
    <!-- Add this in your frontend.master file within the <head> tag -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>



</body>
</html>
