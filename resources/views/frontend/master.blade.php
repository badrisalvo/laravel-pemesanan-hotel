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
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/roberto.bundle.js') }}"></script>
    <script src="{{ asset('js/default-assets/active.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>



</body>
</html>
