@extends('backend.master')

@section('content')

<div class="container-fluid">
    <div class="card card-documentation">
        <div class="card-header bg-info-gradient text-white bubble-shadow">
            <h4>Data Booking</h4>
            <p class="mb-0 op-7">Informasi Booking</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card mt-4">
            <div class="card-body">
            <button class="btn btn-info" data-toggle="modal" data-target="#addBookingModal">Tambah Booking</button>
            <div class="table-responsive">
                <table class="table table-head-bg-primary">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Booking</th>
                            <th>User</th>
                            <th>Kamar</th>
                            <th>Harga Kamar</th>
                            <th>Check-In</th>
                            <th>Check-Out</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Tanggal Booking</th>
                            <th>Bukti Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $key => $booking)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->kamar->room_number }}</td>
                                <td>Rp. {{ number_format($booking->kamar->harga, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->check_out)->format('d-m-Y') }}</td>
                                <td>Rp. {{ number_format($booking->harga, 0, ',', '.') }}</td>
                                <td>{{ ucfirst($booking->status) }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->updated_at)->format('d-m-Y') }}</td>
                                <td>
                                    @if($booking->bukti_bayar)
                                        <button class="btn btn-info" onclick="showProof('{{ asset('storage/' . $booking->bukti_bayar) }}')">Lihat</button>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($booking->status === 'completed')
                                        <span class="badge badge-success">Selesai</span>
                                    @else
                                        <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                        <form action="{{ route('booking.confirm', $booking->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success">Konfirmasi</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>  
                <div class="d-flex justify-content-center">
                <p>Halaman {{ $bookings->currentPage() }} dari {{ $bookings->lastPage() }}</p>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $bookings->links('pagination::simple-bootstrap-4') }}
                    
                    
                </div>

                
            </div>
        </div>

        <!-- Add Booking Modal -->
        <div class="modal fade" id="addBookingModal" tabindex="-1" role="dialog" aria-labelledby="addBookingModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBookingModalLabel">Tambah Booking</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addBookingForm" action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="user_id">User</label>
                                <select name="user_id" id="user_id" class="form-control" required>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kamar_id">Kamar</label>
                                <select name="kamar_id" id="kamar_id" class="form-control" required>
                                    @foreach($kamar as $room)
                                        <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="check_in">Check-In</label>
                                <input type="date" name="check_in" id="check_in" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="check_out">Check-Out</label>
                                <input type="date" name="check_out" id="check_out" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="bukti_bayar">Bukti Bayar (optional)</label>
                                <input type="file" name="bukti_bayar" id="bukti_bayar" class="form-control">
                                <small class="form-text text-muted">Upload bukti bayar jika ada.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Booking</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Booking Modal -->
        <div class="modal fade" id="editBookingModal" tabindex="-1" role="dialog" aria-labelledby="editBookingModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBookingModalLabel">Edit Booking</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editBookingForm" method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="edit_user_id">User</label>
                                <select name="user_id" id="edit_user_id" class="form-control" required>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_kamar_id">Kamar</label>
                                <select name="kamar_id" id="edit_kamar_id" class="form-control" required>
                                    @foreach($kamar as $room)
                                        <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_check_in">Check-In</label>
                                <input type="date" name="check_in" id="edit_check_in" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_check_out">Check-Out</label>
                                <input type="date" name="check_out" id="edit_check_out" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_bukti_bayar">Bukti Bayar (optional)</label>
                                <input type="file" name="bukti_bayar" id="edit_bukti_bayar" class="form-control">
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Booking</button>
                        </form>
                    </div>
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
    function showEditForm(id, user_id, kamar_id, check_in, check_out) {
        document.getElementById('edit_user_id').value = user_id;
        document.getElementById('edit_kamar_id').value = kamar_id;
        document.getElementById('edit_check_in').value = check_in;
        document.getElementById('edit_check_out').value = check_out;
        document.getElementById('editBookingForm').action = '{{ url('booking') }}/' + id;
        $('#editBookingModal').modal('show');
    }

    function showProof(imageUrl) {
        document.getElementById('proofImage').src = imageUrl;
        $('#proofModal').modal('show');
    }
</script>

@endsection
