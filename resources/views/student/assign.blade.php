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
                                                <th class="cell">Total para</th>
                                                <th class="cell">Detail</th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($syllabi as $data => $fillter)
                                                <tr>
                                                    <td class="cell">{{ $i++ }}</td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data }}</span></td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ sizeof($fillter) }}</span></td>
                                                    <td class="cell"><span class="truncate"><a
                                                                href="{{ route('studentgetdetail', $data) }}" data-toggle="modal"
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
