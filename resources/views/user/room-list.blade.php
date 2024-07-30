@extends('frontend.master')

@section('content')


<!-- Rooms Area Start -->
<div class="roberto-rooms-area section-padding-100-0">
    <div class="container">
        <!-- Display Selected Dates -->
        <div class="mb-4">
            @php
                // Format dates to "d F Y"
                $formattedCheckInDate = $checkInDate->format('d F Y');
                $formattedCheckOutDate = $checkOutDate->format('d F Y');
            @endphp
            <h5>Kamar Tersedia dari {{ $formattedCheckInDate }} hingga {{ $formattedCheckOutDate }}</h5>
        </div>

        <div class="row">
            @forelse($kamar as $room)
            <!-- Single Room Area -->
            <div class="col-12 mb-4">
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
            </div>
            @empty
            <p>Tidak ada kamar tersedia pada tanggal yang dipilih.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <nav class="roberto-pagination wow fadeInUp mb-100" data-wow-delay="1000ms">
            {{ $kamar->links() }}
        </nav>
    </div>
</div>
<!-- Rooms Area End -->

@endsection
