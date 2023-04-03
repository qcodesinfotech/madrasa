@extends('layouts.master')

@section('content')

<style>
	.form {
		margin-left: 30%;
		width: 50%;
		background-color: lightgray;
		padding: 5px 20px;
		border-radius: 6px;
	}

	label {
		text-align: center;
	}
</style>

<div class="form">
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
	<form action="{{ route('updatesickleave', $sickleave->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('POST')
		<div class="mb-3">
			<h4 style="text-align:center;">Edit Student Data</h4>
		</div>
		
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Student</label>
			<select name="student_id" class="form-select" id="{{ $sickleave->student_id}}" >
                <option value="{{ $sickleave->student_id}}">{{$sickleave->student_name}}</option>
				@foreach ($students as $data)
				<option value="{{$data->id}}">{{$data->name}}</option>
				@endforeach
			</select>
		</div>


		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Date</label>
			<input type="date" name="date" class="form-select" value="{{ $sickleave->date}}" id=""placeholder="" >

		</div>
		

		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Food 1</label>
			<input type="text" name="food_1" class="form-select" value="{{ $sickleave->food_1}}" id=""placeholder=" " >

		</div>
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label"> Medicine 1</label>
			<input type="text" name="medicine_1" class="form-select" value="{{ $sickleave->medicine_1}}" id=""placeholder="" >

		</div>
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label"> Description 1</label>
			<textarea type="text" name="description_1" class="form-select" value="{{ $sickleave->description_1}}" id=""placeholder="" ></textarea>

		</div>
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Food 2</label>
			<input type="text" name="food_2" class="form-select" value="{{ $sickleave->food_2}}" id=""placeholder=" " >

		</div>
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label"> Medicine 2</label>
			<input type="text" name="medicine_2" class="form-select" value="{{ $sickleave->medicine_2}}" id=""placeholder="" >

		</div>
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label"> Description 2</label>
			<textarea type="text" name="description_2" class="form-select" value="{{ $sickleave->description_2}}" id=""placeholder="" ></textarea>

		</div>
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Food 3</label>
			<input type="text" name="food_3" class="form-select"  value="{{ $sickleave->food_3}}" id=""placeholder=" " >

		</div>
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label"> Medicine 3</label>
			<input type="text" name="medicine_3" class="form-select" value="{{ $sickleave->medicine_3}}" id=""placeholder="" >

		</div>
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label"> Description 3</label>
			<textarea type="text" name="description_3" class="form-select" value="{{ $sickleave->description_3}}" id=""placeholder="" ></textarea>

		</div>
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Food 4</label>
			<input type="text" name="food_4" class="form-select" value="{{ $sickleave->food_4}}" id=""placeholder=" " >

		</div>
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label"> Medicine 4</label>
			<input type="text" name="medicine_4" class="form-select" value="{{ $sickleave->medicine_4}}" id=""placeholder="" >

		</div>
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label"> Description 4</label>
			<textarea type="text" name="description_4" class="form-select" value="{{ $sickleave->description_4}}" id=""placeholder="" ></textarea>

		</div>
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label"> Leave</label>
			<input type="text" name="leave" class="form-select"   value="{{ $sickleave->leave}} "id=""placeholder="" >

		</div>
		</div>
         <button style="margin-left:34%;" type="submit" class="btn btn-primary">Submit</button>

	</form>
</div>

@endsection
