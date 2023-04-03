@extends('layouts.master')
@section('content')
<?php 
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   
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
            border-radius: 2px;
            height: 39px;
            width: 300px;
        }

        th.cell,
        td.cell {
            text-align: left;
            border: 1px solid black;
        }
    </style>
    
    <form action="add_syllabi" method="POST">
        @csrf
        @method('POST')
        <div class="app-wrapper">
            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">
                    <div class="row g-3 mb-4 align-items-center justify-content-between">
                        <div class="col-auto">
                            <div style="display: flex;">
                                <p>
                                    <select name="course_id" id="course_id">
                                        @foreach ($student as $data)
                                            <option value="{{ $data->course_id }}">{{ $data->course_title }}</option>
                                        @endforeach
                                    </select>
                                </p>
                                <p>:course</p>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="page-utilities">
                                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                    <div class="col-auto">
                                        <div style="display: flex;">
                                            <p>
                                        <select name="student_id" id="stud_id">
                                                    @foreach ($student as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                        </select>
                                            </p>
                                            <p>:student</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div style="display: flex;">
                    <p><select name="Year" id="year">
                            <?php if($value == "z"){ ?>
                            <option value="1">1st Year</option>
                            <?php }elseif($value == "a"){  ?>
                            <option value="2">2nd Year</option>
                            <?php }elseif($value == "b"){  ?>
                            <option value="3">3rd Year</option>
                            <?php }elseif($value == "c"){  ?>
                            <option value="4">4th Year</option>
                            <?php }else{ ?>
                            <option value="5">5th Year</option>
                            <?php } ?>
                        </select></p>
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
                                                <th class="cell">Parah</th>
                                                <th class="cell">Target </th>
                                                <th class="cell">Month</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php 
if($value !== "z"){
?>
                                                <td class="cell">
                                                    <div id="paran0">
                                                    </div>
                                                    <div id="input0" style="display: none;">
                                                        <input type="text" id="scales" id="input" name="para_id1[]">
                                                    </div>
                                                </td>
                                                <td class="cell">
                                                    <select name="select[]" onchange="showDiv0(this)">
                                                        <option value="">select category</option>
                                                        <option value="Taq-Thi">Taq-Thi</option>
                                                        <option value="Parah">Parah</option>
                                                        <option value="M-Dor">M-Dor</option>
                                                    </select>
                                                    <select name="para_number[]" style="display:none;" id="para0">
                                                        <option value="">Select Target</option>
                                                        <option value="1/2">1/2</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                    </select>
                                                </td>
<?php 
}else{
?>
                                                <td class="cell">
                                                    <div id="paran1">
                                                    </div>
                                                    <div id="input" style="display: none;">
                                                        <input type="text" id="scales" id="input" name="para_id1[]">
                                                    </div>
                                                </td>
                                                <td class="cell">

                                                    <select name="select[]" onchange="showDiv(this)">
                                                        <option value="">select category</option>
                                                        <option value="Taq-Thi">Taq-Thi</option>
                                                        <option value="Parah">Parah</option>
                                                        <option value="M-Dor">M-Dor</option>
                                                    </select>

                                                    <select name="para_number[]" style="display:none;" id="para1">
                                                        <option value="">Select Target</option>
                                                        <option value="1/2">1/2</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                    </select>
                                                </td>
                                                <?php  } ?>
                                                <td class="cell"><input type="checkbox" id="scales"
                                                        value="{{ $dat[0][1] }}" name="month[]"
                                                        checked><label>{{ $dat[0][0] }}</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cell">
                                                    <div id="paran2">
                                                    </div>
                                                    <div id="input1" style="display: none;">
                                                        <input type="text" id="scales" name="para_id2[]">
                                                    </div>
                                                </td>
                                                <td class="cell">
                                                    <select name="select[]" onchange="showDiv1(this)" id="select1">
                                                        <option value="">select category</option>
                                                        <option value="Taq-Thi">Taq-Thi</option>
                                                        <option value="Parah">Parah</option>
                                                        <option value="M-Dor">M-Dor</option>
                                                    </select>
                                                    <select name="para_number[]" style="display:none;" id="para2">
                                                        <option value="">Select Target</option>
                                                        <option value="1/2">1/2</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                    </select>
                                                </td>
                                                <td class="cell"><input type="checkbox" id="scales"
                                                        value="{{ $dat[1][1] }}" name="month[]"
                                                        checked><label>{{ $dat[1][0] }}</label></td>
                                            </tr>
                                            <tr>
                                                <td class="cell">
                                                    <div id="paran3">
                                                    </div>
                                                    <div id="input2" style="display: none;">
                                                        <input type="text" name="para_id3[]">
                                                    </div>
                                                </td>
                                                <td class="cell">
                                                    <select name="select[]" onchange="showDiv2(this)" id="select1">
                                                        <option value="">select category</option>
                                                        <option value="">select category</option>
                                                        <option value="Taq-Thi">Taq-Thi</option>
                                                        <option value="Parah">Parah</option>
                                                        <option value="M-Dor">M-Dor</option>
                                                    </select>
                                                    <select name="para_number[]" style="display:none;" id="para3">
                                                        <option value="">Select Target</option>
                                                        <option value="1/2">1/2</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                    </select>
                                                </td>
                                                <td class="cell"><input type="checkbox" id="scales"
                                                        value="{{ $dat[2][1] }}" name="month[]"
                                                        checked><label>{{ $dat[2][0] }}</label></td>
                                            </tr>
                                            <tr>
                                                <td class="cell">
                                                    <div id="paran4">
                                                    </div>
                                                    <div id="input3" style="display: none;">
                                                        <input type="text" id="scales" name="para_id4[]">
                                                    </div>
                                                </td>
                                                <td class="cell">
                                                    <select name="select[]" onchange="showDiv3(this)" id="select1">
                                                        <option value="">select category</option>
                                                        <option value="">select category</option>
                                                        <option value="Taq-Thi">Taq-Thi</option>
                                                        <option value="Parah">Parah</option>
                                                        <option value="M-Dor">M-Dor</option>
                                                    </select>
                                                    <select name="para_number[]" style="display:none;" id="para4">
                                                        <option value="">Select Target</option>
                                                        <option value="1/2">1/2</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                    </select>
                                                </td>
                                                <td class="cell"><input type="checkbox" id="scales"
                                                        value="{{ $dat[3][1] }}" name="month[]"
                                                        checked><label>{{ $dat[3][0] }}</label></td>
                                            </tr>
                                            <tr>
                                                <td class="cell">
                                                    <div id="paran5">
                                                    </div>
                                                    <div id="input4" style="display: none;">
                                                        <input type="text" id="scales" name="para_id5[]">
                                                    </div>
                                                </td>
                                                <td class="cell">
                                                    <select name="select[]" onchange="showDiv4(this)" id="select1">
                                                        <option value="">select category</option>
                                                        <option value="">select category</option>
                                                        <option value="Taq-Thi">Taq-Thi</option>
                                                        <option value="Parah">Parah</option>
                                                        <option value="M-Dor">M-Dor</option>
                                                    </select>
                                                    <select name="para_number[]" style="display:none;" id="para5">
                                                        <option value="">Select Target</option>
                                                        <option value="1/2">1/2</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                    </select>
                                                </td>
                                                <td class="cell"><input type="checkbox" id="scales"
                                                        value="{{ $dat[4][1] }}" name="month[]"
                                                        checked><label>{{ $dat[4][0] }}</label></td>
                                            </tr>
                                            <tr>
                                                <td class="cell">
                                                    <div id="paran6">
                                                    </div>
                                                    <div id="input5" style="display: none;">
                                                        <input type="text" id="scales" name="para_id6[]">
                                                    </div>
                                                </td>
                                                <td class="cell">
                                                    <select name="select[]" onchange="showDiv5(this)" id="select1">
                                                        <option value="">select category</option>
                                                        <option value="">select category</option>
                                                        <option value="Taq-Thi">Taq-Thi</option>
                                                        <option value="Parah">Parah</option>
                                                        <option value="M-Dor">M-Dor</option>
                                                    </select>
                                                    <select name="para_number[]" style="display:none;" id="para6">
                                                        <option value="">Select Target</option>
                                                        <option value="1/2">1/2</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                    </select>
                                                </td>
                                                <td class="cell"><input type="checkbox" id="scales"
                                                        value="{{ $dat[5][1] }}" name="month[]"
                                                        checked><label>{{ $dat[5][0] }}</label></td>
                                            </tr>
                                            <tr>
                                                <td class="cell">
                                                    <div id="paran7">
                                                    </div>
                                                    <div id="input6" style="display: none;">
                                                        <input type="text" id="scales" name="para_id7[]">
                                                    </div>
                                                </td>
                                                <td class="cell">
                                                    <select name="select[]" onchange="showDiv6(this)" id="select1">
                                                        <option value="">select category</option>
                                                        <option value="">select category</option>
                                                        <option value="Taq-Thi">Taq-Thi</option>
                                                        <option value="Parah">Parah</option>
                                                        <option value="M-Dor">M-Dor</option>
                                                    </select>
                                                    <select name="para_number[]" style="display:none;" id="para7">
                                                        <option value="">Select Target</option>
                                                        <option value="1/2">1/2</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                    </select>
                                                </td>
                                                <td class="cell"><input type="checkbox" id="scales"
                                                        value="{{ $dat[6][1] }}" name="month[]"
                                                        checked><label>{{ $dat[6][0] }}</label></td>
                                            </tr>
                                            <tr>
                                                <td class="cell">
                                                    <div id="paran8">
                                                    </div>
                                                    <div id="input7" style="display: none;">
                                                        <input type="text" id="scales" name="para_id8[]">
                                                    </div>
                                                </td>
                                                <td class="cell">
                                                    <select name="select[]" onchange="showDiv7(this)" id="select1">
                                                        <option value="">select category</option>
                                                        <option value="Taq-Thi">Taq-Thi</option>
                                                        <option value="Parah">Parah</option>
                                                        <option value="M-Dor">M-Dor</option>
                                                    </select>
                                                    <select name="para_number[]" style="display:none;" id="para8">
                                                        <option value="">Select Target</option>
                                                        <option value="1/2">1/2</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                    </select>
                                                </td>
                                                <td class="cell"><input type="checkbox" id="scales"
                                                        value="{{ $dat[7][1] }}" name="month[]"
                                                        checked><label>{{ $dat[7][0] }}</label></td>
                                            </tr>
                                            <tr>
                                                <td class="cell">
                                                    <div id="paran9">
                                                    </div>
                                                    <div id="input8" style="display: none;">
                                                        <input type="text" id="scales" name="para_id9[]">
                                                    </div>
                                                </td>
                                                <td class="cell">
                                                    <select name="select[]" onchange="showDiv8(this)" id="select1">
                                                        <option value="">select category</option>
                                                        <option value="">select category</option>
                                                        <option value="Taq-Thi">Taq-Thi</option>
                                                        <option value="Parah">Parah</option>
                                                        <option value="M-Dor">M-Dor</option>
                                                    </select>
                                                    <select name="para_number[]" style="display:none;" id="para9">
                                                        <option value="">Select Target</option>
                                                        <option value="1/2">1/2</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                    </select>
                                                </td>
                                                <td class="cell"><input type="checkbox" id="scales"
                                                        value="{{ $dat[8][1] }}" name="month[]"
                                                        checked><label>{{ $dat[8][0] }}</label></td>
                                            </tr>
                                            <tr>
                                                <td class="cell">
                                                    <div id="paran10">
                                                    </div>
                                                    <div id="input9" style="display: none;">
                                                        <input type="text" id="scales" name="para_id10[]">
                                                    </div>
                                                </td>
                                                <td class="cell">
                                                    <select name="select[]" onchange="showDiv9(this)" id="select1">
                                                        <option value="">select category</option>
                                                        <option value="">select category</option>
                                                        <option value="Taq-Thi">Taq-Thi</option>
                                                        <option value="Parah">Parah</option>
                                                        <option value="M-Dor">M-Dor</option>
                                                    </select>
                                                    <select name="para_number[]" style="display:none;" id="para10">
                                                        <option value="">Select Target</option>
                                                        <option value="1/2">1/2</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                    </select>
                                                </td>
                                                <td class="cell"><input type="checkbox" id="scales"
                                                        value="{{ $dat[9][1] }}" name="month[]"
                                                        checked><label>{{ $dat[9][0] }}</label></td>
                                            </tr>
                                            <tr>
                                                <td class="cell">
                                                    <div id="paran11">
                                                    </div>
                                                    <div id="input10" style="display: none;">
                                                        <input type="text" id="scales" name="para_id11[]">
                                                    </div>
                                                </td>
                                                <td class="cell">
                                                    <select name="select[]" onchange="showDiv10(this)" id="select1">
                                                        <option value="">select category</option>
                                                        <option value="Taq-Thi">Taq-Thi</option>
                                                        <option value="Parah">Parah</option>
                                                        <option value="M-Dor">M-Dor</option>
                                                    </select>
                                                    <select name="para_number[]" style="display:none;" id="para11">
                                                        <option value="">Select Target</option>
                                                        <option value="1/2">1/2</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                    </select>
                                                </td>
                                                <td class="cell"><input type="checkbox" id="scales"
                                                        value="{{ $dat[10][1] }}" name="month[]"
                                                        checked><label>{{ $dat[10][0] }}</label></td>
                                            </tr>
                                            <tr>
                                                <td class="cell">
                                                    <div id="paran12">
                                                    </div>
                                                    <div id="input11" style="display: none;">
                                                        <input type="text" id="scales" name="para_id12[]">
                                                    </div>
                                                </td>
                                                <td class="cell">
                                                    <select name="select[]" onchange="showDiv11(this)" id="select1">
                                                        <option value="">select category</option>
                                                        <option value="Taq-Thi">Taq-Thi</option>
                                                        <option value="Parah">Parah</option>
                                                        <option value="M-Dor">M-Dor</option>
                                                    </select>
                                                    <select name="para_number[]" style="display:none;" id="para12">
                                                        <option value="">Select Target</option>
                                                        <option value="1/2">1/2</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                    </select>
                                                </td>
                                                <td class="cell"><input type="checkbox" id="scales"
                                                        value="{{ $dat[11][1] }}" name="month[]"
                                                        checked><label>{{ $dat[11][0] }}</label>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
    <a class="btn btn-secondary"   href="reload">Clear</a>

  
    <a class="btn btn-danger" style="position:relative; left:60%;" href="javascript: history.back()" >Exit</a>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script type="text/javascript">
        function showDiv0(select1) {
            if (select1.value == "Parah") {
                document.getElementById('para0').style.display = "inline";
                document.getElementById('input0').style.display = "none";
                document.getElementById('paran0').style.display = "inline";
            } else {
                document.getElementById('para0').style.display = "none";
                document.getElementById('input0').style.display = "inline";
                document.getElementById('paran0').style.display = "none";
            }
        }

        function showDiv(select1) {
            if (select1.value == "Parah") {
                document.getElementById('para1').style.display = "inline";
                document.getElementById('input').style.display = "none";
                document.getElementById('paran1').style.display = "inline";
            } else {
                document.getElementById('para1').style.display = "none";
                document.getElementById('input').style.display = "inline";
                document.getElementById('paran1').style.display = "none";
            }
        }

        function showDiv1(select1) {
            if (select1.value == "Parah") {
                document.getElementById('para2').style.display = "inline";
                document.getElementById('input1').style.display = "none";
                document.getElementById('paran2').style.display = "inline";
            } else {
                document.getElementById('para2').style.display = "none";
                document.getElementById('input1').style.display = "inline";
                document.getElementById('paran2').style.display = "none";
            }
        }

        function showDiv2(select1) {
            if (select1.value == "Parah") {
                document.getElementById('para3').style.display = "inline";
                document.getElementById('input2').style.display = "none";
                document.getElementById('paran3').style.display = "inline";
            } else {
                document.getElementById('para3').style.display = "none";
                document.getElementById('input2').style.display = "inline";
                document.getElementById('paran3').style.display = "none";
            }
        }

        function showDiv3(select1) {
            if (select1.value == "Parah") {
                document.getElementById('para4').style.display = "inline";
                document.getElementById('input3').style.display = "none";
                document.getElementById('paran4').style.display = "inline";
            } else {
                document.getElementById('para4').style.display = "none";
                document.getElementById('input3').style.display = "inline";
                document.getElementById('paran4').style.display = "none";
            }
        }

        function showDiv4(select1) {
            if (select1.value == "Parah") {
                document.getElementById('para5').style.display = "inline";
                document.getElementById('input4').style.display = "none";
                document.getElementById('paran5').style.display = "inline";
            } else {
                document.getElementById('para5').style.display = "none";
                document.getElementById('input4').style.display = "inline";
                document.getElementById('paran5').style.display = "none";
            }
        }

        function showDiv5(select1) {
            if (select1.value == "Parah") {
                document.getElementById('para6').style.display = "inline";
                document.getElementById('input5').style.display = "none";
                document.getElementById('paran6').style.display = "inline";
            } else {
                document.getElementById('para6').style.display = "none";
                document.getElementById('input5').style.display = "inline";
                document.getElementById('paran6').style.display = "none";
            }
        }

        function showDiv6(select1) {
            if (select1.value == "Parah") {
                document.getElementById('para7').style.display = "inline";
                document.getElementById('input6').style.display = "none";
                document.getElementById('paran7').style.display = "inline";
            } else {
                document.getElementById('para7').style.display = "none";
                document.getElementById('input6').style.display = "inline";
                document.getElementById('paran7').style.display = "none";
            }
        }

        function showDiv7(select1) {
            if (select1.value == "Parah") {
                document.getElementById('para8').style.display = "inline";
                document.getElementById('input7').style.display = "none";
                document.getElementById('paran8').style.display = "inline";
            } else {
                document.getElementById('para8').style.display = "none";
                document.getElementById('input7').style.display = "inline";
                document.getElementById('paran8').style.display = "none";
            }
        }

        function showDiv8(select1) {
            if (select1.value == "Parah") {
                document.getElementById('para9').style.display = "inline";
                document.getElementById('input8').style.display = "none";
                document.getElementById('paran9').style.display = "inline";
            } else {
                document.getElementById('para9').style.display = "none";
                document.getElementById('input8').style.display = "inline";
                document.getElementById('paran9').style.display = "none";
            }
        }

        function showDiv9(select1) {
            if (select1.value == "Parah") {
                document.getElementById('para10').style.display = "inline";
                document.getElementById('input9').style.display = "none";
                document.getElementById('paran10').style.display = "inline";
            } else {
                document.getElementById('para10').style.display = "none";
                document.getElementById('input9').style.display = "inline";
                document.getElementById('paran10').style.display = "none";
            }
        }

        function showDiv10(select1) {
            if (select1.value == "Parah") {
                document.getElementById('para11').style.display = "inline";
                document.getElementById('input10').style.display = "none";
                document.getElementById('paran11').style.display = "inline";
            } else {
                document.getElementById('para11').style.display = "none";
                document.getElementById('input10').style.display = "inline";
                document.getElementById('paran11').style.display = "none";
            }
        }

        function showDiv11(select1) {
            if (select1.value == "Parah") {
                document.getElementById('para12').style.display = "inline";
                document.getElementById('input11').style.display = "none";
                document.getElementById('paran12').style.display = "inline";
            } else {
                document.getElementById('para12').style.display = "none";
                document.getElementById('input11').style.display = "inline";
                document.getElementById('paran12').style.display = "none";
            }
        }
        
        $('#para0').on('change', function() {
            var paraID = $(this).val();
            var studID = $('#stud_id').val();
            var year = $('#year').val();
            if (studID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('getpara_2') }}?par_id=" + paraID + '&student_id=' + studID+
                        '&year=' + year,
                    success: function(res) {
                        if (res) {
                            $("#paran0").empty();
                            $("#paran0").append('');
                            $.each(res, function(key, value) {
                                $("#paran0").append(
                                    '<input type="checkbox" id="scales" value="' + key +
                                    '" name="para_id1[]" checked>' +
                                    '<label>' + value + '</label><br>');
                            });
                        } else {
                            $("#paran0").empty();
                        }
                    }
                });
            } else {
                $("#paran0").empty();
            }
        });
        $('#para1').change(function() {
            var paraID = $(this).val();
            var studID = $('#stud_id').val();
            var year = $('#year').val();
            if (studID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('getpara') }}?para_id=" + paraID + '&student_id=' + studID+
                        '&year=' + year,
                    success: function(res) {
                        if (res) {
                            $("#paran1").empty();
                            $("#paran1").append('');
                            $.each(res, function(key, value) {
                                $("#paran1").append(
                                    '<input type="checkbox" id="scales" value="' + key +
                                    '" name="para_id1[]" checked>' +
                                    '<label>' + value + '</label><br>');
                            });
                        } else {
                            $("#paran1").empty();
                        }
                    }
                });
            } else {
                $("#paran1").empty();
            }
        });
        $('#para2').on('change', function() {
            var paraID = $(this).val();
            var studID = $('#stud_id').val();
            var para1 = $('#para1').val();
            var year = $('#year').val();
            if (studID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('getpara_2') }}?para_id=" + paraID + '&student_id=' + studID +
                        '&para1=' + para1+
                        '&year=' + year,
                    success: function(res) {
                        if (res) {
                            $("#paran2").empty();
                            $("#paran2").append('');
                            $.each(res, function(key, value) {
                                $("#paran2").append(
                                    '<input type="checkbox" id="scales" value="' + key +
                                    '" name="para_id2[]" checked>' +
                                    '<label>' + value + '</label><br>');
                            });
                        } else {
                            $("#paran2").empty();
                        }
                    }
                });
            } else {
                $("#paran2").empty();
            }
        });
        $('#para3').on('change', function() {
            var paraID = $(this).val();
            var studID = $('#stud_id').val();
            var para1 = $('#para2').val();
            var year = $('#year').val();
            if (studID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('getpara_2') }}?para_id=" + paraID + '&student_id=' + studID +
                        '&para1=' + para1+
                        '&year=' + year,
                    success: function(res) {
                        if (res) {
                            $("#paran3").empty();
                            $("#paran3").append('');
                            $.each(res, function(key, value) {
                                $("#paran3").append(
                                    '<input type="checkbox" id="scales" value="' + key +
                                    '" name="para_id3[]" checked>' +
                                    '<label>' + value + '</label><br>');
                            });
                        } else {
                            $("#paran3").empty();
                        }
                    }
                });
            } else {
                $("#paran3").empty();
            }
        });
        $('#para4').on('change', function() {
            var paraID = $(this).val();
            var studID = $('#stud_id').val();
            var para1 = $('#para3').val();
            var year = $('#year').val();
            if (studID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('getpara_2') }}?para_id=" + paraID + '&student_id=' + studID +
                        '&para1=' + para1+
                        '&year=' + year,
                    success: function(res) {
                        if (res) {
                            $("#paran4").empty();
                            $("#paran4").append('');
                            $.each(res, function(key, value) {
                                $("#paran4").append(
                                    '<input type="checkbox" id="scales" value="' + key +
                                    '" name="para_id4[]" checked>' +
                                    '<label>' + value + '</label><br>');
                            });
                        } else {
                            $("#paran4").empty();
                        }
                    }
                });
            } else {
                $("#paran4").empty();
            }
        });
        $('#para5').on('change', function() {
            var paraID = $(this).val();
            var studID = $('#stud_id').val();
            var para1 = $('#para4').val();
            var year = $('#year').val();
            if (studID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('getpara_2') }}?para_id=" + paraID + '&student_id=' + studID +
                        '&para1=' + para1+
                        '&year=' + year,
                    success: function(res) {
                        if (res) {
                            $("#paran5").empty();
                            $("#paran5").append('');
                            $.each(res, function(key, value) {
                                $("#paran5").append(
                                    '<input type="checkbox" id="scales" value="' + key +
                                    '" name="para_id5[]" checked>' +
                                    '<label>' + value + '</label><br>');
                            });
                        } else {
                            $("#paran5").empty();
                        }
                    }
                });
            } else {
                $("#paran5").empty();
            }
        });
        $('#para6').on('change', function() {
            var paraID = $(this).val();
            var studID = $('#stud_id').val();
            var para1 = $('#para5').val();
            var year = $('#year').val();
            if (studID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('getpara_2') }}?para_id=" + paraID + '&student_id=' + studID +
                        '&para1=' + para1+
                        '&year=' + year,
                    success: function(res) {
                        if (res) {
                            $("#paran6").empty();
                            $("#paran6").append('');
                            $.each(res, function(key, value) {
                                $("#paran6").append(
                                    '<input type="checkbox" id="scales" value="' + key +
                                    '" name="para_id6[]" checked>' +
                                    '<label>' + value + '</label><br>');
                            });
                        } else {
                            $("#paran6").empty();
                        }
                    }
                });
            } else {
                $("#paran6").empty();
            }
        });
        $('#para7').on('change', function() {
            var paraID = $(this).val();
            var studID = $('#stud_id').val();
            var para1 = $('#para6').val();
            var year = $('#year').val();
            if (studID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('getpara_2') }}?para_id=" + paraID + '&student_id=' + studID +
                        '&para1=' + para1+
                        '&year=' + year,
                    success: function(res) {
                        if (res) {
                            $("#paran7").empty();
                            $("#paran7").append('');
                            $.each(res, function(key, value) {
                                $("#paran7").append(
                                    '<input type="checkbox" id="scales" value="' + key +
                                    '" name="para_id7[]" checked>' +
                                    '<label>' + value + '</label><br>');
                            });
                        } else {
                            $("#paran7").empty();
                        }
                    }
                });
            } else {
                $("#paran7").empty();
            }
        });
        $('#para8').on('change', function() {
            var paraID = $(this).val();
            var studID = $('#stud_id').val();
            var para1 = $('#para7').val();
            var year = $('#year').val();
            if (studID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('getpara_2') }}?para_id=" + paraID + '&student_id=' + studID +
                        '&para1=' + para1+
                        '&year=' + year,
                    success: function(res) {
                        if (res) {
                            $("#paran8").empty();
                            $("#paran8").append('');
                            $.each(res, function(key, value) {
                                $("#paran8").append(
                                    '<input type="checkbox" id="scales" value="' + key +
                                    '" name="para_id8[]" checked>' +
                                    '<label>' + value + '</label><br>');
                            });
                        } else {
                            $("#paran8").empty();
                        }
                    }
                });
            } else {
                $("#paran8").empty();
            }
        });
        $('#para9').on('change', function() {
            var paraID = $(this).val();
            var studID = $('#stud_id').val();
            var para1 = $('#para8').val();
            var year = $('#year').val();
            if (studID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('getpara_2') }}?para_id=" + paraID + '&student_id=' + studID +
                        '&para1=' + para1+
                        '&year=' + year,
                    success: function(res) {
                        if (res) {
                            $("#paran9").empty();
                            $("#paran9").append('');
                            $.each(res, function(key, value) {
                                $("#paran9").append(
                                    '<input type="checkbox" id="scales" value="' + key +
                                    '" name="para_id9[]" checked>' +
                                    '<label>' + value + '</label><br>');
                            });
                        } else {
                            $("#paran9").empty();
                        }
                    }
                });
            } else {
                $("#paran9").empty();
            }
        });
        $('#para10').on('change', function() {
            var paraID = $(this).val();
            var studID = $('#stud_id').val();
            var para1 = $('#para9').val();
            var year = $('#year').val();
            if (studID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('getpara_2') }}?para_id=" + paraID + '&student_id=' + studID +
                        '&para1=' + para1+
                        '&year=' + year,
                    success: function(res) {
                        if (res) {
                            $("#paran10").empty();
                            $("#paran10").append('');
                            $.each(res, function(key, value) {
                                $("#paran10").append(
                                    '<input type="checkbox" id="scales" value="' + key +
                                    '" name="para_id10[]" checked>' +
                                    '<label>' + value + '</label><br>');
                            });
                        } else {
                            $("#paran10").empty();
                        }
                    }
                });
            } else {
                $("#paran10").empty();
            }
        });
        $('#para11').on('change', function() {
            var paraID = $(this).val();
            var studID = $('#stud_id').val();
            var para1 = $('#para10').val();
            var year = $('#year').val();
            if (studID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('getpara_2') }}?para_id=" + paraID + '&student_id=' + studID +
                        '&para1=' + para1+
                        '&year=' + year,
                    success: function(res) {
                        if (res) {
                            $("#paran11").empty();
                            $("#paran11").append('');
                            $.each(res, function(key, value) {
                                $("#paran11").append(
                                    '<input type="checkbox" id="scales" value="' + key +
                                    '" name="para_id11[]" checked>' +
                                    '<label>' + value + '</label><br>');
                            });
                        } else {
                            $("#paran11").empty();
                        }
                    }
                });
            } else {
                $("#paran11").empty();
            }
        });
        $('#para12').on('change', function() {
            var paraID = $(this).val();
            var studID = $('#stud_id').val();
            var para1 = $('#para11').val();
            var year = $('#year').val();
            if (studID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('getpara_2') }}?para_id=" + paraID + '&student_id=' + studID +
                        '&para1=' + para1 +
                        '&year=' + year,
                    success: function(res) {
                        if (res) {
                            $("#paran12").empty();
                            $("#paran12").append('');
                            $.each(res, function(key, value) {
                                $("#paran12").append(
                                    '<input type="checkbox" id="scales" value="' + key +
                                    '" name="para_id12[]" checked>' +
                                    '<label>' + value + '</label><br>');
                            });
                        } else {
                            $("#paran12").empty();
                        }
                    }
                });
            } else {
                $("#paran12").empty();
            }
        });
    </script>
@endsection
