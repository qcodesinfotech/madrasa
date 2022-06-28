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
        <form action="{{ route('assign.update', $syllabi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label" for="customFile">Name</label>
                <select name="name" class="form-select" id="" required>
                    <option value="{{ $syllabi->student_id }}">{{ $syllabi->name }}</option>
                    @foreach ($student as $data)
                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                </select>
                <label class="form-label" for="customFile">Course</label>
                <select name="course" class="form-select" id="" required>
                    <option value="{{ $syllabi->type_syllabus_id }}">{{ $syllabi->syllabus_type }}</option>
                    @foreach ($syllabus_type as $data)
                        <option value="{{ $data->id }}">{{ $data->title }}</option>
                    @endforeach
                </select>
                <label class="form-label" for="customFile">Month</label>
                <select name="month" class="form-select" id="" required>
                    <option value="{{ $syllabi->month }}">{{ $syllabi->months }}</option>
                    @foreach ($month as $data)
                        <option value="{{ $data->id }}">{{ $data->month }}</option>
                    @endforeach
                </select>
                
                <label class="form-label" for="customFile">Year</label>
                <select name="year" class="form-select" id="" required>
                    <option value="{{ $syllabi->year_id }}">{{ $syllabi->course_year }}</option>
                    @foreach ($course as $data)
                        <option value="{{ $data->id }}">{{ $data->title }}</option>
                    @endforeach
                </select>
            </div>

            <button style="margin-left:34%;" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
