@extends('layouts.master')

@section('content')
<script language="Javascript" src="admin/jquery.js"></script>
<script type="text/JavaScript" src='admin/state.js'></script>


<div class="app-wrapper">

	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">

			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
				<h1 class="app-page-title mb-0">
			    <img width ="30px"
				src="data:image/png;base64,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"/>
               
				Location

				</h1>
				</div>
				<style>
					input {
						text-transform: capitalize;
					}
				</style>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<div class="col-auto">
							
							</div>
							<button type="button" onMouseOver="this.style.color='#15A362'" onMouseOut="this.style.color='#676778'" style="border-radius:5px;padding:4px;background-color:white;border:1px solid #676778;;color:#676778; " class="col-auto" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap"><i class="fa fa-plus" aria-hidden="true"></i> Add Location</button>
						
							<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
								     	<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Add Location</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
									      	<div class="modal-body">
										    <form action="{{ route('location.store')}}" method="POST">
												@csrf

												<div class='resp_code frms'>

													<div id="selection">
														<label for="recipient-name" class="col-form-label">Select State</label>
														<select name="state" id="listBox" onchange='selct_district(this.value)' required></select>
														<label for="recipient-name" class="col-form-label">Select District</label>
														<select name="district" id='secondlist' required>></select>
													</div>

													<div class="mb-3">
														<label for="recipient-name" class="col-form-label">City</label>
														<input type="text" name="city" class="form-control" id="recipient-name" placeholder="Enter City or Town Name " required>

													</div>

													<div class="mb-3">
														<label for="recipient-name" class="col-form-label">pincode</label>
														<input type="text" name="pincode" class="form-control" id="recipient-name" placeholder="Enter Pincode" required>
														<input type="hidden" name="updated" value="0" class="form-control" id="recipient-name">
													</div>
												</div>
												<div class="modal-footer">

												  <a data-bs-dismiss="modal"
												  aria-label="Close"  class="btn btn-secondary">Close</a>
													<button type="submit" name="submit" class="btn btn-primary">Save</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div id="dumdiv" align="center" style=" font-size: 10px;color: #dadada;"> </div>
						<a id="dum" style="padding-right:0px; text-decoration:none;color: green;text-align:center;" href="http://www.hscripts.com"></a>

					</div>
					<!--//row-->
				</div>
				<!--//table-utilities-->
			</div>
			<!--//col-auto-->
		</div>
		<!--//row-->
		@if ($errors->any())

							
		<?php   
echo '<script type ="text/JavaScript">';  
echo 'alert("'.$errors->first().'")';  
echo '</script>';  
?>  	
	@endif

		<div class="tab-content" id="orders-table-tab-content">
			<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
				<div class="app-card app-card-orders-table shadow-sm mb-5">
					<div class="app-card-body">
						<div class="table-responsive">


							@if ($message = Session::get('success'))

							<div class="alert alert-success">

								<p>{{ $message }}</p>
							</div>
							@endif <table class="table app-table-hover mb-0 text-left">
								<thead>
									<tr>
										<th class="cell">Id</th>
										<th class="cell">City</th>
										<th class="cell">State</th>
										<th class="cell">District</th>
										<th class="cell">Pincode</th>
										<th class="cell">Action</th>
									</tr>
								</thead>

								<tbody>
									@foreach ($location as $data)
									<tr>
										<td class="cell">{{ ++$i }}</td>
										<td class="cell">{{ $data->city}}</td>
										<td class="cell"><span>{{ $data->state }}</span></td>
										<td class="cell">{{ $data->district}}</td>
										<td class="cell">{{ $data->pincode }}</td>
								
										<td class="cell">
											<a href="{{ route('location.edit',$data->id) }}" class="btn btn-primary" data-toggle="modal" id="mediumButton" data-target="#mediumModal" class="btn-sm app-primary editbtn"><i class="fas fa-edit"></i></a>
								
										<form action="{{ route('location.destroy',$data->id) }}" method="POST" style="display:inline;">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete  all data related to Location?');"   ><i class="fas fa-trash"></i></button></td>
										</form>
									</tr>
									@endforeach

								</tbody>
							</table>
						</div>
						<!--//table-responsive-->

					</div>
					<!--//app-card-body-->
				</div>
				<!--//app-card-->
			</div>
			<!--//tab-pane-->

			<style>
				.frms select {
					width: 100%;
					background: #fff;
					border: #ddd 1px solid;
					border-radius: .35em;
					height: 35px;
				}
			</style>

			{!! $location->links() !!}

			<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body" id="mediumBody">
							<div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
			<!-- Script -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>

			<!-- Font Awesome JS -->
			<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
			</script>
			<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
			</script>
			<script>
				// display a modal (medium modal)
				$(document).on('click', '#mediumButton', function(event) {
					event.preventDefault();
					let href = $(this).attr('data-attr');
					$.ajax({
						url: href,
						beforeSend: function() {
							$('#loader').show();
						},
						// return the result
						success: function(result) {
							$('#mediumModal').modal("show");
							$('#mediumBody').html(result).show();
						},
						complete: function() {
							$('#loader').hide();
						},
						error: function(jqXHR, testStatus, error) {
							console.log(error);
							alert("Page " + href + " cannot open. Error:" + error);
							$('#loader').hide();
						},
						timeout: 8000
					})
				});
			</script>


			@endsection