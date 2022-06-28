
@extends('layouts.master')
@section('content')
<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Para Order</h1>
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
											<th class="cell">Para order</th>
											<th class="cell">Date</th>
											<th class="cell">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i=1; ?>
										@foreach ($student_base as $data)
										<tr>
											<td class="cell">{{ $i++ }}</td>
											<td class="cell"><span class="truncate">{{ $data->para_order }}</span></td>
											<td class="cell"><span class="truncate">{{ $data->created_at}}</span></td>
                                            <td class="cell">
                                             <a href="{{route('editparah',$data->id)}}"  class="btn btn-primary" class="btn-sm app-primary editbtn" ><i class="fas fa-edit fa-1x"></i></a>  
                                            </tr>
										@endforeach
									</tbody>
								</table>

							</div>
							<!--//table-responsive-->

						</div>
						<!--//app-card-body-->
					</div>
				
				</div>

			
				@endsection