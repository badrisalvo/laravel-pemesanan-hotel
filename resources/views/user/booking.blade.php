<!-- resources/views/user/bookings.blade.php -->

@extends('frontend.master')

@section('content')

<div class="container-fluid">
    <div class="card card-documentation">
        <div class="card-header bg-info-gradient text-white bubble-shadow">
            <h4>Daftar Reservasi</h4>
            <p class="mb-0 op-7">History</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card mt-4">
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-head-bg-primary">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kamar</th>
                            <th>Harga Kamar</th>
                            <th>Check-In</th>
                            <th>Check-Out</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Bukti Bayar</th>
                            <th>Reservasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $key => $booking)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $booking->kamar->room_number }}</td>
                                <td>Rp. {{ number_format($booking->kamar->harga, 0, ',', '.') }}</td>
                                <td>{{ $booking->check_in }}</td>
                                <td>{{ $booking->check_out }}</td>
                                <td>Rp. {{ number_format($booking->harga, 0, ',', '.') }}</td>
                                <td>{{ ucfirst($booking->status) }}</td>
                                <td>
                                    @if($booking->bukti_bayar)
                                        <button class="btn btn-info" onclick="showProof('{{ asset('storage/' . $booking->bukti_bayar) }}')">Lihat Bukti Bayar</button>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td><a href="{{ route('booking.download', $booking->id) }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-download"></i> Download PDF</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada booking</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </div>
        </div>

        <!-- Proof Modal -->
        <div class="modal fade" id="proofModal" tabindex="-1" role="dialog" aria-labelledby="proofModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="proofModalLabel">Bukti Bayar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="proofImage" src="" class="img-fluid" alt="Bukti Bayar">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showProof(imageUrl) {
        document.getElementById('proofImage').src = imageUrl;
        $('#proofModal').modal('show');
    }
</script>

@endsection
