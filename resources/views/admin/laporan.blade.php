@extends('backend.master')

@section('content')
<div class="container-fluid">
    <div class="card card-documentation">
        <div class="card-header bg-info-gradient text-white bubble-shadow">
            <h4>Data Arsip Laporan Persamaan Hotel</h4>
            <p class="mb-0 op-7">Laporan Data Hotel</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card-body">
            <!-- Tombol untuk membuka modal laporan reservasi -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dateModalReservasi">
                Unduh Laporan Data Reservasi
            </button>

            <!-- Tombol untuk membuka modal laporan keuangan -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#dateModalKeuangan">
                Unduh Laporan Keuangan
            </button>

            <a href="{{ route('laporan.downloadUserPDF') }}" class="btn btn-secondary">Unduh Data User</a>
        </div>
    </div>
</div>

<!-- Modal untuk memilih tanggal laporan reservasi -->
<div class="modal fade" id="dateModalReservasi" tabindex="-1" role="dialog" aria-labelledby="dateModalReservasiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dateModalReservasiLabel">Pilih Rentang Tanggal Laporan Reservasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('laporan.download') }}" method="GET">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="start_date">Tanggal Awal:</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">Tanggal Akhir:</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Unduh PDF</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal untuk memilih tanggal laporan keuangan -->
<div class="modal fade" id="dateModalKeuangan" tabindex="-1" role="dialog" aria-labelledby="dateModalKeuanganLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dateModalKeuanganLabel">Pilih Rentang Tanggal Laporan Keuangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('laporan.keuangan.pdf') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="start_date_keuangan">Tanggal Awal:</label>
                        <input type="date" id="start_date_keuangan" name="start_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date_keuangan">Tanggal Akhir:</label>
                        <input type="date" id="end_date_keuangan" name="end_date" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Unduh PDF</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tambahkan script Bootstrap jika belum ada -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
