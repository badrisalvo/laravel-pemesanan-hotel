@extends('backend.master')

@section('content')
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
@endsection
