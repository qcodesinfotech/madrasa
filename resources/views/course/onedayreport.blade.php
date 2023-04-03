@extends('layouts.master')
@section('content')
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Report </h1>
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
                    <?php

                    $date = date('Y-m-d');
                    ?>
                    <div style="display:flex;justify-content:space-around;margin:3px 0px;color:white; background-color:rgba(131, 182, 55, 0.767)">
                        <?php $date = str_replace('/', '-', $student[0]->arabic_date); ?>
                        <div><?= $student[0]->arabic_date ?> : Date </div>
                        <div><?= date('F', strtotime($date)) ?> : Month </div>
                        <div><?= date('D', strtotime($date)) ?> : Day </div>
                        <div><?= $student[0]->teacher_name ?>: Teachers </div>
                    </div>
                    <div class="tab-content" id="orders-table-tab-content">
                        <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
                            aria-labelledby="orders-all-tab">
                            <div class="app-card app-card-orders-table shadow-sm mb-5">
                                <div class="app-card-body">
                                    <div class="table-responsive">
                                        @if ($message = Session::get('success'))
                                            <div class="alert alert-success">
                                                <p>{{ $message }}</p>
                                            </div>
                                        @endif
                                        <?php
                                        if (!isset($student)) {
                                            $student = [];
                                        }
                                        ?>
                                        <footer id="print">
                                            <style>
                                                input {
                                                    text-transform: capitalize;
                                                }

                                                .cell {
                                                    text-align: center;
                                                }

                                            </style>
                                            <table class="table app-table-hover mb-0 text-left">
                                                <thead>
                                                    <tr>
                                                        <th>Total</th>
                                                        <th>End Date</th>
                                                        <th>start Date</th>
                                                        <th>parah</th>
                                                        <th>Subject</th>
                                                        <th>Student</th>
                                                        <th>Date</th>
                                                        <th>SNo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    @foreach ($student as $item)
                                                        <tr>
                                                            <th>
                                                                <?php
                                                                $arr = explode('-', $item->exam1_time);
                                                                $arr1 = explode('-', $item->exam2_time);
                                                                $arr2 = explode('-', $item->exam3_time);

                                                                if (sizeof($arr) > 2) {
                                                                    echo $arr[2] . '<br>';
                                                                }

                                                                ?>
                                                            </th>
                                                            <th>
                                                                <?php

                                                                $arr = explode('-', $item->exam1_time);
                                                                $arr1 = explode('-', $item->exam2_time);
                                                                $arr2 = explode('-', $item->exam3_time);

                                                                if (sizeof($arr) > 1) {

                                                                    echo $arr[1] . '<br>';
                                                                    $value1 = $arr[1];

                                                                }

                                                                ?>
                                                            </th>
                                                            <th>

                                                                <?= explode('-', $item->exam1_time)[0] . '<br>' ?>

                                                            </th>
                                                            <th>

                                                                <?= $item->exam_1 . ' ' . $item->exam_1a . '<br>' ?>

                                                            </th>

                                                            <th>بعد فجر نیا سبق</th>
                                                            <th>{{ $item->student_name }}</th>
                                                            <th>{{ $item->arabic_date }}</th>
                                                            <th>{{ $i++ }}</th>
                                                        </tr>
                                                        <?php
$value2 = explode('-', $item->exam2_time)[0];



if(isset($value1) && isset($value2)){
    $time1 =explode(':',$value1);
    $time2 =explode(':',$value2);



    if((int)$time1[0] <= (int)$time2[0] && (int)$time2[1] > (int)$time1[1]){
        ?>
                                                        <tr style="background-color: gray">
                                                            <th></th>
                                                            <th></th>

                                                            <?php

$one = (int)$time1[0]-(int)$time2[0];
$two = (int)$time2[1]-(int)$time1[1];
?>
                                                            <th>{{$one.":".$two}}</th>
                                                            <th> Time Gap</th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                        <?php
    }
}
?>
                                                        <tr>
                                                            <th>
                                                                <?php
                                                                $arr = explode('-', $item->exam1_time);
                                                                $arr1 = explode('-', $item->exam2_time);
                                                                $arr2 = explode('-', $item->exam3_time);
                                                                if (sizeof($arr1) > 2) {
                                                                    echo $arr1[2] . '<br>';

                                                                }
                                                                ?>
                                                            </th>
                                                            <th>
                                                                <?php
                                                                $arr = explode('-', $item->exam1_time);
                                                                $arr1 = explode('-', $item->exam2_time);
                                                                $arr2 = explode('-', $item->exam3_time);
                                                                if (sizeof($arr1) > 1) {
                                                                    echo $arr1[1] . '<br>';
                                                                     $value3 = $arr1[1];
                                                                }
                                                                ?>
                                                            </th>
                                                            <th>
                                                                <?= explode('-', $item->exam2_time)[0] . '<br>' ?>
                                                            </th>
                                                            <th>
                                                                <?= $item->exam_2 . ' ' . $item->exam_2a . '<br>' ?>
                                                            </th>
                                                            <th>بعد چاشت نیا سبق</th>
                                                            <th>{{ $item->student_name }}</th>
                                                            <th>{{ $item->arabic_date }}</th>
                                                            <th>{{ $i++ }}</th>
                                                        </tr>
                                                        <?php

$value4 = explode('-', $item->exam3_time)[0];

if(isset($value3) && isset($value4)){
    $time4 =explode(':',$value3);
    $time5 =explode(':',$value4);

    if((int)$time4[0] <= (int)$time5[0] && (int)$time5[1] > (int)$time4[1]){
        ?>
                                                        <tr style="background-color: gray">
                                                            <th></th>
                                                            <th></th>

                                                            <?php

$one = (int)$time4[0]-(int)$time5[0];
$two = (int)$time5[1]-(int)$time4[1];
?>
                                                            <th>{{$one.":".$two}}</th>
                                                            <th> Time Gap</th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                        <?php
    }
}
?>


                                                        <tr>
                                                            <th>
                                                                <?php
                                                                $arr = explode('-', $item->exam1_time);
                                                                $arr1 = explode('-', $item->exam2_time);
                                                                $arr2 = explode('-', $item->exam3_time);
                                                                if (sizeof($arr2) > 2) {
                                                                    echo $arr2[2] . '<br>';
                                                                } ?>
                                                            </th>
                                                            <th>
                                                                <?php
                                                                $arr = explode('-', $item->exam1_time);
                                                                $arr1 = explode('-', $item->exam2_time);
                                                                $arr2 = explode('-', $item->exam3_time);
                                                                if (sizeof($arr2) > 1) {
                                                                    echo $arr2[1] . '<br>';
                                                                } ?>
                                                            </th>
                                                            <th>
                                                                <?= explode('-', $item->exam3_time)[0] . '<br>' ?>
                                                            </th>
                                                            <th>
                                                                <?= $item->exam_3 . ' ' . $item->exam_3a . '<br>' ?>
                                                            </th>
                                                            <th>بعد ظہر نیا سبق</th>
                                                            <th>{{ $item->student_name }}</th>
                                                            <th>{{ $item->arabic_date }}</th>
                                                            <th>{{ $i++ }}</th>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </footer>
                                    </div>
                                </div>
                                <input type="button" style="margin:1% 30%" class="btn btn-primary"
                                    onclick="printDiv('print')" value="print nazira" />
                            </div>
                            </form>
                        @endsection
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
