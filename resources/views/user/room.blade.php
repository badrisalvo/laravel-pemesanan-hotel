@extends('frontend.master')
@section('content')
 <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/16.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content text-center">
                    <h2 class="page-title">Our Rooms</h2>
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

<div class="roberto-rooms-area section-padding-100-0">
    <div class="container">

        <div class="row">
            @foreach($kamar as $room)
                <div class="single-room-area d-flex align-items-center mb-50 wow fadeInUp" data-wow-delay="100ms">
                    <div class="room-thumbnail">
                        <img src="{{ asset('images/' . $room->image) }}" alt="{{ $room->room_number }}" style=" height: 200px; width: 450px;">
                    </div>
                    <div class="room-content">
                        <h2>Kamar No. {{ $room->room_number }} - {{ $room->kategori->name }}</h2>
                        <h4>Rp. {{ number_format($room->harga, 0, ',', '.') }} <span>/ Hari</span></h4>
                        <h6>Kapasitas: <span>{{ $room->kapasitas }} orang</span></h6>
                        <div class="room-feature">
                            
                            <h6>Detail: <span>{{ $room->detail }}</span></h6>
                        </div>
                        <a href="{{ route('room.detail', $room->id) }}" class="btn view-detail-btn">Lihat Detail <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            @endforeach

            <nav class="roberto-pagination wow fadeInUp mb-100" data-wow-delay="1000ms">
                {{ $kamar->links() }}
            </nav>
        </div>
    </div>
</div>

<style>
    .room-thumbnail img {
        width: 100%;
        height: 200px; 
        object-fit: cover; 
        border-radius: 10px; 
    }
    .hotel-reservation--area {
        margin-bottom: 30px;
    }
    .form-group label {
        font-weight: bold;
    }
    .btn.roberto-btn {
        background-color: #28a745;
        border: none;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
    }
    .btn.roberto-btn:hover {
        background-color: #218838;
        color: #fff;
    }
    .flatpickr-input {
        border-radius: 5px;
        padding: 10px;
        border: 1px solid #ddd;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkInInput = flatpickr("#checkInDate", {
            minDate: "today",
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length > 0) {
                    const minCheckoutDate = new Date(selectedDates[0]);
                    minCheckoutDate.setDate(minCheckoutDate.getDate() + 1);
                    checkOutInput.set("minDate", minCheckoutDate);
                    checkOutInput.setDate(minCheckoutDate);
                }
            }
        });

        const checkOutInput = flatpickr("#checkOutDate", {
            minDate: new Date().fp_incr(1), 
            dateFormat: "Y-m-d"
        });
    });
</script>
@endsection
