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
	

<form action="{{ route('update_mark', $mark->id) }}" method="POST">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            {{-- <div class="form-group">
                <strong>Title:</strong>
                <input type="text" name="title" value="{{$course->title}}" class="form-control" placeholder="Name">
            </div> --}}
        



        <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{$mark->title}}"
            id="title">
        </div>
        <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Pass Mark</label>
            <input type="number" name="pass_mark" class="form-control" value="{{$mark->pass_mark}}"
            id="pass_mark">
        </div>
        <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Type</label>
            <input type="number" name="type" class="form-control" value="{{$mark->type}}"
            id="type">
        </div>
        <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Course</label>
            <select name="course_id" id="course_id" class="form-select">
                <option value="{{$mark->course_id}}">{{$mark->course}}</option>
                <?php foreach($course as $data){ ?>
                <option value="{{$data->id}}">{{$data->title}}</option>
                <?php } ?>
                </select>
            
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>
</form>
</div>

@endsection
