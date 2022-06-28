@extends('layouts.master')
@section('content')
<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Student Parah</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<div class="col-auto">
								<style>

									input {
										text-transform: capitalize;
									}
									.cell{
										text-align:center;
									}

								</style>
							</div>
							<button type="button" onMouseOver="this.style.color='#15A362'" onMouseOut="this.style.color='#676778'" style="border-radius:5px;padding:4px;background-color:white;border:1px solid #676778;;color:#676778; " class="col-auto" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap"><i class="fa fa-plus" aria-hidden="true"></i> Add Para</button>

							<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Add Para</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											@if ($errors->any())

											<div class="alert alert-danger">
												<strong>Whoops!</strong> There were some problems with your input.<br><br>
												  <ul>
													@foreach ($errors->all() as $error)
													<li>{{ $error }}</li>
													@endforeach
												  </ul>
											</div>
											@endif
											<form action="studentbase" method="POST">
												@csrf
												@method('post')
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Student</label>
													<select name="student_id" class="form-select" id="" required>
														<option value="">Select Student</option>
														@foreach ($student as $data)
														<option value="{{$data->id}}">{{$data->name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 1</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 2</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 3</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 4</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 5</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 6</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 7</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 8</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 9</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 10</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 11</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 12</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 13</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 14</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 15</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 16</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 17</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 18</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 19</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 20</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 21</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 22</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 23</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 24</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 25</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 26</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 27</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 28</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 29</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Parah 30</label>
													<select name="para_order[]" class="form-select" id="" required>
														<option value="">Select Parah</option>
														@foreach ($parah as $data)
														<option value="{{$data->id}}">{{$data->para_name}}</option>
														@endforeach
													</select>
												</div>
									
										</div>
										<div class="modal-footer">
											<a href="#" class="btn btn-secondary">Close</a>
											<button type="submit" name="submit" class="btn btn-primary">Save</button>
											</form>

										</div>
									</div>
								</div>
							</div>


						</div>
					
					</div>
			
				</div>
				
			</div>
			<div class="tab-content" id="orders-table-tab-content">
				<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					<div class="app-card app-card-orders-table shadow-sm mb-5">
						<div class="app-card-body">
							<div class="table-responsive">
								@if ($message = Session::get('success'))
								<div class="alert alert-success">
									<p>{{ $message }}</p>
								</div>
								@endif
								<table class="table app-table-hover mb-0 text-left">
									<thead>
										<tr>
											<th class="cell">Id</th>
											<th class="cell">student</th>
											<th class="cell">Total para</th>
											<th class="cell">Parah order</th>
		
										</tr>
									</thead>
									<tbody>
										<?php $i=1; ?>
										@foreach ($student_base as $student=>$data)
										<tr>
											<td class="cell">{{ $i++ }}</td>
											<td class="cell"><span class="truncate">{{ $student}}</span></td>
											<td class="cell"><span class="truncate">{{ sizeof($data)}}</span></td>
									   	<td class="cell"><span class="truncate" ><a href="{{ route('getstudentparah',$student) }}" class="btn btn-secondary"><i class="fas fa-eye fa-1x"></a></span></td>
									@endforeach
									</tbody>
								</table>

							</div>
						</div>
						
					</div>
					
				</div>

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