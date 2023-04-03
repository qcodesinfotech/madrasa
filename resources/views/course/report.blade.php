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
                    $date = strtotime($date);
                    $date = strtotime('-5 day', $date);
                    $date1 = date('Y-m-d', $date);
                    $date = date('Y-m-d');

                    ?>

                    <form action="reportit" method="GET">

                        @csrf
                        @method('GET')

                        <div style="display: flex;justify-content:space-evenly;margin-bottom:10px;">
                            <div>
                                <select name="teacher_id" style="width: 100%" class="form-select" required>
                                    <option value="">Select Teacher</option>
                                    <?php foreach($teacher as $data){ ?>
                                    <option value="{{ $data->id }}">{{ $data->full_name }}</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div>
                                <input type="date" value="{{ $date1 }}" name="date1">


                            </div>
                            <div>
                                <input type="date" value="{{ $date }}" name="date2">


                            </div>


                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>


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

                                                        <th class="cell">Day Report</th>
                                                        <th class="cell">Exam3</th>
                                                        <th class="cell">Exam2</th>
                                                        <th class="cell">Exam1</th>
                                                        <th class="cell">coure</th>
                                                        <th class="cell">students</th>
                                                        <th class="cell">date</th>
                                                        <th class="cell">SNo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1;



                                                    ?>


                                                    @foreach ($student as $item)
                                                        <tr>


                                                            <th>
                                                                <?php

$da = str_replace('/', '-', $item['arabic_date']);

?>
                                                            <a href="{{ route('onedayreport', $item['teacher_id']."--".$da) }}" class="btn btn-primary">Report </a>

                                                        </th>
                                                            <th> <?= $item['exam_1'] . ' ' . $item['exam_1a'] . '<br>' ?></th>
                                                            <th> <?= $item['exam_2'] . ' ' . $item['exam_2a'] . '<br>' ?></th>
                                                            <th> <?= $item['exam_3'] . ' ' . $item['exam_3a'] . '<br>' ?></th>




                                                            <th class="cell">{{ $item['course'] }}</th>
                                                            <th class="cell">{{ $item['student_name'] }}</th>
                                                            <th class="cell">{{ $item['arabic_date'] }}</th>
                                                            <th class="cell">{{ $i++ }}</th>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </footer>
                                    </div>
                                </div>

                            </div>
                            </form>
                        @endsection


