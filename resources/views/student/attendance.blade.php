
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
                {{$student->name}}
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
                                                <th class="cell">Date</th>
                                                <th class="cell">session 1</th>
                                                <th class="cell">session 2</th>
                                                <th class="cell">session 3</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            
                                             ?>
                                            
                                            @foreach ($attendance as $data => $fillter)
                                                <tr><td class="cell">{{ $data }}</td>
                                                    <td class="cell">{{empty($fillter[0]->status_1)?"":$fillter[0]->status_1;}}</td>
                                                    <td class="cell">{{empty($fillter[0]->status_2)?"":$fillter[0]->status_2;}} </td>
                                                    <td class="cell">{{empty($fillter[0]->status_3)?"":$fillter[0]->status_3;}}</td></tr>
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
