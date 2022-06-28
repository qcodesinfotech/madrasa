{{-- @extends('layouts.app')

@section('content') --}}

<style>
    .adj {
        padding: 10px;
    }
</style>
<div class="adj">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center font-weight-bolder">
                <h4 class="font-weight-bold">Edit Para</h4>
            </div>
            {{-- <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('board.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
        </div> --}}
    </div>
</div>

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
<form action="{{ route('para.update', $para->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Para Name:</strong>
                <input type="text" name="para_name" value="{{$para->para_name}}" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Para No:</strong>
                <input type="text" name="para_no" value="{{$para->para_no}}" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Rukus:</strong>
                <input type="text" name="rukus" value="{{$para->rukus}}" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('para.index')}}" class="btn btn-danger">close</a>
        </div>
    </div>

</form>
</div>
{{-- @endsection --}}