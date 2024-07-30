@extends('backend.master')

@section('content')
<div class="container-fluid">
    <div class="card card-documentation">
        <div class="card-header bg-info-gradient text-white bubble-shadow">
            <h4><b>Data Pengunjung</b></h4>
            <p class="mb-0 op-7">User Data Persamaan Hotel & Resort.</p>
        </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mt-4">
        <div class="card-body">
            <table class="table table-head-bg-primary">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Nomor HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>
                                <form action="{{ route('pengunjung.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                                <button class="btn btn-info" onclick="showEditForm({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}', '{{ $user->phone_number }}')">Edit</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
			<button class="btn btn-primary" data-toggle="modal" data-target="#addPengunjungModal">Tambah Pengunjung</button>
        </div>
    </div>

    <!-- Modal Tambah Pengunjung -->
    <div class="modal fade" id="addPengunjungModal" tabindex="-1" role="dialog" aria-labelledby="addPengunjungModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPengunjungModalLabel">Tambah Pengunjung</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pengunjung.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="admin">Admin</option>
                                <option value="customer">Customer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Nomor HP</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Pengunjung</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Edit Pengunjung -->
    <div id="editForm" style="display: none;">
        <form id="editPengunjungForm" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="edit_name">Nama</label>
                <input type="text" name="name" id="edit_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_email">Email</label>
                <input type="email" name="email" id="edit_email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_role">Role</label>
                <select name="role" id="edit_role" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="customer">Customer</option>
                </select>
            </div>
            <div class="form-group">
                <label for="edit_phone_number">Nomor HP</label>
                <input type="text" name="phone_number" id="edit_phone_number" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Pengunjung</button>
        </form>
    </div>
</div>

<script>
    function showEditForm(id, name, email, role, phone_number) {
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_role').value = role;
        document.getElementById('edit_phone_number').value = phone_number;
        document.getElementById('editPengunjungForm').action = '/pengunjung/' + id;
        document.getElementById('editForm').style.display = 'block';
    }
</script>
@endsection
