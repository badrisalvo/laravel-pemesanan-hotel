@extends('backend.master')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-info-gradient text-white">
            <h4>Manage About Us</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="mb-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAboutModal">
                    Add New About
                </button>
            </div>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($abouts as $about)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $about->title }}</td>
                            <td>{{ $about->description }}</td>
                            <td>
                                <!-- Edit button -->
                                <button class="btn btn-warning btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editAboutModal-{{ $about->id }}">
                                    Edit
                                </button>
                                <!-- Delete form -->
                                <form action="{{ route('about.destroy', $about->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editAboutModal-{{ $about->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit About</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('about.update', $about->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="title">Title</label>
                                                        <select name="title" class="form-control" required>
                                                            <!-- We will exclude the current 'title' from being selectable again -->
                                                            @foreach(['Home1', 'Home2', 'Instagram', 'Twitter', 'Facebook', 'Youtube'] as $title)
                                                                @if($about->title !== $title && !$abouts->contains('title', $title))
                                                                    <option value="{{ $title }}">{{ $title }}</option>
                                                                @endif
                                                            @endforeach
                                                            <!-- Keep the current title selected -->
                                                            <option value="{{ $about->title }}" selected>{{ $about->title }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea name="description" class="form-control" rows="5" required>{{ $about->description }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addAboutModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New About</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('about.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <select name="title" class="form-control" required>
                            <!-- Check and exclude the titles already in the database -->
                            @foreach(['Home1', 'Home2', 'Instagram', 'Twitter', 'Facebook', 'Youtube'] as $title)
                                @if(!$abouts->contains('title', $title))
                                    <option value="{{ $title }}">{{ $title }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<script>
    // Menutup modal setelah form submit (untuk modal tambah dan edit)
    const addModal = document.getElementById('addAboutModal');
    const editModals = document.querySelectorAll('[id^="editAboutModal-"]');

    // Event listener untuk menutup modal setelah sukses
    if (addModal) {
        addModal.addEventListener('hidden.bs.modal', function () {
            document.querySelector('form[name="addAboutForm"]').reset();
        });
    }

    editModals.forEach(modal => {
        modal.addEventListener('hidden.bs.modal', function () {
            const form = modal.querySelector('form');
            form.reset();
        });
    });
</script>
@endsection
