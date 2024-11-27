@extends('frontend.master')

@section('content')
<style>
.room-details-thumbnail img {
    border-radius: 15px; /* Menambahkan sudut melengkung pada gambar */
    width: 100%; /* Memastikan gambar mengambil lebar penuh kontainer */
    height: auto; /* Menjaga proporsi gambar */
}

</style>
    <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url({{ asset('images/' . $kamar->image) }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="page-title">Room No. {{ $kamar->room_number }} - {{ $kamar->kategori->name }}</h2>
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
                        <h2>Room No. {{ $kamar->room_number }} - {{ $kamar->kategori->name }}</h2>
                        <h4>Rp. {{ number_format($kamar->harga, 0, ',', '.') }} <span>/ Hari</span></h4>
                        
                        <h6>Kapasitas: <span>{{ $kamar->kapasitas }} orang</span></h6>
                        <div class="room-feature">
                            <p>Detail : {{ $kamar->detail }}</p>
                        </div>
                        @auth
                            <a href="{{ route('checkAvailability') }}" class="btn roberto-btn btn-primary">Cek Ketersediaan Kamar</a>
                        @else
                            <p> Silahkan Login Untuk Memesan</p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
@endsection

@section('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var loginModal = document.getElementById('loginModal');
            var loginBtn = document.getElementById('loginBtn');
            var loginClose = document.getElementById('loginClose');

            // Open login modal if login button is clicked
            loginBtn.onclick = function() {
                loginModal.style.display = "block";
            }

            // Close login modal
            loginClose.onclick = function() {
                loginModal.style.display = "none";
            }

            // Close modal if clicked outside
            window.onclick = function(event) {
                if (event.target == loginModal) {
                    loginModal.style.display = "none";
                }
            }
        });
    </script>
@endsection
