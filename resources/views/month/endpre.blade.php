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
									.cell {
                            text-align: center;
                        }

                        .key {
                            display: flex;
                        }

                        .key a {
                            width: 100%;
                            padding: 10px;
                        }

                        .key a:hover {
                            background-color: rgba(231, 231, 231, 0.685);
                            color: rgb(47, 172, 255);
                            font-size: 17px;
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
{{-- 
								<div class="key">
									<a href="#" id="s1" class="cell"
										onclick="myfun1('rgb(231,231,231)')">Overall Students</a>
									<a href="#" class="cell" id="s2"
										onclick="myfun2('rgb(231,231,231)')">Failed Students</a>
									<a href="#" class="cell" id="s3"
										onclick="myfun3('rgb(231,231,231)')">Mansooq Students</a>
								</div> --}}




								<table class="table app-table-hover mb-0 text-left"  id="teacherlvc" style="display:none;">
									<thead>
										<tr>
											<th class="cell">SNo</th>
											<th class="cell">Student</th>
											<th class="cell">Admission No</th>
											<th class="cell">Address</th>
											<th class="cell">course</th>

											<th class="cell">date</th>
											<th class="cell">parah</th>



										</tr>
									</thead>

									<tbody>
										<?php $i=1; ?>
										@foreach ($pre as $data)
										<?php $city = explode(",",$data->address)[0];?>

										<tr>
											<td class="cell">{{ $i++ }}</td>
											<td class="cell"><span class="truncate">{{ $data->name }}-{{$city}}</span></td>
											<td class="cell"><span class="truncate">{{ $data->admission_no }}</span></td>
											<td class="cell"><span class="truncate">{{ $data->address }}</span></td>
											<td class="cell"><span class="truncate">{{ $data->course}}</span></td>
											<td class="cell"><span class="truncate">{{ $data->date }}</span></td>
											<td class="cell"><span class="truncate">

												<?php
											if($data->course == 1){

												if(count(explode("-",$data->target)) >= 2 ){
												echo explode("-",$data->target)[0]."-";
												$value=explode("-",$data->target)[1];
												if($value==4){
													  echo "ربع آخر";
												}else if($value ==6){
														echo "نصف آخر";
												}else if($value == 7){

													echo "مکمل پارہ";
												}else{
													echo $value;
												}
											}
											}else{
												echo $data->target;
											}

											?></span></td>
											</tr>
											@endforeach
										</tbody>
									</table>



								<table class="table app-table-hover mb-0 text-left"  id="schoollvc" style="display:none;">
									<thead>
										<tr>
											<th class="cell">SNo</th>
											<th class="cell">Student</th>
											<th class="cell">Admission No</th>
											<th class="cell">Address</th>
											<th class="cell">course</th>

											<th class="cell">date</th>
											<th class="cell">parah</th>



										</tr>
									</thead>

									<tbody>
										<?php $i=1; ?>
										@foreach ($pre as $data)
										<?php $city = explode(",",$data->address)[0];?>

										<tr>
											<td class="cell">{{ $i++ }}</td>
											<td class="cell"><span class="truncate">{{ $data->name }}-{{$city}}</span></td>
											<td class="cell"><span class="truncate">{{ $data->admission_no }}</span></td>
											<td class="cell"><span class="truncate">{{ $data->address }}</span></td>
											<td class="cell"><span class="truncate">{{ $data->course}}</span></td>
											<td class="cell"><span class="truncate">{{ $data->date }}</span></td>
											<td class="cell"><span class="truncate">

												<?php
											if($data->course == 1){

												if(count(explode("-",$data->target)) >= 2 ){
												echo explode("-",$data->target)[0]."-";
												$value=explode("-",$data->target)[1];
												if($value==4){
													  echo "ربع آخر";
												}else if($value ==6){
														echo "نصف آخر";
												}else if($value == 7){

													echo "مکمل پارہ";
												}else{
													echo $value;
												}
											}
											}else{
												echo $data->target;
											}

											?></span></td>
											</tr>
											@endforeach
										</tbody>
									</table>


								<table class="table app-table-hover mb-0 text-left" id="managementlvc">
									<thead>
										<tr>
											<th class="cell">SNo</th>
											<th class="cell">Student</th>
											<th class="cell">Admission No</th>
											<th class="cell">Address</th>
											<th class="cell">course</th>

											<th class="cell">date</th>
											<th class="cell">parah</th>

											<th class="cell">Mansooq</th>
											<th class="cell">Action</th>

										</tr>
									</thead>

									<tbody>
										<?php $i=1; ?>
										@foreach ($pre as $data)
										<?php $city = explode(",",$data->address)[0];?>

										<tr>
											<td class="cell">{{ $i++ }}</td>
											<td class="cell"><span class="truncate">{{ $data->name }}-{{$city}}</span></td>
											<td class="cell"><span class="truncate">{{ $data->admission_no }}</span></td>
											<td class="cell"><span class="truncate">{{ $data->address }}</span></td>
											<td class="cell"><span class="truncate">{{ $data->course}}</span></td>
											<td class="cell"><span class="truncate">{{ $data->date }}</span></td>
											<td class="cell"><span class="truncate">

												<?php
											if($data->course == 1){

												if(count(explode("-",$data->target)) >= 2 ){
												echo explode("-",$data->target)[0]."-";
												$value=explode("-",$data->target)[1];
												if($value==4){
													  echo "ربع آخر";
												}else if($value ==6){
														echo "نصف آخر";
												}else if($value == 7){

													echo "مکمل پارہ";
												}else{
													echo $value;
												}
											}
											}else{
												echo $data->target;
											}

											?></span></td>
											<?php if($data->course_id == 1){?>

										    <td class="cell">
												<a href="precorrect/{{ $data->id }}" >کامیاب </a>

												<form action="{{route('precancel')}}/{{$data->id}}" meyhod="post">
													@csrf
													@method('POST')
													<?php  echo '<a type="text" onclick="openpopup(\'' . $data->id  . '\',\'' . $data->id  . '\')"

														data-bs-toggle="modal"
														data-bs-target="#exampleModal1" data-bs-whatever="@getbootstrap" style = "cursor: pointer">اعادہ پارہ</a>'; ?>



											 </td>

											 <?php }
													?>
													<td class="cell"> <a href="mansooq/{{ $data->id }}" id="anchor"  style="color: brown">منسوخ </a> </td>

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
																<input type="text" name="remark" class="form-control" id="recipient-name">
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

												  <?php if($data->course_id == 2){?>
												<td class="cell">
													<a href="precorrect_hifz/{{ $data->id }}"  >کامیاب</a>
													<form action="precancel_hifz/{{$data->id}}" meyhod="post">
														@csrf
														@method('POST')

													<?php  echo '<a type="text" onclick="openpopup(\'' . $data->id  . '\',\'' . $data->id  . '\')"

													 data-bs-toggle="modal"
													 data-bs-target="#exampleModal1" data-bs-whatever="@getbootstrap" style = "cursor: pointer">اعادہ پارہ</button>';
													}
												   ?>
												   {{-- <a href="copy_hifz/{{ $data->student_id }}" style="color:red" >منسوخ</a> --}}
												   </td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

  <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Remark</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<?php if(!empty($data->id)){?>

				<form action="precancel_hifz/{{$data->id}}" method="GET">
				@csrf
				<?php } ?>
				<div class="mb-3">
					<input type="hidden" name="std_id"  id="std_id" >
					<label for="recipient-name" class="col-form-label">Remark Here</label>
					<input type="text" name="remark" class="form-control" id="remark" >
				</div>
			</div>
			<div class="modal-footer">
			<a data-bs-dismiss="modal"
			aria-label="Close"  class="btn btn-secondary">Close</a>
				<button type="submit" name="submit" class="btn btn-primary">Update</button>
				</form>

			</div>
		</div>
	</div>
</div>




  <script>
	function openpopup(remark,id){
	document.getElementById("std_id").value = id;
	// document.getElementById("remark").value = id;
	}



	function myfun1(color) {
                            document.getElementById('managementlvc').style.display = "";
                            document.getElementById('schoollvc').style.display = "none";

                            document.getElementById('s2').style.background = "none";
                            document.getElementById('s1').style.background = color;
                            document.getElementById('teacherlvc').style.display = "none";
                            document.getElementById('s3').style.background = "none";
                        }

                        function myfun2(color) {
                            document.getElementById('s2').style.background = color;
                            document.getElementById('s1').style.background = "none";
                            document.getElementById('s3').style.background = "none";
                            document.getElementById('schoollvc').style.display = "";
                            document.getElementById('teacherlvc').style.display = "none";
                            document.getElementById('managementlvc').style.display = "none";
                        }
                        function myfun3(color) {
                            document.getElementById('s1').style.background = "none";
                            document.getElementById('s3').style.background = color;
                            document.getElementById('s2').style.background = "none";
                            document.getElementById('schoollvc').style.display = "none";
                            document.getElementById('teacherlvc').style.display = "";
                            document.getElementById('managementlvc').style.display = "none";
                        }

</script>
				@endsection
