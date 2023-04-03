@extends('layouts.master')
@section('content')
    <?php use Illuminate\Support\Facades\DB; ?>

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="col-auto">
                            <h1 class="app-page-title mb-0">Hifz Details</h1>
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

                                    <br>
                                            <h4 style=" deflex;text-align:center;background-color:white;">مدرسہ دعوة القرآن ,
                                                پرنم بٹ</h4>
                                                <h4 style="text-align:center;background-color:white;font-family:Al Mushaf">(حفظ قرآن مجید)قرطاس یومیہ</h4>
                                                <h4 class="text-left-right">
                                                    <?php
                                                    $city = explode(',', $students->address)[0];
                                                    ?>
                                                    &nbsp; &nbsp;<span class="byline">{{ $students->name }}: طالب علم &nbsp;
                                                        &nbsp;</span>
                                                    {{-- <span class="left-text"> &nbsp; &nbsp; :ماہ </span> --}}
                                                </h4>
    
                                                <h4 class="text-left-right">
                                                    &nbsp; &nbsp;<span class="byline">{{ $city }}: وطن &nbsp;
                                                        &nbsp;</span>
                                                        <?php if(!empty($teacher->teacher_name)){?>
                                                    <span class="left-text"> &nbsp; &nbsp;{{ $teacher->teacher_name }} :متعلقہ مدرس</span>
                                                    <?php } else { ?>
                                                        <span class="left-text"> &nbsp; &nbsp; :متعلقہ مدرس</span>

    <?php  } ?>
                                                </h4>
                                         


                                        </div>
                                        {{-- <div>
                                            <?php $city = explode(",",$students->address)[0];?>

                                            <h4>{{ $students->name }}متعلقہ مدرس-{{$city}}</h4>
                                            <h4>{{ $students->admission_no }}</h4>
                                            <?php if(!empty($teacher)){?>


                                            <h4>{{ $teacher->teacher_name }}</h4>
                                            <?php } ?>

                                        </div> --}}
                                    </div>

                                    <style>
                                        input {
                                            text-transform: capitalize;
                                        }

                                        .cell,
                                        td,
                                        th {
                                            text-align: center;
                                            text-size: 20px;
                                            text-transform: capitalize;
                                            font-weight: 50 !important;
                                            color: black !important;
                                            font-weight: bolder;
                                            font-size: 1vw;

                                            border: 2px solid rgba(0, 0, 0, 0.089) !important;
                                        }

                                        table thead tr {
                                            background-color: rgba(252, 252, 252, 0.26) !important;

                                        }
                                    </style>

                                    <table class="table align-items-center mb-1" style=font-size:12px>
                                        <thead>
                                            <tr style=font-size:12px>


                                                <th class="cell" style=font-size:12px colspan="1">نیاسباق</th>
                                                <th class="cell" style=font-size:12px colspan="2">اعادہ پارہ</th>
                                                <th class="cell" style=font-size:12px colspan="2">آخری ختم پارہ</th>
                                                <th class="cell" style=font-size:12px colspan="2">ختم پارہ</th>
                                                <th class="cell" style=font-size:12px colspan="2">اموختہ</th>
                                                <th class="cell" style=font-size:12px colspan="2">سباق پارہ</th>
                                                <th class="cell" style=font-size:12px colspan="1">تاریخ</th>
                                                <th class="cell" style=font-size:12px colspan="1">تاریخ</th>
                                                <th class="cell" style=font-size:12px colspan="1">آئی ڈی</th>


                                            </tr>
                                            <tr>
                                                <th class="cell" style=font-size:12px></th>
                                                
                                                <th class="cell" style=font-size:12px>اعادہ پارہ استاد</th>
                                                <th class="cell" style=font-size:12px>اعادہ  پارہ  تیاری</th>
                                                <th class="cell" style=font-size:12px>آخری ختم پارہ استاد</th>
                                                <th class="cell" style=font-size:12px>آخری ختم پارہ  تیاری</th>
                                                <th class="cell" style=font-size:12px>ختم پارہ استاد</th>
                                                <th class="cell" style=font-size:12px>ختم پارہ  تیاری</th>
                                                <th class="cell" style=font-size:12px>اموختہ استاد</th>
                                                <th class="cell" style=font-size:12px>اموختہ تیاری</th>
                                                <th class="cell" style=font-size:12px>آپس سباق</th>
                                                <th class="cell" style=font-size:12px>سباق پارہ</th>
                                                <th class="cell" style=font-size:12px></th>
                                                <th class="cell" style=font-size:12px></th>
                                                <th class="cell" style=font-size:12px></th>



                                            </tr>
                                        </thead>
                                        <tbody style=font-size:12px>
                                            <?php $i = 1;
                                            ?>
                                            @foreach ($hifz_update as $data)
                                                <tr>
                                                    <?php 

                                                    $check = $data->new_parah;
                                                    if(!empty($check)){
                                                    
                                                    $new_parah1 = explode(',', $check)[0];
                                                    $new_parah2 = explode(',', $check)[1];
                                              

                                                    $new_parah3= explode('-', $new_parah1)[0];
                                                    $new_parah4 = explode('-', $new_parah1)[1];
                                                    
                                                    $new_parah5 = explode('-', $new_parah2)[0];
                                                    $new_parah6 = explode('-', $new_parah2)[1];
                                                    // var_dump( $new_parah2);
                                                    if($new_parah1 || $new_parah2){
                                                    $new_parah7 = DB::table('paras')
                                                        ->where('paras.id', $new_parah3)
                                                        ->first();
                                                    $new_parah8 = DB::table('paras')
                                                        ->where('paras.id', $new_parah5)
                                                        ->first();
                                                        
                                                    }
                                                    ?>
                                                    <td class="cell" style=font-size:12px><span
                                                        class="truncate">{{ $new_parah7->para_name }}-{{ $new_parah4 }},{{ $new_parah8->para_name }}-{{ $new_parah6 }}</span>
                                                        <?php  }else{ ?>
                                                    <td class="cell" style=font-size:12px><span class="truncate"></span>
                                                    </td>

                                                    <?php } 
                                                    
                                                    
                                                    
                                                    $check = $data->failed_parah_ustad;
                                                    if(!empty($check)){
                                                        $failed_parah_ustad1 = explode('-', $data->failed_parah_ustad)[0];
                                                    $failed_parah_ustad = DB::table('paras')
                                                        ->where('paras.id', $failed_parah_ustad1)
                                                        ->first(); ?>
                                                    <td class="cell" style=font-size:12px><span
                                                            class="truncate">{{ $failed_parah_ustad->para_name }}</span>
                                                    </td>
                                                    <?php } else {?>


                                                    <td class="cell" style=font-size:12px><span class="truncate"></span>
                                                    </td>
                                                    <?php } ?>
                                                    <?php
                                                    $check = $data->failed_parah;
                                                    if(!empty($check)){
                                                        $failed_parah = explode('-', $data->failed_parah)[0];
                                                    $failed_parah = DB::table('paras')
                                                        ->where('paras.id', $failed_parah)
                                                        ->first(); ?>
                                                    <td class="cell" style=font-size:12px><span
                                                            class="truncate">{{ $failed_parah->para_name }}</span>
                                                    </td>
                                                    <?php } else {?>
                                                    <td class="cell" style=font-size:12px><span class="truncate"></span>
                                                    </td>
                                                    <?php  }  ?>
                                                  
                                                   
                                                    <?php 
                                                      $check = $data->last_end_paraha_ustad;
                                                    if(!empty($check)){



                                                        $last_end_paraha_ustad1 = explode(',', $check)[0];
                                                        $last_end_paraha_ustad2 = explode(',', $check)[1];
                                              

                                                    $last_end_paraha_ustad3= explode('-', $last_end_paraha_ustad1)[0];
                                                    $last_end_paraha_ustad4 = explode('-', $last_end_paraha_ustad1)[1];
                                                    
                                                    $last_end_paraha_ustad5 = explode('-', $last_end_paraha_ustad2)[0];
                                                    $last_end_paraha_ustad6 = explode('-', $last_end_paraha_ustad2)[1];
                                                    // var_dump( $last_end_paraha_ustad2);
                                                    if($last_end_paraha_ustad1 || $last_end_paraha_ustad2){
                                                    $last_end_paraha_ustad7 = DB::table('paras')
                                                        ->where('paras.id', $last_end_paraha_ustad3)
                                                        ->first();
                                                    $last_end_paraha_ustad8 = DB::table('paras')
                                                        ->where('paras.id', $last_end_paraha_ustad5)
                                                        ->first();
                                                    }
                                                    ?>
                                                    <td class="cell" style=font-size:12px><span
                                                        class="truncate">{{ $last_end_paraha_ustad7->para_name }}-{{ $last_end_paraha_ustad4 }},{{ $last_end_paraha_ustad8->para_name }}-{{ $last_end_paraha_ustad6 }}</span>
                                                    </td>
                                                    <?php } else {?>
                                                    <td class="cell" style=font-size:12px><span class="truncate"></span>
                                                    </td>
                                                    <?php }
                                                        $check = $data->last_end_paraha;
                                                    if(!empty($check)){

                                                        $last_end_paraha1 = explode(',', $check)[0];
                                                        $last_end_paraha2 = explode(',', $check)[1];
                                              

                                                    $last_end_paraha3= explode('-', $last_end_paraha1)[0];
                                                    $last_end_paraha4 = explode('-', $last_end_paraha1)[1];
                                                    
                                                    $last_end_paraha5 = explode('-', $last_end_paraha2)[0];
                                                    $last_end_paraha6 = explode('-', $last_end_paraha2)[1];
                                                    // var_dump( $last_end_paraha2);
                                                    if($last_end_paraha1 || $last_end_paraha2){
                                                    $last_end_paraha7 = DB::table('paras')
                                                        ->where('paras.id', $last_end_paraha3)
                                                        ->first();
                                                    $last_end_paraha8 = DB::table('paras')
                                                        ->where('paras.id', $last_end_paraha5)
                                                        ->first();
                                                        
                                                    }
                                                    ?>
                                                    <td class="cell" style=font-size:12px><span
                                                            class="truncate">{{ $last_end_paraha7->para_name }}-{{ $last_end_paraha4 }},{{ $last_end_paraha8->para_name }}-{{ $last_end_paraha6 }}</span>
                                                    </td>
                                                    <?php }else {   ?>
                                                    <td class="cell" style=font-size:12px><span class="truncate"></span>
                                                    </td>
                                                    <?php }?>
                                              
                                                  
                                                        <?php 
                                                          $check = $data->end_paraha_ustad;
                                                        if(!empty($check)){
    
    
    
                                                            $end_paraha_ustad1 = explode(',', $check)[0];
                                                            $end_paraha_ustad2 = explode(',', $check)[1];
                                                  
    
                                                        $end_paraha_ustad3= explode('-', $end_paraha_ustad1)[0];
                                                        $end_paraha_ustad4 = explode('-', $end_paraha_ustad1)[1];
                                                        
                                                        $end_paraha_ustad5 = explode('-', $end_paraha_ustad2)[0];
                                                        $end_paraha_ustad6 = explode('-', $end_paraha_ustad2)[1];
                                                        // var_dump( $end_paraha_ustad2);
                                                        if($end_paraha_ustad1 || $end_paraha_ustad2){
                                                        $end_paraha_ustad7 = DB::table('paras')
                                                            ->where('paras.id', $end_paraha_ustad3)
                                                            ->first();
                                                        $end_paraha_ustad8 = DB::table('paras')
                                                            ->where('paras.id', $end_paraha_ustad5)
                                                            ->first();
                                                        }
                                                        ?>
                                                    <td class="cell" style=font-size:12px><span
                                                        class="truncate">{{ $end_paraha_ustad7->para_name }}-{{ $end_paraha_ustad4 }},{{ $end_paraha_ustad8->para_name }}-{{ $end_paraha_ustad6 }}</span>
                                                        <?php } else { ?>

                                                    <td class="cell" style=font-size:12px><span class="truncate"></span>
                                                    </td>
                                                    <?php }
                                                       $check = $data->end_parah;
                                                    if(!empty($check)){




                                                        $end_parah1 = explode(',', $check)[0];
                                                        $end_parah2 = explode(',', $check)[1];
                                              

                                                    $end_parah3= explode('-', $end_parah1)[0];
                                                    $end_parah4 = explode('-', $end_parah1)[1];
                                                    
                                                    $end_parah5 = explode('-', $end_parah2)[0];
                                                    $end_parah6 = explode('-', $end_parah2)[1];
                                                    // var_dump( $end_parah2);
                                                    if($end_parah1 || $end_parah2){
                                                    $end_parah7 = DB::table('paras')
                                                        ->where('paras.id', $end_parah3)
                                                        ->first();
                                                    $end_parah8 = DB::table('paras')
                                                        ->where('paras.id', $end_parah5)
                                                        ->first();
                                                    }
                                                    ?>
                                                    <td class="cell" style=font-size:12px><span
                                                            class="truncate">{{ $end_parah7->para_name }}-{{ $end_parah4 }},{{ $end_parah8->para_name }}-{{ $end_parah6 }}</span>
                                                    </td>
                                                    <?php } else {  ?>
                                                    <td class="cell" style=font-size:12px><span class="truncate"></span>
                                                    </td>
                                                    <?php } ?>
                                                
                                      
                                                    <?php 
                                                      $check = $data->amuqtha_ustad;
                                                    if(!empty($check)){



                                                        $amuqtha_ustad1 = explode(',', $check)[0];
                                                        $amuqtha_ustad2 = explode(',', $check)[1];
                                              

                                                    $amuqtha_ustad3= explode('-', $amuqtha_ustad1)[0];
                                                    $amuqtha_ustad4 = explode('-', $amuqtha_ustad1)[1];
                                                    
                                                    $amuqtha_ustad5 = explode('-', $amuqtha_ustad2)[0];
                                                    $amuqtha_ustad6 = explode('-', $amuqtha_ustad2)[1];
                                                    // var_dump( $amuqtha_ustad2);
                                                    if($amuqtha_ustad1 || $amuqtha_ustad2){
                                                    $amuqtha_ustad7 = DB::table('paras')
                                                        ->where('paras.id', $amuqtha_ustad3)
                                                        ->first();
                                                    $amuqtha_ustad8 = DB::table('paras')
                                                        ->where('paras.id', $amuqtha_ustad5)
                                                        ->first();
                                                    }
                                                    ?>
                                                    <td class="cell" style=font-size:12px><span
                                                            class="truncate">{{ $amuqtha_ustad7->para_name }}-{{ $amuqtha_ustad4 }},{{ $amuqtha_ustad8->para_name }}-{{ $amuqtha_ustad6 }}</span>
                                                    </td>
                                                    <?php }else{?>
                                                    <td class="cell" style=font-size:12px><span class="truncate"></span>
                                                    </td>

                                                    <?php }
                                                      $check = $data->amuqtha;
                                                    if(!empty($check)){



                                                        $amuqtha1 = explode(',', $check)[0];
                                                        $amuqtha2 = explode(',', $check)[1];
                                              

                                                    $amuqtha3= explode('-', $amuqtha1)[0];
                                                    $amuqtha4 = explode('-', $amuqtha1)[1];
                                                    
                                                    $amuqtha5 = explode('-', $amuqtha2)[0];
                                                    $amuqtha6 = explode('-', $amuqtha2)[1];
                                                    // var_dump( $amuqtha2);
                                                    if($amuqtha1 || $amuqtha2){
                                                    $amuqtha7 = DB::table('paras')
                                                        ->where('paras.id', $amuqtha3)
                                                        ->first();
                                                    $amuqtha8 = DB::table('paras')
                                                        ->where('paras.id', $amuqtha5)
                                                        ->first();
                                                    }
                                                    ?>
                                                    <td class="cell" style=font-size:12px><span
                                                            class="truncate">{{ $amuqtha7->para_name }}-{{ $amuqtha4 }},{{ $amuqtha8->para_name }}-{{ $amuqtha6 }}</span>
                                                    </td>
                                                    <?php } else {   ?>
                                                    <td class="cell" style=font-size:12px><span class="truncate"></span>
                                                    </td>
                                                    <?php } ?>



                                                   
                                                    {{-- <td class="cell" style=font-size:12px><span
                                                            class="truncate">{{ $data->sabaq_interactions }}</span></td> --}}
                                                 
                                                           <?php  $check = $data->sabaq_interactions;
                                                            if(!empty($check)){
                                                            
                                                            $sabaq_interactions1 = explode(',', $check)[0];
                                                            $sabaq_interactions2 = explode(',', $check)[1];
                                                      
        
                                                            $sabaq_interactions3= explode('-', $sabaq_interactions1)[0];
                                                            $sabaq_interactions4 = explode('-', $sabaq_interactions1)[1];
                                                            
                                                            $sabaq_interactions5 = explode('-', $sabaq_interactions2)[0];
                                                            $sabaq_interactions6 = explode('-', $sabaq_interactions2)[1];
                                                            // var_dump( $sabaq_interactions2);
                                                            if($sabaq_interactions1 || $sabaq_interactions2){
                                                            $sabaq_interactions7 = DB::table('paras')
                                                                ->where('paras.id', $sabaq_interactions3)
                                                                ->first();
                                                            $sabaq_interactions8 = DB::table('paras')
                                                                ->where('paras.id', $sabaq_interactions5)
                                                                ->first();
                                                                
                                                            }
                                                            ?>
                                                             <td class="cell" style=font-size:12px><span
                                                                class="truncate">{{ $sabaq_interactions7->para_name }}-{{ $sabaq_interactions4 }},{{ $sabaq_interactions8->para_name }}-{{ $sabaq_interactions6 }}</span>
                                                        </td>
                                                        <?php } else { ?>
                                                            <td class="cell" style=font-size:12px><span class="truncate"></span>
                                                            </td>
                                                            <?php } ?>

                                                           <?php  $check = $data->sabaq_parah;
                                                            if(!empty($check)){
                                                            
                                                            $sabaq_parah1 = explode(',', $check)[0];
                                                            $sabaq_parah2 = explode(',', $check)[1];
                                                      
        
                                                            $sabaq_parah3= explode('-', $sabaq_parah1)[0];
                                                            $sabaq_parah4 = explode('-', $sabaq_parah1)[1];
                                                            
                                                            $sabaq_parah5 = explode('-', $sabaq_parah2)[0];
                                                            $sabaq_parah6 = explode('-', $sabaq_parah2)[1];
                                                            // var_dump( $sabaq_parah2);
                                                            if($sabaq_parah1 || $sabaq_parah2){
                                                            $sabaq_parah7 = DB::table('paras')
                                                                ->where('paras.id', $sabaq_parah3)
                                                                ->first();
                                                            $sabaq_parah8 = DB::table('paras')
                                                                ->where('paras.id', $sabaq_parah5)
                                                                ->first();
                                                                
                                                            }
                                                            ?>
                                                            <td class="cell" style=font-size:12px><span
                                                                    class="truncate">{{ $sabaq_parah7->para_name }}-{{ $sabaq_parah4 }},{{ $sabaq_parah8->para_name }}-{{ $sabaq_parah6 }}</span>
                                                            </td>
                                                            <?php } else { ?>
                                                            <td class="cell" style=font-size:12px><span class="truncate"></span>
                                                            </td>
                                                            <?php } ?>
                                                    <td class="cell" style=font-size:12px><span
                                                            class="truncate">{{ $data->arabic_date }}</span>
                                                    </td>
                                                    <td class="cell" style=font-size:12px><span
                                                            class="truncate">{{ $data->date }}</span></td>

                                                    <td class="cell" style=font-size:12px>{{ $i++ }}</td>
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
