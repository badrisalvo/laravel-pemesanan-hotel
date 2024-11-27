@extends('backend.master')

@section('content')
<div class="container-fluid">
    <div class="card card-documentation">
        <div class="card-header bg-info-gradient text-white bubble-shadow">
            <h4>Data Kategori</h4>
            <p class="mb-0 op-7">Data Kategori Ruangan Kamar Hotel Persamaan </p>
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
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                    <button class="btn btn-info" onclick="editKategori({{ $item->id }}, '{{ $item->name }}')">Edit</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
				<button class="btn btn-primary" data-toggle="modal" data-target="#addKategoriModal">Tambah Kategori</button>
            </div>
        </div>

        <div id="addKategoriModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('kategori.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama Kategori</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Kategori</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="editKategoriModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editKategoriForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="editName">Nama Kategori</label>
                                <input type="text" name="name" id="editName" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Kategori</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function editKategori(id, name) {
        // Menetapkan nilai input dengan ID 'editName'
        document.getElementById('editName').value = name;

        // Menetapkan action form dengan URL yang sesuai
        document.getElementById('editKategoriForm').action = '{{ url('admin/kategori') }}/' + id;

        // Menampilkan modal edit kategori
        $('#editKategoriModal').modal('show');
    }
</script>
@endsection
