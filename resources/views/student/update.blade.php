@extends('layouts.master')
@section('content')



    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">

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
                                    <table class="table app-table-hover mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">Id</th>
                                                <th class="cell">Course</th>
                                              
                                                {{-- <th class="cell">MONTH</th>
                                                <th class="cell">YEAR</th> --}}
                                                <th class="cell">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                       

                                          <?php  if(sizeof($daily_naz)>0){ ?>

                                            <tr>
                                                <td class="cell">1</td>
                                                <td class="cell"><span class="truncate">Nazira</span></td>
                                                <form action="{{ route('checknaz') }}" method="GET">
                                            
                                                        <?php 
                                                if(sizeof($daily_naz)>0){ ?>
                                                        <select name="student_id" id="" hidden>

                                                            @foreach ($daily_naz as $data => $id)
                                                                <option value="{{ $data }}">{{ $data }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <?php    } ?>
                                                  
            
                                                <td class="cell">
                                                    <?php 
                                                    if(sizeof($daily_naz)>0){ ?>
                                                      <button class="btn btn-primary">Submit</button>
                                                            <?php    }else{ ?>
                                                                <button class="btn btn-danger" disabled>Empty</button>
                                                            <?php }  ?>
                                                            </form>
                                                </td>
                                                 </tr>

                                               <?php } ?>
                                               <?php if(sizeof($daily_hifz)>0){  ?>
                                            <tr>
                                                <td class="cell">2</td>
                                                <td class="cell"><span class="truncate">Hifz</span></td>
                                                    <form action="{{ route('checkhifa') }}" method="POST">

                                                        @csrf
                                                        @method('post')
                                                        <?php 
                                                         if(sizeof($daily_hifz)>0){ ?>
                                                        <select name="student_id" id="" hidden>
                                                            @foreach ($daily_hifz as $data => $id)
                                                                <option value="{{ $data }}">{{ $data }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <?php } ?>
                                                 
                                            
                                                <td class="cell">
                                                    <?php 
                                                    if(sizeof($daily_hifz)>0){ ?>
                                                      <button class="btn btn-primary">Submit</button>
                                                            <?php    }else{ ?>
                                                                <button class="btn btn-danger" disabled>Empty</button>
                                                            <?php }  ?>
                                                            </form>
                                                </td>
                                            </tr>


                                            <?php } ?>
                                            <?php 
                                            if(sizeof($daily_dor)>0){ ?>

                                            <tr>
                                                <td class="cell">3</td>
                                                <td class="cell"><span class="truncate">Dor</span></td>
                                       
                                                <form action="{{ route('checkdor') }}" method="POST">
                                                @csrf
                                                @method('post')
                                                        <?php 
                                                          if(sizeof($daily_dor)>0){ ?>
                                                        <select name="student_id" id="" hidden>
                                                            @foreach ($daily_dor as $data => $id)
                                                                <option value="{{ $data }}">{{ $data }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                <?php } ?>
                           
                                                <td class="cell">
                                                    <?php if(sizeof($daily_dor)>0){ ?>

                                                      <button class="btn btn-primary">Submit</button>

                                                     <?php  }else{ ?>

                                                    <button class="btn btn-danger" disabled>Empty</button>

                                                </form>
                                                <?php  }  ?>
                                            </td>
                                        </tr>
                                        <?php  }  ?>
                                        



                                        </tbody>
                                    </table>
                                </div>
                                <!--//table-responsive-->

                            </div>
                            <!--//app-card-body-->
                        </div>

                    </div>



               
                @endsection
