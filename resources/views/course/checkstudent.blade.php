@extends('layouts.master')
@section('content')
    <?php
    use App\Models\student_based_para;
    use Illuminate\Support\Facades\DB;
    
    ?>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">TEACHER </h1>
                    </div>






                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <style>
                                        input {
                                            text-transform: capitalize;
                                        }

                                        .cell {
                                            text-align: center;
                                        }
                                    </style>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="page-utilities">
                            {{-- <div class="row g-2 justify-content-start justify-content-md-end align-items-center"> --}}
                            <div class="col-auto">
                                <form action="{{ route('search_by_students') }}" method="get"
                                    class="table-search-form row gx-1 align-items-center">
                                    @csrf
                                    @method('get')
                                    <div class="col-auto">

                                        <input type="hidden" value="{{ $get_teacher->id }}" name="teacher_id" >

                                        <input type="text" id="search-orders" name="student"
                                            class="form-control search-orders" placeholder="Search">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn app-btn-secondary">Search</button>
                                    </div>
                                </form>
                            </div>
                            {{-- </div> --}}
                        </div>
                    </div>
                    <form action="add_teacher" method="POST">
                        @csrf
                        @method('post')
                        <select name="teacher_id" id="teacher_id" class="form-select">
                          
                            <option value="{{ $get_teacher->id }}">{{ $get_teacher->full_name }}</option>
                        
                        </select>
                </div>

                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <div class="table-responsive">
                                        @if ($message = Session::get('success'))
                                            <div class="alert alert-success">
                                                <p>{{ $message }}</p>
                                            </div>
                                        @endif

                                        <table class="table app-table-hover mb-0 text-left">
                                            <thead>
                                                <tr>
                                                    <th class="cell">check</th>
                                                    <th class="cell">student</th>
                                                    <th class="cell">addmission no</th>
                                                    <th class="cell">count</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php
                                                
                                                if (isset($student)) {
                                                    $student = $student;
                                                } else {
                                                    $student = $student1;
                                                }
                                                ?>
                                                @foreach ($student as $data)
                                                    <tr>

                                                        <?php $students = DB::table('teachers')
                                                            ->where('teachers.student_id', $data->id)
                                                            ->first();
                                                        // echo $students;
                                                        ?>
                                                        {{-- <?php if (!empty($students)){?> --}}
                                                        <td class="cell"><input type="checkbox" id="scales"
                                                                value="{{ $data->id }}" name="student_id[]"></td>



                                                        <?php
                                                        
                                                        $city = explode(',', $data->address)[0];
                                                        
                                                        ?>
                                                        <td class="cell">{{ $data->name }}-{{ $city }}</td>
                                                        <td class="cell">{{ $data->admission_no }}</td>



                                                        <td class="cell">{{ $i++ }}</td>
                                                        {{-- <?php  } ?> --}}

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-success">Submit</button>

                        </form>
                        <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog"
                            aria-labelledby="mediumModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="mediumBody">
                                        <div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"
                            id="bootstrap-css">
                        <!-- Script -->
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>

                        <!-- Font Awesome JS -->
                        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
                            integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
                        </script>
                        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
                            integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
                        </script>
                    @endsection
