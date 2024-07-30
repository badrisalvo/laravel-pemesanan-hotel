@extends('backend.master')

@section('content')
<div class="container-fluid">
    <div class="card card-documentation">
        <div class="card-header bg-info-gradient text-white bubble-shadow">
            <h4>Data Kamar</h4>
            <p class="mb-0 op-7">Room Information</p>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card mt-4">
            <div class="card-body">
                <table class="table table-head-bg-primary">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Kamar</th>
                            <th>Kapasitas</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Kategori</th>
                            <th>Detail</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kamar as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->room_number }}</td>
                                <td>{{ $item->kapasitas }}</td>
                                <td>Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>{{ $item->status ? 'Tersedia' : 'Tidak Tersedia' }}</td>
                                <td>{{ $item->kategori->name }}</td>
                                <td>{{ $item->detail }}</td>
                                <td>
                                    @if($item->image)
                                        <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->room_number }}" width="100">
                                    @else
                                        Tidak ada gambar
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('kamar.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                    <button class="btn btn-info" onclick="showEditForm({{ $item->id }}, '{{ $item->room_number }}', '{{ $item->kapasitas }}', '{{ $item->harga }}', '{{ $item->status }}', '{{ $item->kategori_id }}', '{{ $item->detail }}', '{{ $item->image }}')">Edit</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addKamarModal">Tambah Kamar</button>
            </div>
        </div>

        <div class="modal fade" id="addKamarModal" tabindex="-1" role="dialog" aria-labelledby="addKamarModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addKamarModalLabel">Tambah Kamar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addKamarForm" action="{{ route('kamar.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="room_number">Nomor Kamar</label>
                                <input type="text" name="room_number" id="room_number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="kapasitas">Kapasitas</label>
                                <input type="number" name="kapasitas" id="kapasitas" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="text" name="harga" id="harga" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="1">Tersedia</option>
                                    <option value="0">Tidak Tersedia</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kategori_id">Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="form-control" required>
                                    @foreach($kategori as $kat)
                                        <option value="{{ $kat->id }}">{{ $kat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="detail">Detail</label>
                                <textarea name="detail" id="detail" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Gambar</label>
                                <input type="file" name="image" id="image" class="form-control-file">
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Kamar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editKamarModal" tabindex="-1" role="dialog" aria-labelledby="editKamarModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editKamarModalLabel">Edit Kamar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editKamarForm" method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="edit_room_number">Nomor Kamar</label>
                                <input type="text" name="room_number" id="edit_room_number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_kapasitas">Kapasitas</label>
                                <input type="number" name="kapasitas" id="edit_kapasitas" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_harga">Harga</label>
                                <input type="text" name="harga" id="edit_harga" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_status">Status</label>
                                <select name="status" id="edit_status" class="form-control" required>
                                    <option value="1">Tersedia</option>
                                    <option value="0">Tidak Tersedia</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_kategori_id">Kategori</label>
                                <select name="kategori_id" id="edit_kategori_id" class="form-control" required>
                                    @foreach($kategori as $kat)
                                        <option value="{{ $kat->id }}">{{ $kat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_detail">Detail</label>
                                <textarea name="detail" id="edit_detail" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="edit_image">Gambar</label>
                                <input type="file" name="image" id="edit_image" class="form-control-file">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Kamar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Konfigurasi autoNumeric untuk input harga
    AutoNumeric.multiple('.autonumeric', {
        digitGroupSeparator: '.',
        decimalCharacter: ',',
        decimalPlaces: 0,
        modifyValueOnWheel: false
    });

    function showEditForm(id, room_number, kapasitas, harga, status, kategori_id, detail, image) {
        document.getElementById('edit_room_number').value = room_number;
        document.getElementById('edit_kapasitas').value = kapasitas;
        document.getElementById('edit_harga').value = harga;
        document.getElementById('edit_status').value = status;
        document.getElementById('edit_kategori_id').value = kategori_id;
        document.getElementById('edit_detail').value = detail;
        document.getElementById('editKamarForm').action = '/kamar/' + id;
        $('#editKamarModal').modal('show');
    }
</script>
@endsection
