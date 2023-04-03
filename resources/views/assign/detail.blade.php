@extends('layouts.master')
@section('content')
<?php
use App\Models\student_based_para;
use App\Models\Para;
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
        td.cell {
            text-align: center;
        }

    </style>
    <div class="app-wrapper">
        <h1 class="app-page-title mb-0" style="text-align: center"></h1><br>
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
        
        .text-left-right {
    text-align: right;
    position: relative;
}
.left-text {
    left: 01%;
    position: absolute;
}


.byline {
    font-size: 24px;
    color: rgb(20, 20, 20);
    left: 01%;
}

   
        .aligncenter {
            float: left;
            width: 33.33333%;
            text-align: center;
        }


        .alignleft {
            float: left;
            width: 33.33333%;
            text-align: left;
        }


        .alignright {
            float: left;
            width: 33.33333%;
            text-align: right;
        }
    </style>
    
    <?php 
    $city =explode(",",$detail[0]->address)[0]; 
    
    ?>
<div style=" background-color:white;">
    <br>
    <h4 style=" deflex;text-align:center;background-color:white;">مدرسہ دعوة القرآن , پرنم بٹ</h4>
    <div style="clear: both">
    {{-- <h4 style="text-align:right;background-color:white; ">{{$detail[0]->name}}: طالب علم </h4>
    <h4 style="text-align:left;background-color:white; display: inline-block">{{$city}}: وطن</h4> --}}

    {{-- <h4 class="text-left-right"  >
        &nbsp; &nbsp;<span  class="byline"  >{{$detail[0]->name}}: طالب علم &nbsp; &nbsp;</span>
        <span  class="left-text" > &nbsp; &nbsp; {{$city}}: وطن </span>
    </h4> --}}
    <div id="textbox">
        <h4 class="alignleft"> &nbsp; &nbsp; {{$city}}: وطن </h4>
        <h4 class="aligncenter">قرطاس ماہانہ مجوزہ نصاب </h4>
        <h4 class="alignright">{{$detail[0]->name}}: طالب علم &nbsp; &nbsp;</h4>
    </div>
<?php if ($detail[0]->std_course_id == 1){?>
    <h4 style="text-align:center;background-color:white;font-family:Al Mushaf">شعبہ ناظرہ قرآن مجید</h4>
    <?php }elseif($detail[0]->std_course_id == 2){ ?>
    <h4 style="text-align:center;background-color:white;font-family:Al Mushaf">شعبہ حفظ قرآن مجید</h4>
    <?php } ?>
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
                                <table style="width: 100%;border-collapse: collapse; border: 1px solid black;">



                                    <thead style="background: yellow;height: 60px">
                                        <tr>
                                         <th class="cell" >دستخط سرپرست</th>
                                         
                                            <th class="cell">نصاب سے</th>
                                         
                                             <th class="cell">موجوزہ نصاب </th>
                                            <th class="cell">
                                                نصاب سے</th>
                                            <?php if ($detail[0]->std_course_id == 1){?>
                                                <th class="cell" >سال اول ناظرہ</th>
                                                <?php }elseif($detail[0]->std_course_id == 2){ ?>
                                                    <th class="cell" >سال اول حفظ</th>
                                                <?php } ?>
                                            <th class="cell">آئی ڈی</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
                                        <?php $i = 1; ?>
                                      
                                        @foreach ($detail as $data)
                                            <tr>
                                                <?php 
                                                if( $data->course_id == 2  ){
    
    
                                                ?> 
                                                <td  style="font-family:Al Mushaf"  >
                                                 

                                                </td>  
                                            

                                                <?php if(substr($data->no_of_parah,0,4) == 'Para'){ ?>
                                                    <td class="cell" style="text-align: center">پارہ</td>
                                                 <?php }else if(substr($data->no_of_parah,0,4) == 'Taq-'){ ?>
    

                                                    <td class="cell" style="text-align: center">تختی</td>
    
                                                <?php }else{   ?>

                                                    <td class="cell" style="text-align: center">{{$data->no_of_parah}}</td>
                                                <?php }  ?>
                                               

                                                <td class="cell" style="text-align: center;font-family:Al Mushaf;height: 60px">
                                                    <div  data-bind="text: text()" class="text-truncate"  style="text-align: center">
                                                    <?php
                                                    
                                                    if (str_contains($data->no_of_parah, 'Parah')) {
  

                                                    
                                                    
                                                    $arr = explode(",",$data->target);
                                                    
                                                    $p=student_based_para::whereIn('student_based_paras.id',$arr)
                                                    ->join('paras','paras.id','=','student_based_paras.para_order')
                                                    ->select('para_name')->get();

                                                  foreach($p as $a){
                                                   echo $a->para_name." ";
                                                   }
                                                }elseif(substr($data->no_of_parah,0,4) == 'Taq-'){
                                                    $taq = explode("to",$data->target)[0];
                                                    $thi = explode("to",$data->target)[1];
                                                    echo "نورانی قاعدہ " ,"<br>","تختی", '&nbsp',$taq,"تا"," &nbsp;","تختی", $thi;
                                                } else{
                                                    echo $data->target;
                                                } 
                                                  ?>
                                                    
                                                   
                                                    
                                                </div> 
                                                    
                                                    </td> <td class="cell" style="text-align: center" >
                                                    <?php 
                                                    $para =  $data->c_target;
                                                  $p= Para::where('paras.id',$para)
                                                    ->select('para_name')->get();
                                                    
                                                  foreach($p as $a){ 
                                                      echo $a->para_name." ";
                                                    ?>
                                                   <?php  }
                                                 ?>
                                               </td>
                                                <td class="cell" style="text-align: center">{{ $data->students_months }}</td>
                                                <td class="cell" style="text-align: center">{{ $i++ }}</td>
                                                
                                                 <?php  if($i%13 == 0 && $i/13 == 1){?>
                                                    <thead style="background: yellow;height: 60px">

                                                       <tr >
                                                    <th class="cell" >دستخط سرپرست</th>
                                                    
                                                       <th class="cell">نصاب سے</th>
                                                    
                                                        <th class="cell">موجوزہ نصاب </th>
                                                       <th class="cell">
                                                           نصاب سے</th>
                                                       <?php if ($detail[0]->std_course_id == 1){ ?>
                                                           <th class="cell" >سال اول ناظرہ</th>
                                                           <?php } elseif($detail[0]->std_course_id == 2){ ?>
                                                               <th class="cell" >سال دوم حفظ</th>
                                                           <?php } ?>
                                                       <th class="cell">آئی ڈی</th>
                                                       
                                                  
                                                </tr>
                                            </thead>
                                                 <?php   }if($i%12 == 0 && $i/12 == 2){ ?>

                                                    <thead style="background: yellow;height: 60px">
                                                   <tr >
                                                       <th class="cell" >دستخط سرپرست</th>
                                                       
                                                          <th class="cell">نصاب سے</th>
                                                       
                                                           <th class="cell">موجوزہ نصاب </th>
                                                          <th class="cell">
                                                              نصاب سے</th>
                                                          <?php if ($detail[0]->std_course_id == 1){ ?>
                                                              <th class="cell" >سال اول ناظرہ</th>
                                                              <?php } elseif($detail[0]->std_course_id == 2){ ?>
                                                                  <th class="cell" >سال سوم حفظ</th>
                                                              <?php } ?>
                                                          <th class="cell">آئی ڈی</th>
                                                          
                                                      </tr>
                                                    </thead>

                                               <?php  }
                                               if($i%12 == 0 && $i/12 == 3){ ?>
                                                 <thead style="background: yellow;height: 60px">

                                                   <tr >
                                                       <th class="cell" >دستخط سرپرست</th>
                                                       
                                                          <th class="cell">نصاب سے</th>
                                                       
                                                           <th class="cell">موجوزہ نصاب </th>
                                                          <th class="cell">
                                                              نصاب سے</th>
                                                          <?php if ($detail[0]->std_course_id == 1){ ?>
                                                              <th class="cell" >سال اول ناظرہ</th>
                                                              <?php } elseif($detail[0]->std_course_id == 2){ ?>
                                                                  <th class="cell" >سال چہارم حفظ</th>
                                                              <?php } ?>
                                                          <th class="cell">{{$i}}</th>
                                                          {{-- <th class="cell">آئی ڈی</th> --}}
                                                          {{-- <?php print_r($i);?> --}}
                                                        </tr>
                                                    </thead >

                                                        <?php  }
                                                   ?>
                                            </tr>                                              
                                            <?php }else{ ?>
                                                <td  style="font-family:Al Mushaf" >
                                                 

                                                </td>  
                                            

                                                <?php if(substr($data->no_of_parah,0,4) == 'Para'){ ?>
                                                    <td class="cell" style="text-align: center">پارہ</td>
                                                 <?php }else if(substr($data->no_of_parah,0,4) == 'Taq-'){ ?>
    

                                                    <td class="cell" style="text-align: center">تختی</td>
    
                                                <?php }else{   ?>

                                                    <td class="cell" style="text-align: center">{{$data->no_of_parah}}</td>
                                                <?php }  ?>
                                               

                                                <td class="cell" style="text-align: center;font-family:Al Mushaf;height: 60px">
                                                    <div  data-bind="text: text()" class="text-truncate"  style="text-align: center">
                                                    <?php
                                                    
                                                    if (str_contains($data->no_of_parah, 'Parah')) {
  

                                                    
                                                    
                                                    $arr = explode(",",$data->target);
                                                    
                                                    $p=student_based_para::whereIn('student_based_paras.id',$arr)
                                                    ->join('paras','paras.id','=','student_based_paras.para_order')
                                                    ->select('para_name')->get();

                                                  foreach($p as $a){
                                                   echo $a->para_name." ";
                                                   }
                                                }elseif(substr($data->no_of_parah,0,4) == 'Taq-'){
                                                    $taq = explode("to",$data->target)[0];
                                                    $thi = explode("to",$data->target)[1];
                                                    echo "نورانی قاعدہ " ,"<br>","تختی", '&nbsp',$taq,"تا"," &nbsp;","تختی", $thi;
                                                } else{
                                                    echo $data->target;
                                                } 
                                                  ?>
                                                    
                                                   
                                                    
                                                </div> 
                                                    
                                                    </td> <td class="cell" style="text-align: center" >
                                                    <?php 
                                                    $para =  $data->c_target;
                                                  $p= Para::where('paras.id',$para)
                                                    ->select('para_name')->get();
                                                    
                                                  foreach($p as $a){ 
                                                      echo $a->para_name." ";
                                                    ?>
                                                   <?php  }
                                                 ?>
                                               </td>
                                                <td class="cell" style="text-align: center">{{ $data->students_months }}</td>
                                                <td class="cell" style="text-align: center">{{ $i++ }}</td>
                                                <?php } ?>
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
