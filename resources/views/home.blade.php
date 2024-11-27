
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
.date-input {
        position: relative;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .date-input:focus {
        border-color: #28a745; /* Green border */
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25); /* Green shadow */
        outline: 0;
    }

    </style>
       <!-- Welcome Area Start -->
      
    <section class="welcome-area">
        <div class="welcome-slides owl-carousel">
            <!-- Single Welcome Slide -->
            @foreach($recentRoomsViews as $room)
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
                                    <a href="{{ route('room.detail', $room->id) }}" class="btn roberto-btn btn-primary" data-animation="fadeInLeft" data-delay="200ms">Booking Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
</section>
            
    <!-- Welcome Area End -->

    <section class="roberto-about-area section-padding-100-0">  
    <div class="hotel-search-form-area">
        <div class="container-fluid">
            <div class="hotel-search-form">
                <form action="{{ route('checkAvailability') }}" method="GET">
                    <div class="row justify-content-between align-items-end">
                        <div class="col-6 col-md-2 col-lg-3">
                            <label for="checkin_date">Check In</label>
                            <input type="date" class="form-control date-input" id="checkin_date" name="checkin_date" required>
                        </div>
                        <div class="col-6 col-md-2 col-lg-3">
                            <label for="checkout_date">Check Out</label>
                            <input type="date" class="form-control date-input" id="checkout_date" name="checkout_date" required>
                        </div>
                        <div class="col-12 col-md-3">
                            <button type="submit" class="form-control btn btn-primary w-100">Periksa Ketersediaan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="container mt-100">
    <div class="row align-items-center">
        <div class="col-12 col-lg-6 mb-100">
            <div class="section-heading wow fadeInUp" data-wow-delay="50ms">
                <h6>About Us</h6>
            @if($abouts && $abouts->isNotEmpty())
                @if ($Home1 = $abouts->where('title', 'Home1')->first())
                <h2>{{ $Home1->description }}</h2>
                @endif
            </div>
            <div class="about-us-content">
                @if ($Home2 = $abouts->where('title', 'Home2')->first())
                <h5 class="wow fadeInUp" data-wow-delay="150ms">
                {{ $Home2->description }}</h5>
                @endif
                <img src="img/core-img/signature.png" alt="Signature" class="wow fadeInUp" data-wow-delay="250ms">
            </div>
            @else
                <p>No Data available.</p>
            @endif
        </div>
        <div class="col-12 col-lg-6 mb-100">
            <div class="about-us-thumbnail wow fadeInUp" data-wow-delay="300ms">
                <div class="row no-gutters">
                    @if($recentRooms && count($recentRooms) > 0)
                        @foreach($recentRooms as $room)
                        <div class="col-6">
                            <div class="single-thumb mb-2">
                                <img src="{{ asset('images/' . $room->image) }}" alt="{{ $room->room_number }}">
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <p>No recent rooms available</p>
                        </div>
                    @endif
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
                    <h2 data-animation="fadeInUp" data-delay="100ms">Room No.{{ $room->room_number }} - {{ $room->kategori->name }}</h2>
                    <h3 data-animation="fadeInUp" data-delay="100ms">Rp. {{ number_format($room->harga, 0, ',', '.') }} <span>/ Hari</span></h3>
                    <ul class="room-feature" data-animation="fadeInUp" data-delay="100ms">
                        <li><span><i class="fa fa-check"></i> Kapasitas</span> <span>: Maksimal {{ $room->kapasitas }} orang</span></li>
                        <li><span><i class="fa fa-check"></i> Details</span> <span>: {{ $room->detail }}</span></li>
                        <li><span><i class="fa fa-check"></i> Kategori</span> <span>: {{ $room->kategori->name }}</span></li>
                    </ul>
                    <a href="{{ route('room.detail', $room->id) }}" class="btn btn-success" data-animation="fadeInUp" data-delay="150ms">Lihat Detail</a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!-- Our Room Area End -->
     <br>
<br>

</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkInInput = document.getElementById('checkin_date');
        const checkOutInput = document.getElementById('checkout_date');

        // Set the minimum check-in date to today
        const today = new Date().toISOString().split('T')[0];
        checkInInput.setAttribute('min', today);

        checkInInput.addEventListener('change', function() {
            const checkInDate = new Date(this.value);
            checkInDate.setDate(checkInDate.getDate() + 1);
            const minCheckOutDate = checkInDate.toISOString().split('T')[0];
            checkOutInput.setAttribute('min', minCheckOutDate);
        });
    });
</script>
</html>
@endsection