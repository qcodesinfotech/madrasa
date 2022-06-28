@extends('layouts.master')
@section('content')
<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Khatma</h1>
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
						</div>
					</div>
				</div>
			</div>


<form action="searchkhatma" method="POST">
	
	@csrf
	@method('POST')
	<label for="">Select student</label>
			<select name="student_id" id="" class="form-select">
				@foreach ($naz as $data => $col)
				<option value="{{$data}}">{{$data}}</option>
				@endforeach
			</select>
		
			<button type="submit"  class="btn btn-dark" style="margin:3px 38%;"><i class="fa fa-search" aria-hidden="true"></i></button>
		</form>
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
											<th class="cell">student Name</th>
											<th class="cell">E Parah</th>
											<th class="cell">Over all Parah</th>
											<th class="cell">Date</th>
											<th class="cell">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php $i=1; ?>
									<?php if(isset($khatma)){ ?>
									@foreach ($khatma as $data)
									<tr>
										<td class="cell">{{ $i++ }}</td>
										<td class="cell"><span class="truncate">{{ $data->name}}</span></td>
										<td class="cell"><span class="truncate">{{ $data->e_parah}}</span></td>
										<td class="cell"><span class="truncate">{{ $data->overall_para}}</span></td>
										<td class="cell"><span class="truncate">{{ $data->created_at}}</span></td>
										<td class="cell">
											<a href="correctnaz/{{ $data->id }}"  class="btn btn-primary" ><i class="fas fa-check fa-1x"></i></a>
											<a href="cancelnaz/{{ $data->id }}"  class="btn btn-danger" ><i class="fas fa-times fa-1x"></i></a>

									</tr>
									@endforeach
									<?php } ?>
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
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
				<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>
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