@extends('layouts.master')
@section('content')


    <?php use App\Http\Controllers\ParaController; ?>

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">DOR Update</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                             
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
                            </div>
                            <?php if(isset($array)){  ?>
                            @foreach ($array as $key => $value)
                                <?php
                                
                                $startday = $value['startday'];
                                $month = $value['month'];
                                $startday = $value['startday'];
                                $date = $value['date'];
                                $year = $value['year'];

                                ?>
                           
                            <footer id="print">
                                <?php $dt = DateTime::createFromFormat('!m', $value['month']); ?>
                                @endforeach
                                <h2> {{ $dt->format('F') }}</h2>
                                <style>
                                    input {
                                        text-transform: capitalize;
                                    }

                                    .cell,
                                    td,
                                    th {
                                        text-align: center;
                                        text-transform: capitalize;
                                       font-weight:500 !important;
                                        color: black !important;
                                        font-weight: bolder;
                                        border: 2px solid black !important;
                                    }

                                    h2 {
                                        text-align: center;
                                        text-transform: uppercase;
                                        border-top: 2px solid red;
                                        border-bottom: 2px solid blue;
                                    }

                                    .hello div {
                                        display: flex;
                                    }


                      

                                </style>
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr style="background-color:rgba(51, 51, 51, 0.583); ">
                                        <th class="cell">Total</th>
                                        <th class="cell">Exam3</th>
                                        <th class="cell">Exam2</th>
                                        <th class="cell">Exam1</th>
                                        <th class="cell">Revision</th>
                                        <th class="cell">OldExam</th>
                                        <th class="cell">Day</th>
                                        <th class="cell">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                      for($i=-1;$i<=7;$i++){
                                        if($i==$startday){ 
                                        break; }else{ ?>
                                    <tr >
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>---</td>
                                        <td>0000-00-00</td>
                                    </tr>
                                    <?php }}; ?>
                                    <?php $postion = 0; ?>
                                    @foreach ($period as $key => $value)
                                        <?php if($date=="Friday"){ ?><tr>
                                            <td>Week</td>
                                        </tr><?php } ?>
                                        <?php
                                        $allowed = false;
                                        $daymonth = date('d', strtotime($value['date'])); ?>
                                        @for($i = 0; $i < sizeof($array); $i++)
                                        <?php 

                                        if($daymonth==$array[$i]['arabic_date']){ 
                                          
                                      
                                             
                                             ?>
                                            <tr >
                                                <td>
                                                    {{ $array[$i]['exam_3']}}
                                                     <br>
                                                         {{ $array[$i]['exam_3a']}}
                                                </td>
                                            <td>
                                                {{ $array[$i]['exam_2']}}
                                                 <br>
                                                     {{ $array[$i]['exam_2a']}}
                                            </td>
                                           

                                            <td>{{ $array[$i]['total']}}</td>
                                            <td>{{ $array[$i]['exam_1']}}
                                           
                                            <br>
                                                {{ $array[$i]['exam_1a']}}
                                            </td>
                                            <td>{{ $array[$i]['revision'] }}</td>
                                            <td></td><td>{{ $date = date('l', strtotime($value['date'])) }}</td>
                                                <td>{{ $value['date'] }}</td>          
                                            </tr>
                                <?php
                                        $allowed = true;
                                        } ?>
                                        @endfor
                                        <?php if(!$allowed){ ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $date = date('l', strtotime($value['date'])) }}</td>
                                            <td>{{ $value['date'] }}</td>
                                        </tr>
                                        <?php } ?>
                                    @endforeach
                            </table>
                            </footer>
                        </div>
                        <!--//app-card-body-->
                    </div>
                    <!--//app-card-->
                    <input type="button" onclick="printDiv('print')" value="print dor!" />
                </div>
                <?php } ?>

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
