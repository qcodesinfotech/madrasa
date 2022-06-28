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
	<form action="{{ route('syllabus.update', $syllabi->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="mb-3">
                <label for="recipient-name" class="col-form-label">Syllabus Type</label>
                <select name="syllabus_id" class="form-select" id="" required>
                    <option value="{{ $syllabi->syllabus_id}}">{{ $syllabi->syllabus_type}}</option>
                    @foreach($syllabus as $data )
                    <option value="{{$data->id}}">{{$data->title}}</option>
                    @endforeach
                </select>
		</div>

		<label class="form-label" for="customFile">Target1</label>
		<input type="text" name="target1" value="{{ $syllabi->target1}}" class="form-control" id="customFile" />
		<label class="form-label" for="customFile">Target2</label>
		<input type="text" name="target2" value="{{ $syllabi->target2}}" class="form-control" id="customFile" />
		<label class="form-label" for="customFile">Target3</label>
		<input type="text" name="target3" value="{{ $syllabi->target3}}" class="form-control" id="customFile" />
		<label class="form-label" for="customFile">Target4</label>
		<input type="text" name="target4" value="{{ $syllabi->target4}}" class="form-control" id="customFile" />
		<label class="form-label" for="customFile">Target5</label>
		<input type="text" name="target5" value="{{ $syllabi->target5}}" class="form-control" id="customFile" />
		<label class="form-label" for="customFile">Target6</label>
		<input type="text" name="target6" value="{{ $syllabi->target6}}" class="form-control" id="customFile" />

		<label class="form-label" for="customFile">Total</label>
		<input type="text" name="total" value="{{ $syllabi->total}}" class="form-control" id="customFile" />

<button style="margin-left:34%;" type="submit" class="btn btn-primary">Submit</button>
<a href="{{route('syllabus.index')}}" class="btn btn-danger">close</a>
	</form>
</div>

@endsection
