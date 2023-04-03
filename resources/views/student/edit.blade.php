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
	<form action="{{ route('student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		<div class="mb-3">
			<h4 style="text-align:center;">Edit Student Data</h4>
		</div>
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Name</label>
			<input type="text" value="{{ $student->name}}" name="name" class="form-control" id="recipient-name">
		</div>

		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">AdmissionNumber</label>
			<input type="text" value="{{ $student->admission_no}}" name="admission_no" class="form-control" id="recipient-name">
		</div>
		
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Arabic Date</label>
			<input type="text" value="{{ $student->arabic_date}}" name="arabic_date" class="form-control" id="recipient-name">
		</div>

		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Father Name</label>
			<input type="text" value="{{ $student->father_name}}" name="father_name" class="form-control" id="recipient-name">

		</div>

		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Course</label>
		<select class="form-select" name="course" id="">

			<option value="{{ $student->course_id}}">{{$student->course}}</option>
			@foreach ($course as $data )
			<option value="{{$data->id}}">{{$data->title}}</option>
			@endforeach


		</select>

		</div>

		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Father Occupation</label>
			<input type="text" value="{{ $student->father_occupation}}" name="father_occupation" class="form-control" id="recipient-name">
		</div>

		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Date of Birth</label>
			<input type="date" value="{{ $student->date_of_birth}}" name="date_of_birth" class="form-control" id="recipient-name">
		</div>
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Blood Group</label>
			<input type="text" value="{{ $student->blood_group}}" name="blood_group" class="form-control" id="recipient-name">
		</div>

		<label class="form-label" for="customFile">Aadhar No</label>
		<input type="text" name="aadhar_no" value="{{ $student->aadhar_no}}" class="form-control" id="customFile" />

		<label class="form-label" for="customFile">Mobile No</label>
		<input type="text" name="mobile_no" value="{{ $student->mobile_no}}" class="form-control" id="customFile" />

		<label class="form-label" for="customFile">Whatsapp No </label>
		<input type="text" name="whatsapp_no" value="{{ $student->whatsapp_no}}" class="form-control" id="customFile" />

		<label class="form-label" for="customFile">Address</label>
		<input type="text" name="address" value="{{ $student->address}}" class="form-control" id="customFile" />

		<label class="form-label" for="customFile">Monthly Donation</label>
		<input type="text" name="monthly_donation" value="{{ $student->monthly_donation}}" class="form-control" id="customFile" />

        <label class="form-label" for="customFile">Admission Date</label>
		<input type="date" name="admission_date" value="{{ $student->Admission_date}}" class="form-control" id="customFile" />

		<label class="form-label" for="customFile">Previous School</label>
		<input type="text" name="previous_school" value="{{ $student->previous_school}}" class="form-control" id="customFile" />

    	<p></p><br>
        <label class="form-label" for="customFile">Student picture</label><br>
		<a href="{{ URL::asset('students_photo')}}/{{ $student->student_pic}}">
        <img src="{{ URL::asset('students_photo')}}/{{ $student->student_pic}}" width="100px"></a>
		<p></p><br>
		<input type="file" name="student_pic" value="{{ $student->student_pic}}" class="form-control" id="customFile" />

		<label class="form-label" for="customFile">Student Adharcard</label><br>
           <a href="{{ URL::asset('students_photo')}}/{{ $student->proof1}}">
        <img src="{{ URL::asset('students_photo')}}/{{ $student->proof1}}" width="100px"></a>
		<p></p><br>
		<input type="file" name="proof1" value="{{ $student->proof1}}" class="form-control" id="customFile" />

		<label class="form-label" for="customFile">Student School certificate</label><br>
		<a href="{{ URL::asset('students_photo')}}/{{ $student->proof2}}">
        <img src="{{ URL::asset('students_photo')}}/{{ $student->proof2}}" width="100px"></a>

		<p></p><br>
		<input type="file" name="proof2" value="{{ $student->proof2}}" class="form-control" id="customFile" />
		<label class="form-label" for="customFile">Parents Adharcard</label><br>
		<a href="{{ URL::asset('students_photo')}}/{{ $student->proof3}}">
        <img src="{{ URL::asset('students_photo')}}/{{ $student->proof3}}" width="100px"></a>

		<p></p><br>
		<input type="file" name="proof3" value="{{ $student->proof3}}" class="form-control" id="customFile" />

		<label class="form-label" for="customFile">Mohalla Jamat Letter</label><br>
		<a href="{{ URL::asset('students_photo')}}/{{ $student->proof4}}">
        <img src="{{ URL::asset('students_photo')}}/{{ $student->proof4}}" width="100px"></a>
		<p></p><br>
		<input type="file" name="proof4" value="{{ $student->proof4}}" class="form-control" id="customFile" />
	
        <label class="form-label" for="customFile">Parents Razi Nama</label><br>
		<a href="{{ URL::asset('students_photo')}}/{{ $student->proof5}}">
        <img src="{{ URL::asset('students_photo')}}/{{ $student->proof5}}" height="100px"></a>

		<p></p><br>
		<input type="file" name="proof5" value="{{ $student->proof5}}" class="form-control" id="customFile" />
        <label class="form-label" for="customFile">Madarsa - Iqrarnama</label><br>
	    	<a href="{{ URL::asset('students_photo')}}/{{ $student->proof6}}">
        <img src="{{ URL::asset('students_photo')}}/{{ $student->proof6}}" height="100px"></a>
		<input type="file" name="proof6" value="{{ $student->proof6}}" class="form-control" id="customFile" />
		<button style="margin-left:34%;" type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>

@endsection
