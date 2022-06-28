@extends('layouts.master')
@section('content')
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Mention Holiday</h1>
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

<form action="{{route('leavepost')}}" method="POST" >
    @method('POST')
    @csrf

<div class="container">
 
<div style="display:flex; justify-content:space-around;">
    <div class="mb-3">
        <label for="recipient-name" class="col-form-label">Form Date</label>
        <input type="date" name="from_date" class="form-control" id="recipient-name" required>
    </div>
    <div class="mb-3" >
        <label for="recipient-name" class="col-form-label">To Date</label>
        <input type="date" name="to_date" class="form-control" id="recipient-name" required>
    </div>
</div>
    <div class="mb-3">
        <label for="recipient-name" class="col-form-label">Remark</label>
        <input type="text" name="remark" class="form-control" id="recipient-name" required>
    </div>
<div class="mb-3">
<label for="recipient-name" class="col-form-label">Course</label>
     <select name="course_id" class="form-control">
        <option value="">Select Course</option>

        @foreach ($course as $item)

        <option value="{{$item->id}}">{{$item->title}}</option>
        
        @endforeach

     </select>
</div>

    <button class="btn btn-primary" style="margin:2% 30%">Save</button>

</form>
</div>
                                </div>
                            </div>
                        </div>

<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
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