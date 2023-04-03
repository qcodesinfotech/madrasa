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
	<form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		<div class="mb-3">
			<h4 style="text-align:center;">Edit user Data</h4>
		</div>
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Name</label>
			<input type="text" value="{{ $user->full_name}}" name="full_name" class="form-control" id="recipient-name">
		</div>
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Mobile Number</label>
			<input type="text" value="{{ $user->phone}}" name="phone" class="form-control" id="recipient-name">
		</div>
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Whatsapp Number</label>
			<input type="text" value="{{ $user->phone2}}" name="phone2" class="form-control" id="recipient-name">
		</div>
		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Address</label>
			<input type="text" value="{{ $user->address}}" name="address" class="form-control" id="recipient-name">
		</div>
		<div class="mb-3">

			<input type="hidden" value="{{ $user->password}}" name="password" class="form-control" id="recipient-name">
		</div>
		<div class="mb-3">
			<label for="">Select Role</label>
<select name="role_id" id="" class="form-select">
	<?php if ($user->role_id == 1) { ?>
		<option value="1">Admin</option>
	<?php }elseif ($user->role_id == 2){ ?>
	        <option value="2">super Admin</option>
	<?php }elseif ($user->role_id == 0){ ?>
		<option value="0">Teacher</option>

		<?php } ?>
		<option value="1">Admin</option>
		<option value="2">super Admin</option>
		<option value="0">Teacher</option>

</select>

		</div>

		<div class="mb-3">
			<label for="recipient-name" class="col-form-label">Father</label>
			<input type="text" value="{{ $user->father}}" name="father" class="form-control" id="recipient-name">
		</div>


		<label class="form-label" for="customFile">Degree</label>
		<input type="text" name="degree" value="{{ $user->degree}}" class="form-control" id="customFile" />


		<label class="form-label" for="customFile">proof document image 1</label>
      <a href="{{ URL::asset('users_photo')}}/{{ $user->proof1}}">
        <img src="{{ URL::asset('users_photo')}}/{{ $user->proof1}}" height="35px" width="30px"></a>
		<input type="file" name="proof1" value="{{ $user->proof1}}" class="form-control" id="customFile" />

        <label class="form-label" for="customFile">proof document image 2</label>
		<a href="{{ URL::asset('users_photo')}}/{{ $user->proof2}}">
        <img src="{{ URL::asset('users_photo')}}/{{ $user->proof2}}" height="35px" width="30px"></a>

		<input type="file" name="proof2" value="{{ $user->proof2}}" class="form-control" id="customFile" />

        <label class="form-label" for="customFile">proof document image 3</label>
		<a href="{{ URL::asset('users_photo')}}/{{ $user->proof3}}">
        <img src="{{ URL::asset('users_photo')}}/{{ $user->proof3}}" height="35px" width="30px"></a>

		<input type="file" name="proof3" value="{{ $user->proof3}}" class="form-control" id="customFile" />

        <label class="form-label" for="customFile">proof document image 4</label>
		<a href="{{ URL::asset('users_photo')}}/{{ $user->proof4}}">
        <img src="{{ URL::asset('users_photo')}}/{{ $user->proof4}}" height="35px" width="30px"></a>

		<input type="file" name="proof4" value="{{ $user->proof4}}" class="form-control" id="customFile" />

        <label class="form-label" for="customFile">proof document image 5</label>
		<a href="{{ URL::asset('users_photo')}}/{{ $user->proof5}}">
        <img src="{{ URL::asset('users_photo')}}/{{ $user->proof5}}" height="35px" width="30px"></a>

		<input type="file" name="proof5" value="{{ $user->proof5}}" class="form-control" id="customFile" />

        <label class="form-label" for="customFile">proof document image 6</label>
		<a href="{{ URL::asset('users_photo')}}/{{ $user->proof6}}">
        <img src="{{ URL::asset('users_photo')}}/{{ $user->proof6}}" height="35px" width="30px"></a>

		<input type="file" name="proof6" value="{{ $user->proof6}}" class="form-control" id="customFile" />



		<button style="margin-left:34%;" type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>

@endsection
