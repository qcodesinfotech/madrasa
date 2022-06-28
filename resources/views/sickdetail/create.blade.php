@extends('students.layout')
@section('content')

<div class="pull-left">
    <h2>Students Details</h2>
</div>

<div class="row">
    <div class="col-12 margin-tb">
        <div class ="pull-right">
            <a class ="btn btn-primary" href="{{route('Sick.index') }}">Back  </a>
</div>
</div>
<div>
 

<form action ="/user" method="POST">
    {{ csrf_field() }}
@method('POST')
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class ="form-group">
        <strong>Student Id<strong>
            <input type ="number" name="s_id" class="form-control" placeholder="student id" required>
</div>
</div>


    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class ="form-group">
        <strong>Date&Time<strong>
            <input type ="date" name="date&time" class="form-control" placeholder="date&time" required>
</div>
</div>


<div class="col-xs-12 col-sm-12 col-md-12">
        <div class ="form-group">
        <strong>Reason<strong>
            <input type ="text" name="reason" class="form-control" placeholder="reason" required>
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
    <div class ="form-group">
    <strong>Session<strong>
        <input type ="text" name="session" class="form-control" placeholder="session" required>
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
    <div class ="form-group">
    <strong>Teacher Id<strong>
        <input type ="number" name="teacher_id" class="form-control" placeholder="teacher id" required>
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
    <div class ="form-group">
    <strong>Description<strong>
        <input type ="text" name="description" class="form-control" placeholder="description" required>
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 text-center">
<button type="submit" class="btn btn-primary">Submit</button>
</div>
</div>
</form>
@endsection