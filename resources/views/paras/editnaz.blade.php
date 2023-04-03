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

<form action="{{ route('nazupdate',$daily_naz->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		<label class="form-label" for="customFile">Arabic Date</label>
		<input type="text" name="arabic_date" value="{{ $daily_naz->arabic_date}}" class="form-control" id="customFile" />
		
		<label class="form-label" for="customFile">Day</label>
		<input type="text" name="day" value="{{ $daily_naz->day}}" class="form-control" id="customFile" />
		
		<label class="form-label" for="customFile">Old Exam</label>
		<input type="text" name="old_exam" value="{{ $daily_naz->old_exam}}" class="form-control" id="customFile" />
	
		<label class="form-label" for="customFile">Exam 3</label>
		<input type="text" name="exam_3" value="{{ $daily_naz->exam_3}}" class="form-control" id="customFile" />
		
		
		<label class="form-label" for="customFile">Exam 2</label>
		<input type="text" name="exam_2" value="{{ $daily_naz->exam_2}}" class="form-control" id="customFile" />

		<label class="form-label" for="customFile">Exam 1</label>
		<input type="text" name="exam_1" value="{{ $daily_naz->exam_1}}" class="form-control" id="customFile" />
		
		
		<label class="form-label" for="customFile">Total</label>
		<input type="text" name="total" value="{{ $daily_naz->total}}" class="form-control" id="customFile" />
		
		<label class="form-label" for="customFile">Revision</label>
		<input type="text" name="revision" value="{{ $daily_naz->revision}}" class="form-control" id="customFile" />
		
		<label class="form-label" for="customFile">N Exam</label>
		<input type="text" name="n_exam" value="{{ $daily_naz->n_exam}}" class="form-control" id="customFile" />
		
		<label class="form-label" for="customFile">Total sub Week</label>
		<input type="text" name="total_sub_week" value="{{ $daily_naz->total_sub_week}}" class="form-control" id="customFile" />
		
		<label class="form-label" for="customFile">Ruku</label>
		<input type="text" name="ruku" value="{{ $daily_naz->ruku}}" class="form-control" id="customFile" />
		
		<label class="form-label" for="customFile">Nisf</label>
		<input type="text" name="nisf" value="{{ $daily_naz->nisf}}" class="form-control" id="customFile" />
		
		<label class="form-label" for="customFile">Overall Para</label>
		<input type="text" name="overall_para" value="{{ $daily_naz->overall_para}}" class="form-control" id="customFile" />
		
		<label class="form-label" for="customFile">Teacher</label>
		<select name="teacher_id" class="form-select" id="" required>
			<option value="{{ $daily_naz->teacher_id}}">{{ $daily_naz->teacher}}</option>
		@foreach ($users as $data )
		<option value="{{ $data->id}}">{{ $data->full_name}}</option>
		@endforeach	
		</select>		
	
		<label class="form-label" for="customFile">student</label>
		<select name="student_id" class="form-select" id="" required>
			<option value="{{ $daily_naz->student_id}}">{{ $daily_naz->name}}</option>
			@foreach ($students as $data )
			<option value="{{ $data->id}}">{{ $data->name}}</option>
			@endforeach
		</select>

		<button style="margin-left:34%;" type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>

@endsection
