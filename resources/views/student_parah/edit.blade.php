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

    <form action="{{ route('sparaupdate', $para->id) }}" method="POST">
        @csrf
        @method('PUT')
		<label class="form-label" for="customFile">Para Id</label>
		<input type="text" name="para_id" value="{{ $para->para_id}}" class="form-control" id="customFile" />
				

		<label class="form-label" for="customFile">student</label>
		<select name="student_id" class="form-select" id="" required>
			<option value="{{$para->student_id}}">{{ $para->student_id}}</option>
			@foreach ($students as $data )
			<option value="{{ $data->id}}">{{ $data->name}}</option>
			@endforeach
		</select>


		<label class="form-label" for="customFile">Para order</label>
		<select name="para_order" class="form-select" id="" required>
			<option value="{{ $para->student_id}}">{{ $para->para_order}}</option>
			@foreach ($paras as $data )
			<option value="{{ $data->id}}">{{ $data->para_name}}</option>
			@endforeach
		</select>

	<button style="margin-left:34%;" type="submit" class="btn btn-primary">Submit</button>
     <a href="{{route('student_based')}}" class="btn btn-danger">close</a>
    </div>
	</form>
</div>

@endsection































{{-- @endsection --}}