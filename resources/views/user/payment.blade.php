@extends('frontend.master')

@section('content')
    <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/16.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="page-title">Booking Payment</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

    <!-- Payment Details Area Start -->
    <div class="payment-details-area section-padding-100-0">
        <div class="container">
            <h2>Detail Pemesanan</h2>
            <form action="{{ route('booking.storePayment', ['kamar_id' => $kamar->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="kamar_id" value="{{ $kamar->id }}">

                <div class="form-group">
                    <label for="check_in">Tanggal Check-In</label>
                    <input type="text" name="check_in" id="check_in" class="form-control" 
                           value="{{ request('check_in') }}" readonly>
                </div>

                <div class="form-group">
                    <label for="check_out">Tanggal Check-Out</label>
                    <input type="text" name="check_out" id="check_out" class="form-control" 
                           value="{{ request('check_out') }}" readonly>
                </div>

                <div class="form-group">
                    <label for="total_price">Total Harga</label>
                    <input type="text" id="total_price" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="bukti_bayar">Upload Bukti Pembayaran</label>
                    <input type="file" name="bukti_bayar" id="bukti_bayar" class="form-control" required>
                </div>

                <button type="submit" class="btn roberto-btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <br>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkInInput = document.getElementById('check_in');
            const checkOutInput = document.getElementById('check_out');
            const totalPriceInput = document.getElementById('total_price');
            const hargaKamar = @json($kamar->harga);

            // Fungsi format harga
            function formatCurrency(amount) {
                return 'Rp. ' + amount.toLocaleString('id-ID');
            }

            // Fungsi hitung total harga
            function calculateTotalPrice() {
                const checkInDate = new Date(checkInInput.value);
                const checkOutDate = new Date(checkOutInput.value);

                if (checkInDate && checkOutDate && checkOutDate > checkInDate) {
                    const timeDifference = checkOutDate - checkInDate;
                    const days = timeDifference / (1000 * 3600 * 24); // Konversi ke hari
                    const totalPrice = days * hargaKamar; // Hitung total harga
                    totalPriceInput.value = formatCurrency(totalPrice);
                } else {
                    totalPriceInput.value = '';
                }
            }

            // Hitung otomatis ketika halaman dimuat
            calculateTotalPrice();
        });
    </script>
@endsection
