@extends('layouts.master')
@section('content')

    <?php

    use Illuminate\Support\Facades\DB;

    ?>
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

        .cell {
            text-align: center;
        }

        .key {
            display: flex;
        }

        .key a {
            width: 100%;
            padding: 10px;
        }

        .key a:hover {
            background-color: rgba(231, 231, 231, 0.685);
            color: rgb(47, 172, 255);
            font-size: 17px;
        }

        .table .app-table-hover .mb-0 .text-left {
            width: 100% !important;
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
                                    style="border-radius:5px;padding:4px;background-color:rgb(255, 255, 255);border:1px solid #676778;;color:#676778; "
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
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ route('promote') }}" method="get"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('get')

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
                                                            <select list="browsers" class="form-select" name="student"
                                                                id="student">
                                                                <datalist id="browsers">
                                                                    <option value="">Select Student</option>
                                                                    @foreach ($std as $data)
                                                                        <option value="{{ $data->name }}">
                                                                            {{ $data->name }}</option>
                                                                    @endforeach
                                                                </datalist>
                                                            </select>
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
                                                                {{-- <select name="medium_id" class="form-select" id="medium" required> --}}
                                                                <?php

                                                                ?>
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
                                                                <label for="recipient-name"
                                                                    class="col-form-label">Date</label>
                                                                <input type="date" name="date" class="form-control">
                                                            </div>
                                                        </div>

                                                    </div>

                                            </div>

                                            <div class="modal-footer">
                                                {{-- <a href="" class="btn btn-secondary">Close</a> --}}



                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="submit"
                                                    class="btn btn-primary">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <div class="modal fade" id="laravel" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Enter Student</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="{{ route('student.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Student
                                                    Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    id="recipient-name" required>
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


                                            <?php

                                            $admission = DB::table('students')

                                                ->orderBy('students.admission_no', 'desc')
                                                ->first();

                                            if (isset($student)) {
                                                $student = $student;
                                            } else {
                                                $student = $student1;
                                            }
                                            ?>
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Admission
                                                    NO</label>
                                                <input type="number" name="admission_no"
                                                    value={{ $admission->admission_no + 1 }} class="form-control"
                                                    id="recipient-name">
                                            </div>

                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Admission Date</label>
                                                <input type="date" name="admission_date" class="form-control"
                                                    id="recipient-name" style="uppercase" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">arabic Date</label>
                                                <input type="number" placeholder="DD-MM-YYYY" name="arabic_date"
                                                    class="form-control" id="recipient-name" required>
                                                <span class="error datevalidate" style="color:red;"
                                                    id="date-error"></span>

                                            </div>
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Mobile NO</label>
                                                <input type="number" name="mobile_no" class="form-control"
                                                    id="recipient-name">
                                            </div>
                                            <div class="mb-3">
                                                <div id="selection">
                                                    <label for="recipient-name" class="col-form-label">Address</label><br>
                                                    <select name="state" class="iput" id="listBox"
                                                        onchange='selct_district(this.value)'></select>
                                                    <select name="district" class="output" id='secondlist'>
                                                        <option value="">Select Dist</option>
                                                    </select>
                                                    <br>
                                                    <input type="text" name="city" class="output"
                                                        placeholder="city" required>
                                                    <input type="text" name="pincode" class="input"
                                                        placeholder="Pincode" required>
                                                </div>
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
                                                    <input type="number" name="whatsapp_no" class="form-control"
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
                                                    <label class="form-label" for="customFile">Student Adharcard</label>
                                                    <input type="file" name="proof1" class="form-control"
                                                        id="customFile" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="customFile">Student School
                                                        certificate</label>
                                                    <input type="file" name="proof2" class="form-control"
                                                        id="customFile" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="customFile">Parents Adharcard</label>
                                                    <input type="file" name="proof3" class="form-control"
                                                        id="customFile" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="customFile">Mohalla Jamat
                                                        Letter</label>
                                                    <input type="file" name="proof4" class="form-control"
                                                        id="customFile" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="customFile">Parents Razi Nama</label>
                                                    <input type="file" name="proof5" class="form-control"
                                                        id="customFile" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="customFile">Madarsa - Iqrarnama</label>
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





            {{-- ////remark/// --}}



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



                            <div class="key">
                                <a href="#" id="s1" class="cell"
                                    onclick="myfun1('rgb(231,231,231)')">Overall Students</a>
                                <a href="#" class="cell" id="s2"
                                    onclick="myfun2('rgb(231,231,231)')">Active Students</a>
                                <a href="#" class="cell" id="s3"
                                    onclick="myfun3('rgb(231,231,231)')">Discontinued Students</a>
                            </div>




                            <table class="table app-table-hover mb-0 text-left" id="managementlvc">
                                <thead>
                                    <tr>
                                        <th class="cell">SNo</th>
                                        <th class="cell">student pic</th>
                                        <th class="cell">Student Name</th>
                                        <th class="cell">Admission NO</th>
                                        <th class="cell">Course</th>
                                        <th class="cell">Admission Date</th>
                                        <th class="cell">City</th>
                                        <th class="cell">Address</th>
                                        <th class="cell">Mobile &<br> whatsapp </th>
                                        {{-- <th class="cell">Status</th> --}}
                                        <th class="cell">Show</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody> <?php $i = 1;
                                $imagetick = 'https://support.content.office.net/en-us/media/5e6bcf49-2b5f-42c6-9c53-91badba25aaf.png';
                                $imagewrong =
                                    'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAS1BMVEX///8AAAD7+/umpqajo6MICAj5+fkEBASgoKCpqamdnZ2srKzCwsK7u7uZmZnNzc0mJiYfHx/S0tLJyckODg5tbW0jIyMuLi7Dw8PK7dIsAAAE70lEQVR4nO2c4ZqaMBBFSRTQLVbX1W3f/0kbEAxKnAQySzL2nv3ZfpELySHAJEUBAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACwLrr7K7TWjI1WVTW0np4u2WFXVKyNVsXuwNlgDJWJeFSKN2JVfCh1zuIKdhw+VRuREb0zLX5mchXNFfxUl1KpDWOjm1KVtTodGZtcRGcXfVCqVi08EbXpotuuPdNqw+qvJQdjfv9w6gMyRdRDwDbiqeFocjmVCfillOlR/SFtGXTTSaYPaE5d4o6qW8mYA7ldxLKNGM/H0OtNg+YqHtLeFL+6gP0RGTeofXST23vA+tZRj2kS3uYxd8lY4saiudE/tdfphumgZ3GbyZwmAaMimkafA6bTTT+TsZKxLNeNlcw4YDrdjCVjidLNbzU9Y6l0081krGRGBxShG9NFJ2fsrpu1aSVzmXSp5WPRzmRclCl0s3V0qIiImgrYXkiOO+0splp/ZK5uXJIZw/z8GQB9zhfo5mN6a308YWv30sr8bV4nnK2bLRlwb34tyW1/bw7r9WAMH4tklzc/8OsHM3hg0Y1zJjMOuLpkLORYVKG68UmG45EsgtdjMfzsu2Yyln2R+Dk/XjeumUxGAWN1k7FkLBG6yVkylhjdZC4Zy3LdZC4Zy1LdZC8Zy3zd0I9L2UjGMls37FP3H2a+bsRIxjJXN/TjUlZjcGCebnyPSxkGnKMbETMZF4G6kTGTcRGqG4GSsYTpRsxMxkWIbgTNZFzQutnf/gdxnbOVjMWnG463Aknx6eZK/mvWkrHQV0mwZCxERCqfnIA+3bxKLkAyFlo37oACJGPx6caFEMlYqLHoQtAYHJgXUWDAGbqRJhlLoG6kScYSrhtxkrGEjUWRY3AgJKIJuPpHekb2ZU08C6paXeKrGROzo16p1bzV4Umoiish1FJdUx9gPG9/Dd98HPpKw27IvYr0i993iOh78WsRO6ehX/zekTsvpV/8jhKyLGJYGc8nbAfSxiL9CfsdIoZLxiJMN/QnbAfSdEN/wnYmlKQbeiZD3T9kjEXvJ2zWRQwp8EimvJKTABG68X3Cpj+QCtCN7xM29Q1YgG7C6mS4FjGsT3CdDPOaqfUIrZPhWcSQhPA6GaHlCt46mdGLX841U6ug9dxiPGm6WVCMJ0w384vxxOnm94KCWFG62S4qxhOjm+UVvzJ0E1XxK0I3MRW/QnQTV/ErQDexFb9Z64Zn7VLOumFau5SxbniWFWStG661S9nqhm/tUoa6aR+X6DM/rxjPt4ghwb4Yvqna3K5F6ybJ3ia8a5d8ull/f5ofWD9Id/r1bxoN1auWVRu+jnhJsi3d8dTvwzU930srfl26Ket2P7Hv9fejHbb1dGyvFnH/cuimbje9OzVpSlCPyrFfW9yee1PddLv6nbtdmxLQuPZNjKv4nY7FWv1pum0o+Y47HN1Mx2FsSfNzxGHvyzSF0vpJNyzLCqxukknGYs7rWDdMk+S7bjrJfDepd/V+0A3PPsKDbnrJ6NQR/1rdcC0rGMZiUsnc0VY3fOsmNo+SSf7CrdWNGYycT3Gbsm3SSCYTbvvqc/Yl3T65fCeayUzRxZn78Ua3ujl3L/My4cD9iGoiHtp4OVzD/hgq3rPdt5pJLwUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAwP/EP2d3K65r8T+LAAAAAElFTkSuQmCC';
                                ?>


                                    @foreach ($student as $data)
                                        <?php $city = explode(',', $data->address)[0];
                                        // print_r($city);
                                        ?>
                                        <tr>
                                            <td class="cell">{{ $i++ }}</td>
                                            <?php if($data->student_pic == null){ ?>

                                            <td class="cell"><img src="students_photo/studentpic.png" alt="profile"
                                                    width="30px"></td>

                                            <?php }else{ ?>
                                            <td class="cell"><img src="students_photo/{{ $data->student_pic }}"
                                                    alt="profile" width="50px"></td>

                                            <?php } ?>
                                            <td class="cell">{{ $data->name }}-{{ $city }}</td>
                                            <td class="cell">{{ $data->admission_no }}</td>
                                            <td class="cell">{{ $data->course }}</td>
                                            <td class="cell">{{ $data->Admission_date }}</td>
                                            <td class="cell">{{ $city }}</td>
                                            <td class="cell">{{ $data->address }}</td>
                                            <td class="cell">
                                                {{ $data->mobile_no }}<br>{{ $data->whatsapp_no }}</td>
                                            </td>

                                            <?php
                                                 if (!empty($data->name)){?>
                                            <td class="cell">
                                                <a href="{{ route('studentview', $data->id) }}"
                                                    class="btn btn-seconday"><i class="fas fa-eye fa-1x"></i></a>
                                            </td>
                                            <?php }else{ ?>
                                            <td class="cell"></td>
                                            <?php }?>
                                            <td class="cell">
                                                <a href="{{ route('student.edit', $data->id) }}"
                                                    class="btn btn-primary"><i class="fas fa-edit fa-1x"></i></a>



                                                <form action="{{ route('student.destroy', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('are you sure want to delete this student ?');"
                                                        class="btn btn-danger"><i class="fas fa-trash fa-1x"></i></button>
                                            </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="table app-table-hover mb-0 text-left" id="schoollvc" style="display:none;">
                                <thead>
                                    <tr>
                                        <th class="cell">SNo</th>
                                        <th class="cell">student pic</th>
                                        <th class="cell">Student Name</th>
                                        <th class="cell">Admission NO</th>
                                        <th class="cell">Course</th>
                                        <th class="cell">Admission Date</th>
                                        <th class="cell">City</th>
                                        <th class="cell">Address</th>
                                        <th class="cell">Mobile &<br> whatsapp </th>
                                        <th class="cell">Show</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody> <?php $i = 1; ?>


                                    @foreach ($active_student as $data)
                                        <tr>
                                            <?php $city = explode(',', $data->address)[0];

                                            ?>
                                            <td class="cell">{{ $i++ }}</td>
                                            <?php if($data->student_pic == null){ ?>

                                            <td class="cell"><img src="students_photo/studentpic.png" alt="profile"
                                                    width="30px"></td>

                                            <?php }else{ ?>
                                            <td class="cell"><img src="students_photo/{{ $data->student_pic }}"
                                                    alt="profile" width="50px"></td>

                                            <?php } ?>
                                            <td class="cell">{{ $data->name }}-{{ $city }}</td>
                                            <td class="cell">{{ $data->admission_no }}</td>
                                            <td class="cell">{{ $data->course }}</td>
                                            <td class="cell">{{ $data->Admission_date }}</td>
                                            <td class="cell">{{ $city }}</td>
                                            <td class="cell">{{ $data->address }}</td>
                                            <td class="cell">
                                                {{ $data->mobile_no }}<br>{{ $data->whatsapp_no }}</td>
                                            </td>
                                            <?php if (!empty($data->name)){?>
                                            <td class="cell">
                                                <a href="{{ route('studentview', $data->id) }}"
                                                    class="btn btn-seconday"><i class="fas fa-eye fa-1x"></i></a>
                                            </td>
                                            <?php }else{?>
                                            <td class="cell"></td>
                                            <?php }?>
                                            <td class="cell">
                                                <a href="{{ route('student.edit', $data->id) }}"
                                                    class="btn btn-primary"><i class="fas fa-edit fa-1x"></i></a>



                                                <form action="{{ route('student.destroy', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('are you sure want to delete this student ?');"
                                                        class="btn btn-danger"><i class="fas fa-trash fa-1x"></i></button>
                                            </td>
                                            </form>
                                        </tr>
                                        </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table style="display:none;" class="table app-table-hover mb-0 text-left" id="teacherlvc">
                                <thead>
                                    <tr>
                                        <th class="cell">SNo</th>
                                        <th class="cell">student pic</th>
                                        <th class="cell">Student Name</th>
                                        <th class="cell">Admission NO</th>
                                        <th class="cell">Course</th>
                                        <th class="cell">Admission Date</th>
                                        <th class="cell">City</th>
                                        <th class="cell">Address</th>
                                        <th class="cell">Mobile &<br> whatsapp </th>
                                        <th class="cell">Remark</th>
                                        <th class="cell">Show</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody> <?php $i = 1; ?>


                                    @foreach ($discontiune_student as $data)
                                        <tr>
                                            <?php $city = explode(',', $data->address)[0];

                                            ?>
                                            <td class="cell">{{ $i++ }}</td>
                                            <?php if($data->student_pic == null){ ?>

                                            <td class="cell"><img src="students_photo/studentpic.png" alt="profile"
                                                    width="30px"></td>

                                            <?php }else{ ?>
                                            <td class="cell"><img src="students_photo/{{ $data->student_pic }}"
                                                    alt="profile" width="50px"></td>

                                            <?php } ?>
                                            <td class="cell">{{ $data->name }}-{{ $city }}</td>
                                            <td class="cell">{{ $data->admission_no }}</td>
                                            <td class="cell">{{ $data->course }}</td>
                                            <td class="cell">{{ $data->Admission_date }}</td>
                                            <td class="cell">{{ $city }}</td>
                                            <td class="cell">{{ $data->address }}</td>
                                            <td class="cell">
                                                {{ $data->mobile_no }}<br>{{ $data->whatsapp_no }}</td>
                                            </td>
                                            <td class="cell">{{ $data->remark }}</td>
                                            <?php if (!empty($data->name)){?>
                                            <td class="cell">
                                                <a href="{{ route('studentview', $data->id) }}"
                                                    class="btn btn-seconday"><i class="fas fa-eye fa-1x"></i></a>
                                            </td>
                                            <?php }else{?>
                                            <td class="cell"></td>
                                            <?php }?>
                                            <td class="cell">
                                                <a href="{{ route('student.edit', $data->id) }}"
                                                    class="btn btn-primary"><i class="fas fa-edit fa-1x"></i></a>
                                                <form action="{{ route('student.destroy', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('are you sure want to delete this student ?');"
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





                function datevalidate(date) {

                    var datelength = date.value?.split('/').length
                    console.log(date.value)
                    var datearray = date.value?.split('/');
                    var stringlenth = date.value.length;
                    if (datelength == 3) {

                        console.log("formate correct")
                        console.log(datearray[0])
                        if (datearray[0].length != 2) {
                            document.getElementById("date-error").innerHTML = "Date formate should be DD/MM/YYYY";
                        }
                        console.log(datearray[1])
                        if (datearray[1].length != 2) {
                            document.getElementById("date-error").innerHTML = "Date formate should be DD/MM/YYYY";
                        }
                        console.log(datearray[2])
                        if (datearray[2].length != 4) {
                            document.getElementById("date-error").innerHTML = "Date formate should be DD/MM/YYYY";
                        }

                    } else if (datelength => 0) {
                        document.getElementById("date-error").innerHTML = "Date formate should be DD/MM/YYYY";
                    } else if (stringlenth => 10) {
                        console.log("string correct")
                    } else {
                        document.getElementById("date-error").innerHTML = "Date formate should be DD/MM/YYYY";
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




                function myfun1(color) {
                    document.getElementById('managementlvc').style.display = "";
                    document.getElementById('schoollvc').style.display = "none";

                    document.getElementById('s2').style.background = "none";
                    document.getElementById('s1').style.background = color;
                    document.getElementById('teacherlvc').style.display = "none";
                    document.getElementById('s3').style.background = "none";
                }

                function myfun2(color) {
                    document.getElementById('s2').style.background = color;
                    document.getElementById('s1').style.background = "none";
                    document.getElementById('s3').style.background = "none";
                    document.getElementById('schoollvc').style.display = "";
                    document.getElementById('teacherlvc').style.display = "none";
                    document.getElementById('managementlvc').style.display = "none";
                }

                function myfun3(color) {
                    document.getElementById('s1').style.background = "none";
                    document.getElementById('s3').style.background = color;
                    document.getElementById('s2').style.background = "none";
                    document.getElementById('schoollvc').style.display = "none";
                    document.getElementById('teacherlvc').style.display = "";
                    document.getElementById('managementlvc').style.display = "none";
                }


                // $('#student').change(function() {
                //     var studentId = $(this).val();

                //     if (studentId) {
                //         $.ajax({
                //             type: "GET",
                //             url: "{{ url('studentfound') }}?student_id=" + studentId,
                //             success: function(res) {
                //                 if (res) {
                //                     $("#coure").empty();
                //                     $("#coure").append('<option>Select coure</option>');
                //                     $.each(res, function(key, value) {
                //                         $("#coure").append('<option value="' + key +
                //                             '">' + value +
                //                             '</option>');
                //                     });
                //                 } else {
                //                     $("#coure").empty();
                //                 }
                //             }
                //         });
                //     } else {
                //         $("#coure").empty();
                //         $("#per").empty();
                //     }
                // });
            </script>
        @endsection
