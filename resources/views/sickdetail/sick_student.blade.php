@extends('layouts.master')
@section('content')
<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Sick Students  </h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<div class="col-auto">
								<style>
									input {
										text-transform: capitalize;
									}
									tr{
										border-collapse: collapse;
									}

									.cell{
										text-align:center;
										border: 1px solid gray;
									}

								</style>
							</div>
							{{-- <button type="button" onMouseOver="this.style.color='#15A362'" onMouseOut="this.style.color='#676778'" style="border-radius:5px;padding:4px;background-color:white;border:1px solid #676778;;color:#676778; " class="col-auto" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap"><i class="fa fa-plus" aria-hidden="true"></i> Add </button> --}}

							<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Add Sick Student Detail</h5>
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

                                            {{-- <form action="{{ route('addsickleavedetail') }}"
                                              method="POST">
												@csrf
												@method('post')


												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Student</label>
													<select name="student_id" class="form-select" id="" >
														<option value="">Select Student</option>
														@foreach ($students as $data)
														<option value="{{$data->id}}">{{$data->name}}</option>
														@endforeach
													</select>
												</div>


                                                <div class="mb-3">
													<label for="recipient-name" class="col-form-label">Date</label>
													<input type="date" name="date" class="form-select" id=""placeholder="" >

												</div>


                                                <div class="mb-3">
													<label for="recipient-name" class="col-form-label">Food 1</label>
													<input type="text" name="food_1" class="form-select" id=""placeholder=" " >

												</div>
                                                <div class="mb-3">
													<label for="recipient-name" class="col-form-label"> Medicine 1</label>
													<input type="text" name="medicine_1" class="form-select" id=""placeholder="" >

												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label"> Description 1</label>
													<textarea type="text" name="description_1" class="form-select" id=""placeholder="" ></textarea>

												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Food 2</label>
													<input type="text" name="food_2" class="form-select" id=""placeholder=" " >

												</div>
                                                <div class="mb-3">
													<label for="recipient-name" class="col-form-label"> Medicine 2</label>
													<input type="text" name="medicine_2" class="form-select" id=""placeholder="" >

												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label"> Description 2</label>
													<textarea type="text" name="description_2" class="form-select" id=""placeholder="" ></textarea>

												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Food 3</label>
													<input type="text" name="food_3" class="form-select" id=""placeholder=" " >

												</div>
                                                <div class="mb-3">
													<label for="recipient-name" class="col-form-label"> Medicine 3</label>
													<input type="text" name="medicine_3" class="form-select" id=""placeholder="" >

												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label"> Description 3</label>
													<textarea type="text" name="description_3" class="form-select" id=""placeholder="" ></textarea>

												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label">Food 4</label>
													<input type="text" name="food_4" class="form-select" id=""placeholder=" " >

												</div>
                                                <div class="mb-3">
													<label for="recipient-name" class="col-form-label"> Medicine 4</label>
													<input type="text" name="medicine_4" class="form-select" id=""placeholder="" >

												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label"> Description 4</label>
													<textarea type="text" name="description_4" class="form-select" id=""placeholder="" ></textarea>

												</div>
												<div class="mb-3">
													<label for="recipient-name" class="col-form-label"> Leave</label>
													<input type="text" name="leave" class="form-select" id=""placeholder="" >

												</div>



												<div class="modal-footer">
													<button type="button" class="btn btn-secondary"
														data-bs-dismiss="modal">Close</button>
											<button type="submit" name="submit" class="btn btn-primary">Save</button>
											</form> --}}

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
								<table class="table app-table-hover mb-0 text-left" style="font-size: .700rem;">
									<thead>
										<th class="cell">SNo</th>
                                            <th class="cell">Student Name</th>
                                            <th class="cell">Admission No</th>
                                            <th class="cell">Address</th>
                                            <th class="cell">Course</th>
											<th class="cell">Disease</th>
                                            <th class="cell">Date</th>
											<th class="cell">Session</th>
											{{-- <th class="cell">Cured</th> --}}
											<th class="cell">Show</th>
									</thead>

									<tbody>
										<?php $i=1; ?>
										<?php $current_date = date("d/m/Y");
									// echo $current_date;
?>
										@foreach ($sick as $data)

										<?php
										 if ($current_date == $data[0]->date && $data[0]->status == 1  ) {
											// echo $data[0]->student_name;

										 ?>
										<tr>

											<?php $city = explode(",",$data[0]->student_address)[0]; ?>
											<td class="cell">{{ $i++ }}</td>
											<td class="cell"><span class="truncate">{{ $data[0]->student_name }}-{{$city}}</span></td>
											<td class="cell"><span class="truncate">{{ $data[0]->student_admission_no }}</span></td>
											<td class="cell"><span class="truncate">{{ $data[0]->student_address }}</span></td>
											<td class="cell"><span class="truncate">{{ $data[0]->student_course }}</span></td>
                                            <td class="cell"><span class="truncate">{{ $data[0]->disease }}</span></td>
											<td class="cell"><span class="truncate">{{ $data[0]->date }}</span></td>
											<td class="cell"><span class="truncate">{{ $data[0]->session }}</span></td>
											{{-- <td class="cell"><span class="truncate">{{ $data[0]->status }}</span></td> --}}



											<td class="cell">
												<a href="{{ route('sick_detail_view',$data[0]->student_id)  }}" class="btn btn-primary"><i class="fas fa-eye fa-1x"></i></a></td>


											</td>
										</tr>
									<?php } elseif($data[0]->status == 0) {?>
										<tr>

											<?php $city = explode(",",$data[0]->student_address)[0]; ?>
											<td class="cell">{{ $i++ }}</td>
											<td class="cell"><span class="truncate">{{ $data[0]->student_name }}-{{$city}}</span></td>
											<td class="cell"><span class="truncate">{{ $data[0]->student_admission_no }}</span></td>
											<td class="cell"><span class="truncate">{{ $data[0]->student_address }}</span></td>
											<td class="cell"><span class="truncate">{{ $data[0]->student_course }}</span></td>
                                            <td class="cell"><span class="truncate">{{ $data[0]->disease }}</span></td>
											<td class="cell"><span class="truncate">{{ $data[0]->date }}</span></td>
											<td class="cell"><span class="truncate">{{ $data[0]->session }}</span></td>
											{{-- <td class="cell"><span class="truncate">{{ $data[0]->status }}</span></td> --}}



											<td class="cell">
												<a href="{{ route('sick_detail_view',$data[0]->student_id)  }}" class="btn btn-primary"><i class="fas fa-eye fa-1x"></i></a></td>


											</td>
										</tr>
										<?php } ?>
										@endforeach
									</tbody>







								</table>
							</div>
							<!--//table-responsive-->

						</div>
						<!--//app-card-body-->
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
