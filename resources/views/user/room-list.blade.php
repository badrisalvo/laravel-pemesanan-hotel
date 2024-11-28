@extends('frontend.master')

@section('content')
<div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/16.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content text-center">
                    <h2 class="page-title">Available Rooms</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Room</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

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


    <div class="roberto-rooms-area section-padding-100-0">
        <div class="container">
            @if($checkInDate && $checkOutDate)
                <div class="mb-4">
                    @php
                        $formattedCheckInDate = \Carbon\Carbon::parse($checkInDate)->format('d F Y');
                        $formattedCheckOutDate = \Carbon\Carbon::parse($checkOutDate)->format('d F Y');
                    @endphp
                    <h5>Kamar Tersedia dari {{ $formattedCheckInDate }} hingga {{ $formattedCheckOutDate }}</h5>
                </div>

                <div class="row">
                    @forelse($kamar as $room)
                    <div class="single-room-area d-flex align-items-center mb-50 wow fadeInUp" data-wow-delay="100ms">
                            <div class="room-thumbnail">
                                <img src="{{ asset('images/' . $room->image) }}" alt="{{ $room->room_number }}" style=" height: 200px; width: 450px;">
                            </div>
                            <div class="room-content">
                                <h3>Kamar No. {{ $room->room_number }} - {{ $room->kategori->name }} </h3>
                                <h4>Rp. {{ number_format($room->harga, 0, ',', '.') }} <span>/ Hari</span></h4>
                                <h6>Kapasitas: <span> {{ $room->kapasitas }} orang</span></h6>
                                <div class="room-feature">
                                    <h6>Fasilitas: <span>{{ $room->detail }}</span></h6>
                                </div>
                                @auth
                                <a href="{{ route('booking.createPayment', ['kamar_id' => $room->id, 'check_in' => \Carbon\Carbon::parse($checkInDate)->format('Y-m-d'), 'check_out' => \Carbon\Carbon::parse($checkOutDate)->format('Y-m-d')]) }}" class="btn roberto-btn btn-primary">Pesan Sekarang</a>
                                @else
                                <p>Silahkan Login Untuk Melakukan Booking</p>
                                @endauth
                            </div>
                        </div>

                    @empty
                        <p>Tidak ada kamar tersedia pada tanggal yang dipilih.</p>
                    @endforelse
                </div>
                <nav class="roberto-pagination wow fadeInUp mb-100" data-wow-delay="1000ms">
                    {{ $kamar->links() }}
                </nav>
            @else
                <p>Silakan pilih tanggal check-in dan check-out untuk melihat kamar yang tersedia.</p>
            @endif
        </div>
    </div>
</section>

@endsection

<style>
   .room-thumbnail img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
}


</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkInInput = document.getElementById('checkin_date');
        const checkOutInput = document.getElementById('checkout_date');

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
