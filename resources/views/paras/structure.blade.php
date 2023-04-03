@extends('layouts.master')
@section('content')
    <?php

    use Illuminate\Support\Facades\DB;

    function GetPara($month_id, $total_arry)
    {
        $material = [];
        for ($i = 0; $i < count($total_arry); $i++) {
            $data = [];
            $month = explode('/', $total_arry[$i]->arabic_date)[1];

            if ($month == $month_id) {
                $material[] = explode('-', $total_arry[$i]->para_id)[0];
                //  $material[]= $data;
            }
        }

        return $material;
    }
    function getmonth($month_id, $daily_naz)
    {
        $material = [];
        $con = false;
        for ($i = 0; $i < count($daily_naz); $i++) {
            $data = [];
            $month = explode('/', $daily_naz[$i]->arabic_date)[1];
            if ($month == $month_id && $daily_naz[$i]->para_id == 0) {
                $con = true;
                break;
            } else {
                $con = false;
            }
        }
        return $con;
    }

    ?>


    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Structure</h1>
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
                <p></p>
                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <footer id="print">

                                        <div class="col-auto">
                                            <?php $city = explode(',', $students->address)[0]; ?>
                                            <br>
                                            <h4 style=" deflex;text-align:center;background-color:white;">مدرسہ دعوة القرآن
                                                پرنم بٹ</h4>

                                            <h4 style="text-align:center;background-color:white;font-family:Mohammadi">قرطاس
                                                نقشہ اموختہ</h4>
                                            <?php
                                                if(!empty($city)){

                                                ?>
                                            <h4 style="text-align: center">
                                                &nbsp; &nbsp;{{ $students->admission_no }}:داخلہ نمبر
                                                &nbsp; &nbsp; {{ $students->students_course }}:شعبہ
                                                &nbsp; &nbsp; {{ $city }}:وطن
                                                &nbsp; &nbsp; {{ $students->name }}:طالب علم</h4>
                                            <?php  } else{?>
                                            <h4 style="text-align: center">
                                                &nbsp; &nbsp; {{ $students->admission_no }}:داخلہ نمبر
                                                &nbsp; &nbsp; {{ $students->students_course }}:شعبہ
                                                &nbsp; &nbsp; {{ $students->name }}:طالب علم</h4>
                                            <?php } ?>
                                        </div>


                                        @if ($message = Session::get('success'))
                                            <div class="alert alert-success">
                                                <p>{{ $message }}</p>
                                            </div>
                                        @endif
                                        <?php if(isset($parahead)){?>
                                        <style>
                                            input {
                                                text-transform: capitalize;
                                            }

                                            .cell {
                                                text-align: center;
                                            }

                                            th,
                                            td {
                                                border: 1px solid black;
                                                font-size: 0.9vw;
                                            }

                                            ::-webkit-scrollbar {
                                                display: none;
                                            }
                                        </style>
                                        <table class="table app-table-hover mb-0 text-left">
                                            <thead>
                                                <tr>
                                                    @foreach ($parahead as $data)
                                                        <?php $student_id = $data->student_id; ?>
                                                        <th class="cell">{{ $data->para_id }}</th>
                                                    @endforeach
                                                    <th class="cell"></th>
                                                    <th class="cell"></th>
                                                    <th class="cell">SNo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($parahead as $data)
                                                    <?php
                                                    // var_dump($daily_naz);
                                                    // echo $daily_naz;

                                                    $student_id = $data->student_id;
                                                    ?>
                                                    <td class="cell"
                                                        style="writing-mode: vertical-rl; font-weight: 900; font-family:Mohammadi">
                                                        {{ $data->para_name }}</td>
                                                @endforeach
                                                <td class="cell"
                                                    style="writing-mode: vertical-rl; font-weight: 900;text-color: #212529; font-family:Mohammadi">
                                                    تختی</td>
                                                <td class="cell"
                                                    style="writing-mode: vertical-rl; font-weight: 900;  font-family:Mohammadi">
                                                    پارو کی ترتیب</td>
                                                <td class="cell" style="writing-mode: vertical-rl"></td>


                                                <?php $sno = 0;
                                            for ($i=0; $i < 12; $i++) {
                                                $sno++;
                                              $listdata =  GetPara($students_months[$i]->month_id,$daily_naz);

                                              ?>
                                                <tr>
                                                    <?php
                                                    for ($index = 0; $index < count($parahead); $index++) {
                                                       echo "<td class='cell' style='height: 60px'>";

                                                    if (in_array($parahead[$index]->para_order,$listdata, TRUE))
                                                    {
                                                        echo $parahead[$index]->para_order."</br>";
                                                    ?>
                                                    <div style="text-decoration-line: overline">
                                                        <?php
                                                       $count = $i;
                                                     echo $students_months[$i]->month_id;
                                                    }
                                                    echo '</span></td>';
                                                         }  ?>



                                                        <?php
                                                     $count = $i;
                                                     $count+=1;
                                                    if(getmonth($students_months[$i]->month_id,$daily_naz)){
                                                     echo "<td class='cell' style='height: 60px'>";
                                                    echo "28";?>
                                                        <div style="text-decoration-line: overline">
                                                            <?php
                                                       echo $students_months[$i]->month_id;
                                                       echo '</span></td>';
                                                       }else{ ?>

                                                            <td></td>
                                                            <?php } ?>
                                                            <td class="cell"
                                                                style="font-weight: 900;text-color: #0f7ae600;">
                                                                {{ !empty($students_months[$i]) ? $students_months[$i]->students_months : '' }}</span>
                                                            </td>

                                                            <td class="cell"
                                                                style="font-weight: 900;text-color: #212529;">
                                                                {{ $sno }}</span></td>
                                                </tr>
                                                <?php }  ?>
                                            </tbody>
                                        </table>
                                    </footer>
                                </div>
                                <input type="button" onclick="printDiv('print')" value="print Structure" />
                                <?php }	?>
                            </div>
                        </div>
                    </div>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>
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
