@extends('layouts.master')
@section('content')
    <?php
    use App\Http\Controllers\ParaController;
    use Illuminate\Support\Facades\DB;
    ?>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Hifz Update</h1>
                    </div>
                    <input type='submit' name='submitAdd' value='Refresh' class="btn btn-primary"
                        onclick='window.location.reload();'>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <style>
                                        input {
                                            text-transform: capitalize;
                                        }
                                        .cell,
                                        td,
                                        th {
                                            text-align: center;
                                            text-transform: capitalize;
                                            font-weight: 500 !important;
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('hifz_update') }}" method="GET">
                    @csrf
                    <label>Month</label>
                    <select id="month" name="month_id">
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <input type="hidden" name="student_id" value="{{ session('student_id') }}">
                    <label>Year</label>
                    <select id="year" name="year">
                        <?php for($i=2020;$i<2100;$i++){ ?>
                        <option value="{{ $i }}">{{ $i }}</option>
                        <?php } ?>
                    </select>
                    <button class="btn btn-warning"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    @if ($message = Session::get('Success'))
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
                                    <?php $dt = DateTime::createFromFormat('!m', $value['month']); ?>
                                @endforeach
                                <footer id="print">
                                    <style>
                                        input {
                                            text-transform: capitalize;
                                        }
                                 
                                        .cell,
                                        td,
                                        th {
                                            text-align: center;
                                            text-transform: capitalize;
                                            font-weight: 500 !important;
                                            color: black !important;
                                            font-weight: bolder;
                                            font-size:1vw;
                                            border: 2px solid black !important;
                                        }
                                        table thead tr {
                                            background-color: gray !important;
                                        }
                                        h2 {
                                            text-align: center;
                                            text-transform: uppercase;
                                            border-top: 2px solid red;
                                            border-bottom: 2px solid blue;
                                        }

                                        @media print {
                                            .cell,
                                        td,
                                        th {
                                            text-align: center;
                                            text-transform: capitalize;
                                            color: black !important;
                                    
                                            font-size:12px;
       font-family:"Times New Roman";
                                            border: 2px solid black !important;
                                        }
}

                                        .hello div {
                                            display: flex;
                                        }
                                    </style>
                                    <h2> {{ $dt->format('F') }}</h2>
                                    <table class="table app-table-hover mb-0 text-left">
                                        <thead>
                                            <tr id="first">
                                                <th class="cell"> n_exam</th>
                                                <th class="cell"> Total</th>
                                                <th class="cell"> Exam3</th>
                                                <th class="cell"> Exam2</th>
                                                <th class="cell"> Exam1</th>
                                                <th class="cell"> Remark</th>
                                                <th class="cell"> OldExam</th>
                                                <th class="cell"> Day</th>
                                                <th class="cell"> Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                          for($i=-1;$i<=7;$i++){
                                            if($i==$startday){
                                               break;
                                             } }; ?>
                                            <?php $postion = 0; ?>
                                            @foreach ($period as $key => $value)
                                                <?php if($date=="Friday"){ ?><tr>
                                                    <td>Week</td>
                                                </tr><?php } ?>
                                                <?php
                                                $allowed = false;
                                                $daymonth = date('d', strtotime($value['date'])); ?>
                                                @for ($i = 0; $i < sizeof($array); $i++)
                                                    <?php  
                                                       if($daymonth == $array[$i]['arabic_date']){ 
                                                      ?>
                                                    <tr>
                                                        <td>{{ $array[$i]['n_exam'] }}</td>
                                                        <td>{{ $array[$i]['total'] }}</td>




                                                        <td>
                                                            <?php
                                                            if (explode('-', $array[$i]['exam_3'])[0] == '0') {
                                                                echo 'تختی-' . explode('-', $array[$i]['exam_3'])[1];
                                                            } else {
                                                                if (!empty($array[$i]['exam_3'])) {
                                                                    $check = DB::table('paras')
                                                                        ->where('id', explode('-', $array[$i]['exam_3'])[0])
                                                                        ->select('para_name as para')
                                                                        ->first();
                                                                    echo empty($check->para) ?  : $check->para . '-' . explode('-', $array[$i]['exam_3'])[1];
                                                                }
                                                            }
                                                            ?>
                                                            <br>
                                                            <?php
                                                            if (explode('-', $array[$i]['exam_3a'])[0] == '0') {
                                                                echo 'تختی-' . explode('-', $array[$i]['exam_3a'])[1];
                                                            } else {
                                                                if (!empty($array[$i]['exam_3a'])) {
                                                                    $check = DB::table('paras')
                                                                        ->where('id', explode('-', $array[$i]['exam_3a'])[0])
                                                                        ->select('para_name as para')
                                                                        ->first();
                                                                    echo empty($check->para) ?  : $check->para . '-' . explode('-', $array[$i]['exam_3a'])[1] . '<br>';
                                                                }
                                                            }
                                                            ?>
                                                            <div style="color: red">
                                                                <?php
                                                                $a = explode('-', $array[$i]['exam3_time']);
                                                                if (isset($a) && sizeof($a) > 1) {
                                                                    echo $a[0] . '-' . $a[1] . '<br/>';
                                                                  
                                                                }
                                                                if (isset($a) && sizeof($a) > 2) {
                                                                    echo $a[0] . '-' . $a[1] . '<br/>';
                                                                
                                                                }
                                                                ?>
                                                            </div>
                                                        </td>
                                                          
                                                            <td>
                                                                <?php
                                                                if (explode('-', $array[$i]['exam_2'])[0] == '0') {
                                                                    echo 'تختی-' . explode('-', $array[$i]['exam_2'])[1];
                                                                } else {
                                                                    if (!empty($array[$i]['exam_2'])) {
                                                                        $check = DB::table('paras')
                                                                            ->where('id', explode('-', $array[$i]['exam_2'])[0])
                                                                            ->select('para_name as para')
                                                                            ->first();
                                                                        echo empty($check->para) ?  : $check->para . '-' . explode('-', $array[$i]['exam_2'])[1];
                                                                    }
                                                                }
                                                                ?>
                                                                <br>
                                                                <?php
                                                                if (explode('-', $array[$i]['exam_2a'])[0] == '0') {

                                                                    echo 'تختی-' . explode('-', $array[$i]['exam_2a'])[1];

                                                                }else{

                                                                    if (!empty($array[$i]['exam_2a'])) {
                                                                        $check = DB::table('paras')
                                                                            ->where('id', explode('-', $array[$i]['exam_2a'])[0])
                                                                            ->select('para_name as para')
                                                                            ->first();
                                                                        echo empty($check->para) ?  : $check->para . '-' . explode('-', $array[$i]['exam_2a'])[1] . '<br>';
                                                                    }
                                                                }
                                                                ?>
                                                                <div style="color: red">
                                                                <?php
                                                                    $a = explode('-', $array[$i]['exam2_time']);
                                                                    if (isset($a) && sizeof($a) > 1) {
                                                                        echo $a[0] . '-' . $a[1] . '<br/>';
                                                                       
                                                                    }
                                                                    if (isset($a) && sizeof($a) > 2) {
                                                                        echo $a[2] . '<br/>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </td>
                                                          






                                                            <td>
                                                                <?php
                                                                if (explode('-', $array[$i]['exam_1'])[0] == '0') {
                                                                    echo 'تختی-' . explode('-', $array[$i]['exam_1'])[1];
                                                                } else {
                                                                    if (!empty($array[$i]['exam_1'])) {
                                                                        $check = DB::table('paras')
                                                                            ->where('id', explode('-', $array[$i]['exam_1'])[0])
                                                                            ->select('para_name as para')
                                                                            ->first();

                                                                        echo empty($check->para) ?  : $check->para . '-' . explode('-', $array[$i]['exam_1'])[1];
                                                                    
                                                                    }
                                                                }
                                                                ?>
                                                                <br>
                                                                <div style="color: red">
                                                                <?php

                                                               $a = sizeof(explode('-', $array[$i]['exam_2']));
                                                                if ($a<1){
                                                                echo $array[$i]['exam_1'];
                                                            }
                                                            ?>
                                                        </div>
                                                                <br>
                                                                <?php
                                                                if (explode('-', $array[$i]['exam_1a'])[0] == '0') {
                                                                    echo 'تختی-' . explode('-', $array[$i]['exam_1a'])[1];
                                                                } else {
                                                                    if (!empty($array[$i]['exam_1a'])) {
                                                                        $check = DB::table('paras')
                                                                            ->where('id', explode('-', $array[$i]['exam_1a'])[0])
                                                                            ->select('para_name as para')
                                                                            ->first();
                                                                        echo empty($check->para) ?  : $check->para . '-' . explode('-', $array[$i]['exam_1a'])[1] . '<br>';
                                                                    }
                                                                }
                                                                ?>
                                                              
                                                              <div style="color: red">
                                                                    <?php
                                                                    $a = explode('-', $array[$i]['exam1_time']);
                                                                    if (isset($a) && sizeof($a) > 1) {
                                                                        echo $a[0] . '-' . $a[1] . '<br/>';
                                                                 
                                                                    }
                                                                    if (isset($a) && sizeof($a) > 2) {
                                                                        echo $a[2] . '<br/>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </td>
                                                    
                                                        <td style="width:40px;">{{ $array[$i]['remark'] }}</td>
                                                        <td style="width:40px;">{{ $array[$i]['old_exam'] }}</td>
                                                        <td>{{ $date = date('l', strtotime($value['date'])) }}</td>
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
                                                    <td></td>
                                                    <td>{{ $date = date('l', strtotime($value['date'])) }}</td>
                                                    <td>{{ $value['date'] }}</td>
                                                </tr>
                                        <?php } ?>
                                            @endforeach
                                    </table>
                                </footer>
                            </div>
                        </div>
                        <input type="button" onclick="printDiv('print')" value="print nazira" />
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
