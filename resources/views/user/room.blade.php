@extends('frontend.master')
@section('content')
 <!-- Breadcrumb Area Start -->
 <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/16.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content text-center">
                    <h2 class="page-title">Kamar Kami</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kamar</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->

<!-- Rooms Area Start -->
<div class="roberto-rooms-area section-padding-100-0">
        <div class="container">
            <div class="row">
                @foreach($kamar as $room)
                    <!-- Single Room Area -->
                    <div class="single-room-area d-flex align-items-center mb-50 wow fadeInUp" data-wow-delay="100ms">
                        <!-- Room Thumbnail -->
                        <div class="room-thumbnail">
                            <img src="{{ asset('images/' . $room->image) }}" alt="{{ $room->room_number }}">
                        </div>
                        <!-- Room Content -->
                        <div class="room-content">
                            <h2>Kamar No. {{ $room->room_number }}</h2>
                            <h4>Rp. {{ $room->harga }} <span>/ Hari</span></h4>
                            <div class="room-feature">
                                <h6>Kapasitas: <span>Maksimal {{ $room->kapasitas }} orang</span></h6>
                                <h6>Fasilitas: <span>{{ $room->detail }}</span></h6>
                            </div>
                            <a href="{{ route('room.detail', $room->id) }}" class="btn view-detail-btn">Lihat Detail <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                @endforeach



                <!-- Pagination -->
                <nav class="roberto-pagination wow fadeInUp mb-100" data-wow-delay="1000ms">
                    {{ $kamar->links() }}
                </nav>
            </div>

            <div class="col-12 col-lg-4">
                <!-- Hotel Reservation Area -->
                <div class="hotel-reservation--area mb-100">
                    <form action="{{ route('checkAvailability') }}" method="post">
                        @csrf
                        <div class="form-group mb-30">
                            <label for="checkInDate">Tanggal</label>
                            <div class="input-daterange" id="datepicker">
                                <div class="row no-gutters">
                                    <div class="col-6">
                                        <input type="text" class="input-small form-control" id="checkInDate" name="check_in" placeholder="Check In" required>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="input-small form-control" name="check_out" placeholder="Check Out" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn roberto-btn w-100">Cek Ketersediaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
