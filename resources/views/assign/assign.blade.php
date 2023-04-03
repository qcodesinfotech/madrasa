@extends('layouts.master')
@section('content')
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                   
                    <div class="col-auto">
                    <h1 class="app-page-title mb-0">Assign</h1>
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

                                <a href="{{ route('assign.index') }}" type="button"
                                    onMouseOver="this.style.color='#15A362'" onMouseOut="this.style.color='#676778'"
                                    style="border-radius:5px;padding:4px;background-color:white;border:1px solid #676778;;color:#676778; "><i
                                        class="fa fa-plus" aria-hidden="true"></i> Add assign value</button>
                                </a>

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
                                                <th class="cell">Student</th>
                                                <th class="cell">Admission No</th>
                                                <th class="cell">Address</th>
                                                <th class="cell">Total para</th>
                                                <th class="cell">Detail</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($syllabi as $data => $fillter )
                                           {{-- <?php  print_r($data);
                                           die;
                                           ?> --}}
                                                <tr>
                                                    <td class="cell">{{ $i++ }}</td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $fillter[0]->name }}</span></td>
                                                            <td class="cell"><span
                                                                class="truncate">{{$fillter[0]->students_admission_no }}</span></td>
                                                                <td class="cell"><span
                                                                    class="truncate">{{$fillter[0]->students_address }}</span></td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ sizeof($fillter) }}</span></td>
                                                    <td class="cell"><span class="truncate"><a
                                                                href="{{ route('getdetail', $data) }}" data-toggle="modal"
                                                                class="btn btn-primary"><i class="fas fa-eye fa-1x"></i></a>
                                                        </span>
                                                    </td>
                                       
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
