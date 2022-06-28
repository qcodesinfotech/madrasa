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
		text-align: center !important;
        color: rgb(0, 67, 238) !important;

	}
    input{
        color: rgb(255, 70, 3) !important;
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

    

		<div class="mb-3">
			<h4 style="text-align:center;">Student Data</h4>
		</div>

		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Name</label>
			<input type="text" value="{{ $student->name}}" name="name" class="form-control"  disabled id="recipient-name" >
		</div>

		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">AdmissionNumber</label>
			<input type="text" value="{{ $student->admission_no}}" name="admission_no" class="form-control"  disabled id="recipient-name">
	
        </div>

		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Father Name</label>
			<input type="text" value="{{ $student->father_name}}" name="father_name" class="form-control"  disabled id="recipient-name">

		</div>

		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Course</label>
	
            <input type="text" value="{{$student->course}}" name="admission_no" class="form-control"  disabled id="recipient-name">
	





		</div>

		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Father Occupation</label>
			<input type="text" value="{{ $student->father_occupation}}" name="father_occupation" class="form-control"  disabled id="recipient-name">
		</div>

		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Date of Birth</label>
			<input type="text" value="{{ $student->date_of_birth}}" name="date_of_birth" class="form-control"  disabled id="recipient-name">
		</div>
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Blood Group</label>
			<input type="text" value="{{ $student->blood_group}}" name="blood_group" class="form-control"  disabled id="recipient-name">
		</div>

		<label class="form-label" for="customFile">Aadhar No</label>
		<input type="text" name="aadhar_no" value="{{ $student->aadhar_no}}" class="form-control"  disabled id="customFile" />

		<label class="form-label" for="customFile">Mobile No</label>
		<input type="text" name="mobile_no" value="{{ $student->mobile_no}}" class="form-control"  disabled id="customFile" />

		<label class="form-label" for="customFile">Whatsapp No </label>
		<input type="text" name="whatsapp_no" value="{{ $student->whatsapp_no}}" class="form-control"  disabled id="customFile" />

		<label class="form-label" for="customFile">Address</label>
		<input type="text" name="address" value="{{ $student->address}}" class="form-control"  disabled id="customFile" />

		<label class="form-label" for="customFile">Monthly Donation</label>
		<input type="text" name="monthly_donation" value="{{ $student->monthly_donation}}" class="form-control"  disabled id="customFile" />

        <label class="form-label" for="customFile">Admission Date</label>
		<input type="text" name="admission_date" value="{{ $student->Admission_date}}" class="form-control"  disabled id="customFile" />

		<label class="form-label" for="customFile">Previous School</label>
		<input type="text" name="previous_school" value="{{ $student->previous_school}}" class="form-control"  disabled id="customFile" />



		<p></p><br>
        <label class="form-label" for="customFile">Student picture</label><br>
		<a href="{{ URL::asset('students_photo')}}/{{ $student->student_pic}}">
        <img src="{{ URL::asset('students_photo')}}/{{ $student->student_pic}}" width="100px"></a>
		<p></p><br>
		
		<label class="form-label" for="customFile">proof document image 1</label><br>
<a href="{{ URL::asset('students_photo')}}/{{ $student->proof1}}">
        <img src="{{ URL::asset('students_photo')}}/{{ $student->proof1}}" width="100px"></a>
		<p></p><br>
        <label class="form-label" for="customFile">proof document image 2</label><br>
		<a href="{{ URL::asset('students_photo')}}/{{ $student->proof2}}">
        <img src="{{ URL::asset('students_photo')}}/{{ $student->proof2}}" width="100px"></a>

		<p></p><br>
        <label class="form-label" for="customFile">proof document image 3</label><br>
		<a href="{{ URL::asset('students_photo')}}/{{ $student->proof3}}">
        <img src="{{ URL::asset('students_photo')}}/{{ $student->proof3}}" width="100px"></a>

		<p></p><br>
        <label class="form-label" for="customFile">proof document image 4</label><br>
		<a href="{{ URL::asset('students_photo')}}/{{ $student->proof4}}">
        <img src="{{ URL::asset('students_photo')}}/{{ $student->proof4}}" width="100px"></a>

		<p></p><br>
        <label class="form-label" for="customFile">proof document image 5</label><br>
		<a href="{{ URL::asset('students_photo')}}/{{ $student->proof5}}">
        <img src="{{ URL::asset('students_photo')}}/{{ $student->proof5}}" height="100px"></a>

		<p></p><br>
        <label class="form-label" for="customFile">proof document image 6</label><br>
		<a href="{{ URL::asset('students_photo')}}/{{ $student->proof6}}">
        <img src="{{ URL::asset('students_photo')}}/{{ $student->proof6}}" height="100px"></a>

	

</div>

@endsection
