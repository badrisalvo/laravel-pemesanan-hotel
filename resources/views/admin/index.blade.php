@extends('backend.master')

@section('content')
<div class="container-fluid">
    <div class="card card-documentation">
        <div class="card-header bg-info-gradient text-white bubble-shadow">
            <h4>Introduction</h4>
            <p class="mb-0 op-7">Atlantis Lite is a free Bootstrap 4 Admin Template.</p>
        </div>
        <div class="card-body">
            <table class="table table-head-bg-primary">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
