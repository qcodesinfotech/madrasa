@extends('layouts.master')
@section('content')
    <script language="Javascript" src="admin/jquery.js"></script>
    <script type="text/JavaScript" src='admin/state.js'></script>
    <style>
        .input {
            border: 1px solid gray;
            border-radius: 2px;
            width: 70px;
            height: 39px;
        }

        .iput {
            border: 1px solid gray;
            border-radius: 2px;
            width: 150px;
            height: 39px;
        }


        .output {
            border: 1px solid gray;
            border-radius: 2px;
            height: 39px;
            width: 300px;
        }


        th.cell,
        td {
            text-align: center;
        }

    </style>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Students</h1>
                    </div>
           
                    <?php
                    if (isset($student)) {
                        $student = $student;
                    } else {
                        $student = $student1;
                    }
                    ?>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <form action="{{ route('searchstudent') }}" method="post"
                                        class="table-search-form row gx-1 align-items-center">
                                        @csrf
                                        @method('POST')
                                        <div class="col-auto">
                                            <input type="text" id="search-orders" name="student"
                                                class="form-control search-orders" placeholder="Search">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn app-btn-secondary">Search</button>
                                        </div>
                                    </form>
                                </div>
                                <button type="button" onMouseOver="this.style.color='#15A362'"
                                    onMouseOut="this.style.color='#676778'"
                                    style="border-radius:5px;padding:4px;background-color:white;border:1px solid #676778;;color:#676778; "
                                    class="col-auto" data-bs-toggle="modal" data-bs-target="#laravel">Add
                                    Student</button>
                                <button type="button" onMouseOver="this.style.color='#15A362'"
                                    onMouseOut="this.style.color='#676778'"
                                    style="border-radius:5px;padding:4px;background-color:white;border:1px solid #676778;;color:#676778; "
                                    class="col-auto" data-bs-toggle="modal" data-bs-target="#prom"
                                    data-bs-whatever="@getbootstrap"><i class="fa fa-plus" aria-hidden="true"></i>
                                    promote student
                                </button>
                                <div class="modal fade" id="prom" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">

                                        <div class="modal-content">
                                            
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Promote Students</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ route('promote') }}" method="POST">
                                                    @csrf

                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Select
                                                            Type</label>

                                                        <select name="demo" id="" class="form-select"
                                                            onchange="showDiv0(this)" required>
                                                            <option value="">Select option</option>
                                                            <option value="1">Single Student</option>
                                                            <option value="2">Bulk Student</option>
                                                        </select>
                                                    </div>

                                                    <div style="display:none;" id="view">
                                                        <div class="mb-3" id="view2">
                                                            <label for="recipient-name" class="col-form-label">Select
                                                                student</label>
                                                            <input list="browsers" class="form-select" name="student"
                                                                id="student">
                                                            <datalist id="browsers">
                                                                @foreach ($student as $data)
                                                                    <option value="{{ $data->name }}">
                                                                @endforeach
                                                            </datalist>
                                                        </div>
                                                        <div class="mb-3" style="padding:17px;width:100%;">
                                                            <label for="recipient-name" class="col-form-label">From
                                                                Course</label>
                                                            <label style="margin-left: 100px;" for="recipient-name"
                                                                class="col-form-label">To
                                                                Course
                                                            </label>
                            
                                                            <br>

                                                            <div style="display: flex;">
                                                                <select name="course1" class="form-select"
                                                                    style="width:170px; margin-left:2px;" id="coure"
                                                                    required>
                                                                    @foreach ($course as $data)
                                                                        <option value={{ $data->id }}>
                                                                            {{ $data->title }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <select name="course2" class="form-select"
                                                                    style="width:170px; margin-left:10px;" required>
                                                                    @foreach ($course as $data)
                                                                        <option value={{ $data->id }}>
                                                                            {{ $data->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                        <label for="recipient-name"  class="col-form-label">Date</label>
                                                           <input type="date" name="date" class="form-control">
                                                            </div>
                                                        </div>

                                                    </div>

                                            </div>

                                            <div class="modal-footer">
                                                <a href="" class="btn btn-secondary">Close</a>
                                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="laravel" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Enter Question</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <strong>Whoops!</strong> There were some problems with your
                                                input.<br><br>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <form action="{{ route('student.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Student
                                                    Name</label>
                                                <input type="text" name="name" class="form-control" id="recipient-name">
                                            </div>
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Course</label><br>
                                                <select class="form-select" name="course" required>

                                                    <option value="">Select Course</option>
                                                    @foreach ($course as $data)
                                                        <option value={{ $data->id }}>{{ $data->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Admission
                                                    NO</label>
                                                <input type="text" name="admission_no" class="form-control"
                                                    id="recipient-name">
                                            </div>

                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Admission Date</label>
                                                <input type="date" name="admission_date" class="form-control"
                                                    id="recipient-name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Mobile NO</label>
                                                <input type="text" name="mobile_no" class="form-control"
                                                    id="recipient-name">
                                            </div>
                                            <div class="mb-3" id="ex">
                                                <a class="btn" onClick="showex()" style="color:blue;">Click here
                                                    To Add more Information</a>
                                            </div>


                                            <div id="addition" style="display:none">
                                                <div class="mb-3">
                                                    <a class="btn" onClick="showlx()" style="color:red;">Click
                                                        here to Close</a>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Whatsapp
                                                        NO</label>
                                                    <input type="text" name="whatsapp_no" class="form-control"
                                                        id="recipient-name">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Blood Group</label>
                                                    <input type="text" name="blood_group" class="form-control"
                                                        id="recipient-name">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Father
                                                        Occupation</label>
                                                    <input type="text" name="father_occupation" class="form-control"
                                                        id="recipient-name">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Aadhar NO</label>
                                                    <input type="text" name="aadhar_no" class="form-control"
                                                        id="recipient-name">
                                                </div>


                                                <div class="mb-3">
                                                    <label for="recipient-name"
                                                        class="col-form-label">Previous-school</label>
                                                    <input type="text" name="previous_school" class="form-control"
                                                        id="recipient-name">
                                                </div>


                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Father
                                                        Name</label>
                                                    <input type="text" name="father_name" class="form-control"
                                                        id="recipient-name">
                                                </div>

                                                <div class="mb-3">
                                                    <div id="selection">
                                                        <label for="recipient-name"
                                                            class="col-form-label">Address</label><br>
                                                        <select name="state" class="iput" id="listBox"
                                                            onchange='selct_district(this.value)'>></select>
                                                        <select name="district" class="output" id='secondlist'>
                                                            <option value="">Select Dist</option>
                                                        </select>
                                                        <br>
                                                        <input type="text" name="city" class="output"
                                                            placeholder="city">
                                                        <input type="text" name="pincode" class="input"
                                                            placeholder="Pincode">
                                                    </div>

                                                </div>
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Monthly
                                                        Donation</label>
                                                    <input type="number" name="monthly_donation" class="form-control"
                                                        id="recipient-name">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Date Of
                                                        Birth</label>
                                                    <input type="date" name="date_of_birth" class="form-control"
                                                        id="recipient-name">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label" for="customFile">Student Picture</label>
                                                    <input type="file" name="student_pic" class="form-control"
                                                        id="customFile" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="customFile">Proof 1</label>
                                                    <input type="file" name="proof1" class="form-control"
                                                        id="customFile" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="customFile">Proof 2</label>
                                                    <input type="file" name="proof2" class="form-control"
                                                        id="customFile" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="customFile">Proof 3</label>
                                                    <input type="file" name="proof3" class="form-control"
                                                        id="customFile" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="customFile">Proof 4</label>
                                                    <input type="file" name="proof4" class="form-control"
                                                        id="customFile" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="customFile">Proof 5</label>
                                                    <input type="file" name="proof5" class="form-control"
                                                        id="customFile" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="customFile">Proof 6</label>
                                                    <input type="file" name="proof6" class="form-control"
                                                        id="customFile" />
                                                </div>
                                            </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>

                                    <div id="dumdiv" align="center" style=" font-size: 10px;color: #dadada;"> </div>
                                    <a id="dum"
                                        style="padding-right:0px; text-decoration:none;color: green;text-align:center;"
                                        href="http://www.hscripts.com"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
            <!--//col-auto-->
        </div>
        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">#</th>
                                        <th class="cell">student pic</th>
                                        <th class="cell">Student Name</th>
                                        <th class="cell">Admission NO</th>
                                        <th class="cell">Course</th>
                                        <th class="cell">Admission Date</th>
                                        <th class="cell">Mobile &<br> whatsapp </th>
                                        <th class="cell">Show</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody> <?php $i = 1; ?>
                         

                                    @foreach ($student as $data)
                                        <tr>
                                            <td class="cell">{{ $i++ }}</td>
                                            <td class="cell"><img src="students_photo/{{ $data->student_pic }}"
                                                    alt="" width="40px"></td>
                                            <td class="cell">{{ $data->name }}</td>
                                            <td class="cell">{{ $data->admission_no }}</td>
                                            <td class="cell">{{ $data->course }}</td>
                                            <td class="cell">{{ $data->Admission_date }}</td>
                                            <td class="cell">
                                                {{ $data->mobile_no }}<br>{{ $data->whatsapp_no }}</td>
                                            </td>
                                            <td class="cell">
                                                <a href="{{ route('studentview', $data->id) }}"
                                                    class="btn btn-seconday"><i class="fas fa-eye fa-1x"></i></a>
                                            </td>
                                            <td class="cell" style="display:flex;">
                                                <a href="{{ route('student.edit', $data->id) }}"
                                                    class="btn btn-primary"><i class="fas fa-edit fa-1x"></i></a>
                                               
                                               
                                               
                                                    <form action="{{ route('student.destroy', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm(' you want to delete?');"
                                                        class="btn btn-danger"><i class="fas fa-trash fa-1x"></i></button>
                                            </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--//table-responsive-->
                    </div>
                    <!--//app-card-body-->
                </div>
                <!--//app-card-->
            </div>



            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script>
                function showex() {
                    document.getElementById('addition').style.display = "inline";
                    document.getElementById('ex').style.display = "none";
                }

                function showlx() {
                    document.getElementById('addition').style.display = "none";
                    document.getElementById('ex').style.display = "inline";


                }

                function showDiv0(select1) {
                    if (select1.value == "1") {
                        document.getElementById('view').style.display = "inline";
                        document.getElementById('view2').style.display = "inline";

                    } else if (select1.value == "2") {
                        document.getElementById('view2').style.display = "none";
                        document.getElementById('view').style.display = "inline";


                    } else {
                        document.getElementById('view').style.display = "none";

                    }
                }

                $('#student').on('change', function() {
                    var studentID = $(this).val();

                    if (studentID) {
                        $.ajax({
                            type: "GET",
                            url: "{{ url('getstud') }}?student_id=" + studentID,
                            success: function(res) {
                                if (res) {
                                    $("#coure").empty();
                                    $("#coure").append('');
                                    $.each(res, function(key, value) {
                                        $("#coure").append('<option value="' + key + '">' + value +
                                            '</option>');
                                    });
                                } else {
                                    // $("#coure").empty();
                                }
                            }
                        });
                    } else {
                        // $("#coure").empty();
                    }
                });
            </script>
        @endsection
