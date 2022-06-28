@extends('layouts.master')
@section('content')
<?php
use App\Models\student_based_para;
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
        td.cell {
            text-align: center;
        }

    </style>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Detail</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <form class="table-search-form row gx-1 align-items-center">
                                        <div class="col-auto">
                                            <input type="text" id="search-orders" name="searchorders"
                                                class="form-control search-orders" placeholder="Search">
                                        </div>
                                    
                                        <div class="col-auto">
                                            <button type="submit" class="btn app-btn-secondary">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<footer id="print">
    <style>
        th,
        td {
            border: 2px solid black;
            color: black;
            font-weight: 600;
        }
    </style>
<div style="display:flex; border:2px solid rgba(57, 193, 73, 0.571);">
<div >
    <h4 >Student:</h4>
    <h4>Course: - </h4>
 
   
</div>
<div>
    <h4>{{$detail[0]->name}}</h4>
                <h4>{{$detail[0]->title}}</h4>
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
                                    <thead style="background: yellow;">
                                        <tr>
 <th class="cell">Signature</th>
                                         
                                            <th class="cell">type</th>
                                         
                                             <th class="cell">Total Target</th>
                                            <th class="cell">completed Target</th>
                                            <th class="cell">Month</th>
                                            <th class="cell">Id</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($detail as $data)
                                            <tr>
                                                <td></td>
                                                <td class="cell">{{
                                                substr($data->no_of_parah,0,4)
                                                
                                                }}</td>
                                                
                                                <td class="cell">
                                                    <div  data-bind="text: text()" class="text-truncate" style="max-width:150px">
                                                    <?php
                                                    
                                                    if (str_contains($data->no_of_parah, 'Parah')) {
  

                                                    
                                                    
                                                    $arr = explode(",",$data->target);
                                                    
                                                    $p=student_based_para::whereIn('student_based_paras.id',$arr)
                                                    ->join('paras','paras.id','=','student_based_paras.para_order')
                                                    ->select('para_name')->get();

                                                  foreach($p as $a){
                                                   echo $a->para_name." ";
                                                   }
                                                    }else{
                                                        
                                                        
                                                        echo $data->target;
                                                    }  
                                                   
                                                    ?>
                                                    
                                                   
                                                    
                                                </div> 
                                                    
                                                    </td>
                                                <td class="cell">{{ $data->c_target }}</td>
                                                <td class="cell">{{ $data->month }}</td>
                                                <td class="cell">{{ $i++ }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </footer>
                            <input type="button" onclick="printDiv('print')" value="print Detail" />
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
          function printDiv(print) {
            var printContents = document.getElementById(print).innerHTML;
            var originalContents = document.body.innerHTML;
       
            document.body.innerHTML = printContents;
       
            window.print();
       
            document.body.innerHTML = originalContents;
       } 
       
    </script>
            @endsection
