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

<form action="{{ route('strucupdate',$daily_naz->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
		<label class="form-label" for="customFile">Para id</label>
		<input type="text" name="para_id" value="{{ $daily_naz->para_id}}" class="form-control" id="customFile" />
				
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
		<label class="form-label" for="customFile">Arabic Date</label>
		<input type="text" name="arabic_date" value="{{ $daily_naz->arabic_date}}" class="form-control" id="customFile" />
		<button style="margin-left:34%;" type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
@endsection
