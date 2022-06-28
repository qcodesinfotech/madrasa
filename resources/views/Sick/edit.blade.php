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
	<form action="{{ route('update', $sickleave->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('POST')
		<div class="mb-3">
			<h4 style="text-align:center;">Edit Student Data</h4>
		</div>
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Student </label>
            <select name="student_id" class="form-select" id="{{ $sickleave->s_id}}" required>
                <option value="{{ $sickleave->s_id}}">{{$sickleave->student_name}}</option>
                @foreach ($students as $data)
                <option value="{{$data->id}}">{{$data->name}}</option>
                @endforeach
            </select>
</div>

		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Date & Time</label>
			<input type="datetime-local" value="{{ $sickleave->date_time}}" name="date_time" class="form-control" id="recipient-name">
		</div>

		
        
        <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Reason</label>
            <input type="text" name="reason" class="form-select" value="{{ $sickleave->reason}}" id=""placeholder="Reason " required>

        </div>
        <div class="mb-3">
            <label for="recipient-name" class="col-form-label"> Session</label>
            <input type="text" name="session" class="form-select" value="{{ $sickleave->session}}" id=""placeholder="Session" required>

        </div>
        <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Teacher </label>
            <select name="teacher_id" class="form-select" id="{{ $sickleave->teacher_id}}" required>
                <option value="{{ $sickleave->teacher_id}}">{{$sickleave->teacher_name}}</option>
                @foreach ($users as $data)
                <option value="{{$data->id}}">{{$data->full_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="recipient-name" class="col-form-label"> Description</label>
            <input type="text" name="description" class="form-select" value="{{ $sickleave->description}}" id=""placeholder="Description " required>
         </div>
         <button style="margin-left:34%;" type="submit" class="btn btn-primary">Submit</button>

	</form>
</div>

@endsection
