
@extends('frontend.master')

@section('content')
<style>
@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

[data-animation="fadeInUp"] {
    animation-name: fadeInUp;
    animation-duration: 2s;
    animation-timing-function: ease-out;
    animation-fill-mode: forwards;
    opacity: 0; /* Initial state */
}
    </style>
       <!-- Welcome Area Start -->
      
    <section class="welcome-area">
        <div class="welcome-slides owl-carousel">
            <!-- Single Welcome Slide -->
            @foreach($recentRooms as $room)
            <div class="single-welcome-slide bg-img bg-overlay" style="background-image: url({{ asset('images/' . $room->image) }});" data-img-url="{{ asset('images/' . $room->image) }}">
                <!-- Welcome Content -->
                <div class="welcome-content h-100">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <!-- Welcome Text -->
                            <div class="col-12">
                                <div class="welcome-text text-center">
                                    <h6 data-animation="fadeInLeft" data-delay="200ms">Hotel &amp; Resort</h6>
                                    <h2 data-animation="fadeInLeft" data-delay="200ms">Welcome To Persamaan</h2>
                                    <a href="{{ route('room.detail', $room->id) }}" class="btn roberto-btn btn-2" data-animation="fadeInLeft" data-delay="200ms">Discover Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>@endforeach
        </div>
    </div>
            
    <!-- Welcome Area End -->

    <section class="hotel-search-form-area section-padding-100-0">
    <div class="container-fluid">
        <div class="hotel-search-form">
            <form action="{{ route('checkAvailability') }}" method="post">
                @csrf
                <div class="row justify-content-between align-items-end">
                    <div class="col-6 col-md-2 col-lg-3">
                        <label for="checkin_date">Check In</label>
                        <input type="date" class="form-control" id="checkin_date" name="checkin_date" required>
                    </div>
                    <div class="col-6 col-md-2 col-lg-3">
                        <label for="checkout_date">Check Out</label>
                        <input type="date" class="form-control" id="checkout_date" name="checkout_date" required>
                    </div>
                    <div class="col-12 col-md-3">
                        <button type="submit" class="form-control btn roberto-btn w-100">Periksa Ketersediaan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>


<section class="about-us-area section-padding-100-0">
    <div class="container mt-100">
        <div class="row align-items-center">
            <div class="col-12 col-lg-6 mb-100">
                <!-- Section Heading -->
                <div class="section-heading wow fadeInUp" data-wow-delay="50ms">
                    <h6>About Us</h6>
                    <h2>Welcome to <br>Persamaan Hotel</h2>
                </div>
                <div class="about-us-content">
                    <h5 class="wow fadeInUp" data-wow-delay="150ms">With over 340 hotels worldwide, NH Hotel Group offers a wide variety of hotels catering for a perfect stay no matter where your destination.</h5>
                    <p class="wow fadeInUp" data-wow-delay="200ms">Manager: <span>Michen Taylor</span></p>
                    <img src="img/core-img/signature.png" alt="" class="wow fadeInUp" data-wow-delay="250ms">
                </div>
            </div>

            <div class="col-12 col-lg-6 mb-100">
                <div class="about-us-thumbnail wow fadeInUp" data-wow-delay="300ms">
                    <div class="row no-gutters">
                        @foreach($recentRooms as $room)
                            <div class="col-6">
                                <div class="single-thumb mb-2">
                                    <img src="{{ asset('images/' . $room->image) }}" alt="{{ $room->room_number }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- About Us Area End -->

    <!-- Service Area Start -->
    <div class="roberto-service-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="service-content d-flex align-items-center justify-content-between">
                        <!-- Single Service Area -->
                        <div class="single-service--area mb-100 wow fadeInUp" data-wow-delay="100ms">
                            <img src="img/core-img/icon-1.png" alt="">
                            <h5>Transportion</h5>
                        </div>

                        <!-- Single Service Area -->
                        <div class="single-service--area mb-100 wow fadeInUp" data-wow-delay="300ms">
                            <img src="img/core-img/icon-2.png" alt="">
                            <h5>Reiseservice</h5>
                        </div>

                        <!-- Single Service Area -->
                        <div class="single-service--area mb-100 wow fadeInUp" data-wow-delay="500ms">
                            <img src="img/core-img/icon-3.png" alt="">
                            <h5>Spa Relaxtion</h5>
                        </div>

                        <!-- Single Service Area -->
                        <div class="single-service--area mb-100 wow fadeInUp" data-wow-delay="700ms">
                            <img src="img/core-img/icon-4.png" alt="">
                            <h5>Restaurant</h5>
                        </div>

                        <!-- Single Service Area -->
                        <div class="single-service--area mb-100 wow fadeInUp" data-wow-delay="900ms">
                            <img src="img/core-img/icon-1.png" alt="">
                            <h5>Bar &amp; Drink</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service Area End -->

    <!-- Our Room Area Start -->
    <section class="roberto-rooms-area">
        <div class="rooms-slides owl-carousel">
            @foreach($kamar as $room)
            <div class="single-room-slide d-flex align-items-center">
                <!-- Thumbnail -->
                <div class="room-thumbnail h-100 bg-img" style="background-image: url('{{ asset('images/' . $room->image) }}');"></div>
                <!-- Content -->
                <div class="room-content">

                <h2 style="color: white; transform: translateY(-80px);">Persamaan Hotel & Resort</h2>
                    <h2 data-animation="fadeInUp" data-delay="100ms">Room No.{{ $room->room_number }}</h2>
                    <h3 data-animation="fadeInUp" data-delay="100ms">Rp. {{ $room->harga }} <span>/ Hari</span></h3>
                    <ul class="room-feature" data-animation="fadeInUp" data-delay="100ms">
                        <li><span><i class="fa fa-check"></i> Kapasitas</span> <span>: Maksimal {{ $room->kapasitas }} orang</span></li>
                        <li><span><i class="fa fa-check"></i> Details</span> <span>: {{ $room->detail }}</span></li>
                    </ul>
                    <a href="{{ route('room.detail', $room->id) }}" class="btn roberto-btn mt-30" data-animation="fadeInUp" data-delay="150ms">Lihat Detail</a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!-- Our Room Area End -->
     <br>
<br>

</body>

</html>
@endsection