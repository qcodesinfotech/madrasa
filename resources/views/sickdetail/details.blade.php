@extends('layouts.master')
@section('content')
<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Sick Leave  </h1>
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
											<th class="cell" colspan="1">آئی ڈی</th>
											<th class="cell"colspan="1">تاریخ</th>
											<th class="cell" colspan="3">بعد فجر</th>
											<th  class="cell"  colspan="3">بعد اشراق</th>
											<th class="cell" colspan="3">بعد ظہر</th>
											<th  class="cell" colspan="3"> بعد مغرب</th>
											<th class="cell" colspan="1">چھٹی</th>
											<th class="cell" colspan="1">Action</th>

                                          
										</tr>
										<tr>
											<th class="cell"></th>
											<th class="cell"></th>
                                            <th class="cell"> غزا</th>
                                            <th class="cell"> دوائی</th>
                                            <th class="cell"> تفصیل</th>
											<th class="cell"> غزا</th>
                                            <th class="cell"> دوائی</th>
                                            <th class="cell"> تفصیل</th>
											<th class="cell"> غزا</th>
                                            <th class="cell"> دوائی</th>
                                            <th class="cell"> تفصیل</th>
											<th class="cell"> غزا</th>
                                            <th class="cell"> دوائی</th>
                                            <th class="cell"> تفصیل</th>
											<th class="cell"> </th>
                                            <th class="cell"> </th>

																					
										</tr>
									</thead>
									


							
									
									<?php $i=1;
									
                                    $data = $sick_leave;

									for($index = 0; $index < count($data); $index++){


										?>
									<tr>
										<td class="cell">{{ $i++ }}</td>
									
									
											
	                                        <td class="cell"><span class="truncate">{{ $data[$index]->date}}</span></td>
											<td class="cell"><span class="truncate">{{ $data[$index]->food_1}}</span></td>
											<td class="cell"><span class="truncate">{{ $data[$index]->medicine_1}}</span></td>
											<td class="cell"><span class="truncate">{{ $data[$index]->description_1}}</span></td>
											<td class="cell"><span class="truncate">{{ $data[$index]->food_2}}</span></td>
											<td class="cell"><span class="truncate">{{ $data[$index]->medicine_2}}</span></td>
											<td class="cell"><span class="truncate">{{ $data[$index]->description_2}}</span></td>
											<td class="cell"><span class="truncate">{{ $data[$index]->food_3}}</span></td>
											<td class="cell"><span class="truncate">{{ $data[$index]->medicine_3}}</span></td>
											<td class="cell"><span class="truncate">{{ $data[$index]->description_3}}</span></td>
											<td class="cell"><span class="truncate">{{ $data[$index]->food_4}}</span></td>
											<td class="cell"><span class="truncate">{{ $data[$index]->medicine_4}}</span></td>
											<td class="cell"><span class="truncate">{{ $data[$index]->description_4}}</span></td>
											<td class="cell"><span class="truncate">{{ $data[$index]->leave}}</span></td>
											
                                            <td class="cell">
												<a href="{{ route('editsickleave',$data[$index]->id)  }}" class="btn btn-primary"><i class="fas fa-edit fa-1x"></i></a>
											<form action="{{ route('destroysickleave',$data[$index]->id)}}" method="POST" >
												@csrf
												@method('DELETE')
											<button type="submit" onclick="return confirm(' you want to delete?');" class="btn btn-danger"><i class="fas fa-trash fa-1x"></i></button>
											</form>




									
											
										
										
										




										<tr>										
											<?php } ?>

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