@extends('frontend.master')

@section('content')
    <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url({{ asset('images/' . $kamar->image) }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="page-title">Room No. {{ $kamar->room_number }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('user.room') }}">Kamar</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $kamar->room_number }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

    <!-- Room Details Area Start -->
    <div class="room-details-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="room-details-thumbnail">
                        <img src="{{ asset('images/' . $kamar->image) }}" alt="{{ $kamar->room_number }}">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="room-details-content">
                        <h2>Room No.{{ $kamar->room_number }}</h2>
                        <h4>Rp. {{ number_format($kamar->harga, 0, ',', '.') }} <span>/ Hari</span></h4>
                        <p>{{ $kamar->detail }}</p>
                        <div class="room-feature">
                            <h6>Kapasitas: <span>Maksimal {{ $kamar->kapasitas }} orang</span></h6>
                        </div>
                        <a href="{{ route('booking.createPayment', ['kamar_id' => $kamar->id]) }}" class="btn roberto-btn">Pesan Sekarang</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
@endsection
