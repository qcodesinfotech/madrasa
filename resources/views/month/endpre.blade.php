@extends('layouts.master')

@section('content')
<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Office WORK</h1>
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
					
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                              
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                <!--//row-->
            </div>
            <!--//table-utilities-->
        </div>
        <!--//col-auto-->
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
											<th class="cell">Student</th>
											<th class="cell">course</th>
										
											<th class="cell">date</th>
											<th class="cell">parah</th>
											
											<th class="cell">Action</th>

										</tr>
									</thead>

									<tbody>
										<?php $i=1; ?>
										@foreach ($pre as $data)

										<tr>
											<td class="cell">{{ $i++ }}</td>
											<td class="cell"><span class="truncate">{{ $data->name }}</span></td>
											<td class="cell"><span class="truncate">{{ $data->course}}</span></td>
										
											<td class="cell"><span class="truncate">{{ $data->date }}</span></td>
											<td class="cell"><span class="truncate">
												
												<?php
											
											if(count(explode("-",$data->target)) >= 2 ){
											echo explode("-",$data->target)[0]."-";
											$value=explode("-",$data->target)[1];
											if($value==4){
                                                  echo "ربع آخر";
											}else if($value==6){
                                                    echo "نصف آخر";
											}else if($value==7){

												echo "مکمل پارہ";
											}else{
												echo $value;
											}
										}

											?></span></td>
										    <td class="cell">
											<a href="precorrect/{{ $data->id }}"  class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i></a>

											<form action="{{route('precancel')}}/{{$data->id}}" meyhod="post">
												@csrf
												@method('POST')
											<a class="btn btn-danger"   data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-times" aria-hidden="true"></i></a></td>
									  
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>	
				</div>

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="staticBackdropLabel">Remark</h5>
		  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<div class="mb-3">
				<label for="recipient-name" class="col-form-label">Remark Here</label>
				<input type="text" name="remark" class="form-control" id="recipient-name" >
			</div>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		  <button type="submit" name="submit" class="btn btn-primary">Save</button>
		</form>
		</div>
	  </div>
	</div>
  </div>
				@endsection