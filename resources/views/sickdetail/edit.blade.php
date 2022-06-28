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
            <select name="sick_id" class="form-select" id="{{ $sickleave->sick_id}}" required>
                <option value="{{ $sickleave->sick_id}}">{{$sickleave->reason}}</option>
                @foreach ($sick as $data)
            <option value="{{$data->id}}">{{$data->reason}}</option>
                @endforeach
            </select>
</div>

<div class="mb-3">
	<label for="recipient-name" class="col-form-label">Medicine</label>
	<input type="text" name="medicine" value="{{ $sickleave->medicine}}" class="form-select" id=""placeholder="" required>

</div>
<div class="mb-3">
	<label for="recipient-name" class="col-form-label">Hospital</label>
	<input type="text" name="hospital" value="{{ $sickleave->hospital}}" class="form-select" id=""placeholder=" " required>

</div>
<div class="mb-3">
	<label for="recipient-name" class="col-form-label">Doctor</label>
	<input type="text" name="doctor" value="{{ $sickleave->doctor}}" class="form-select" id=""placeholder=" " required>

</div>
<div class="mb-3">
	<label for="recipient-name" class="col-form-label">Date & Time</label>
	<input type="datetime-local" value="{{ $sickleave->date_time}}" name="date_time" class="form-control" required>
</div>
         <button style="margin-left:34%;" type="submit" class="btn btn-primary">Submit</button>

	</form>
</div>

@endsection
