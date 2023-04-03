@extends('layouts.master')
@section('content')
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="col-auto">
                            <h1 class="app-page-title mb-0">Mistake Details</h1>
                        </div> 
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

                                    <div style="display:flex; ">
                                        <div >
                                            <?php $city = explode(",",$students->address)[0];?>
                                            <h4 >Student:{{$students->name}}-{{$city}}</h4>
                                            <h4>Admission No:{{$students->admission_no}}  </h4>
                                            {{-- <h4>Address:  </h4> --}}

                                           
                                        </div>
                                        {{-- <div>
                                            <h4>{{$students->name}}-{{$city}}</h4>
                                            <h4>{{$students->admission_no}}</h4>
                                            <h4>{{$students->address}}</h4>
                                        </div> --}}
                                        </div>
                               


                                    <table class="table app-table-hover mb-0 text-left" style=" border:2px solid rgba(19, 164, 231, 0.918);">
                                        <thead >
                                            <tr>
                                                <th class="cell">Id</th>
                                                <th class="cell">Date</th>
                                                <th class="cell">Arabic Date</th>
                                                {{-- <th class="cell">Students Name</th> --}}
                                                <th class="cell">Teacher Name</th>
                                                <th class="cell">Course</th>
                                                <th class="cell">Mistake</th>
                                                <th class="cell">Failed Parah Remark</th>
                                                <th class="cell">Mistake On</th>
                                                <th class="cell">Mark Detected</th>
                                                <th class="cell">Remark</th>
                                             
                                              
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php $i = 1;
                                            ?>
                                            @foreach ($mistakes as $data )
                                                <tr>
                                                    <td class="cell">{{ $i++ }}</td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->date }}</span></td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->arabic_date }}</span></td>
                                                    {{-- <td class="cell"><span
                                                            class="truncate">{{ $data->students_name}}</span></td> --}}
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->teacher_name }}</span></td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->course_name }}</span></td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->mistake_title }}</span></td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->fail_remark }}</span></td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->mistake_on }}</span></td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->mark_detected }}</span></td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->remark }}</span></td>
                                                    {{-- <td class="cell"><span
                                                            class="truncate">{{ $data-> }}</span></td> --}}
                                                    {{-- <td class="cell"><span
                                                            class="truncate">{{ sizeof($fillter) }}</span></td>
                                          
                                                    <td class="cell"><span class="truncate"><a
                                                                href="{{ route('studentgetdetail', $data) }}" data-toggle="modal"
                                                                class="btn btn-primary"><i class="fas fa-eye fa-1x"></i></a>
                                                        </span>
                                                    </td> --}}
                                                </form>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
                @endsection
