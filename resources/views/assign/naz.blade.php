@extends('layouts.master')
@section('content')
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto" style="display:inline;">
                        <h1 class="app-page-title mb-0">


                            {{ $student->name }}
                        </h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <style>
                                        .cell {
                                            text-align: center;
                                        }

                                        th,td{

                                            text-align: left !important;
                                            border: 2px solid black;
                                        }

                                    </style>
                                </div>

                            </div>
                            <!--//row-->
                        </div>
                        <!--//table-utilities-->
                    </div>
                    <!--//col-auto-->
                </div>

                @if ($errors->any())
                    <?php
                    echo '<script type ="text/JavaScript">';
                    echo 'alert("' . $errors->first() . '")';
                    echo '</script>';
                    ?>
                @endif
                <h4 style="text-align: center;">Nazira Syllabus</h4>
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



                                    <table class="table app-table-hover mb-0 text-left" id="mytable">
                                        <thead style="background: yellow;">
                                            <tr>
                                                <th class="cell">Month</th>
                                                <th class="cell">Target</th>
                                                <th class="cell">Total</th>
                                            </tr>
                                        </thead>
                                        <?php foreach ($parah as $date2a) {
                                            $para[] = $date2a->para_order;
                                            $para0[] = $date2a->id;
                                        }
                                        
                                        ?>
                                        <tbody>
                                            <form action="add_syllabi" method="POST">
                                                @csrf
                                                @method('POST')

                                                <input type="hidden" name="student_id" value={{ $student->id }}>
                                                <input type="hidden" name="course_id" value={{ $student->course_id }}>
                                                <tr>

                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $date2[0][1] }}" name="month[]"
                                                            checked hidden><label>{{ $date2[0][0] }}</label><br></td>
                                                    <td>
                                                        <select name="select[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi" selected>Taq-Thi</option>
                                                            <option value="Parah">Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3" selected>3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <?php for($i=8;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td id="total1"><input type="text" name="para_id1[]" value="1 to 3">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $date2[1][1] }}" name="month[]"
                                                            checked hidden><label>{{ $date2[1][0] }}</label></td>
                                                    <td>
                                                        <select name="select[]" onchange="showDiv2(this)" id="select2">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi" selected>Taq-Thi</option>
                                                            <option value="Parah">Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para2">
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
                                                            <option value="12" selected>12</option>

                                                            <?php for($i=13;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                        <input type="hidden" name="nazcheck" value="1" />
                                                    </td>
                                                    <td id="total2"><input type="text" name="para_id2[]" value="4 to 15">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $date2[2][1] }}" name="month[]"
                                                            checked hidden><label>{{ $date2[2][0] }}</label></td>
                                                    <td>
                                                        <select name="select[]" onchange="showDiv3(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi" selected>Taq-Thi</option>
                                                            <option value="Parah">Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para3">
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
                                                            <option value="13" selected>13</option>

                                                            <?php for($i=14;$i<=30;$i++){ 
                                                            echo "<option value=".$i.">$i</option>"; ?>

                                                            <?php } ?>
                                                        </select>

                                                    </td>
                                                    <td id="total3"><input type="text" name="para_id3[]" value="16 to 28">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $date2[3][1] }}" name="month[]"
                                                            checked hidden><label>{{ $date2[3][0] }}</label></td>
                                                    <td>
                                                        <select name="select[]" onchange="showDiv4(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para4">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <option value="1" selected>1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <?php for($i=8;$i<=30;$i++){ 
                                                            echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td id="total4">
                                                        <input type="text" style="display:none;">
                                                        <div>
                                                            <input type="checkbox" id="vehicle1" name="para_id4"
                                                                value="{{ $para0[0] }}" checked>
                                                            <label for="vehicle1"> {{ $para[0] }}</label><br>
                                                        </div>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $date2[4][1] }}" name="month[]"
                                                            checked hidden><label>{{ $date2[4][0] }}</label></td>
                                                    <td>
                                                        <select name="select[]" onchange="showDiv5(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para5">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <option value="1">1</option>
                                                            <option value="2" selected>2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <?php for($i=8;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>

                                                    <td id="total5">
                                                        <input type="text" style="display:none;">
                                                        <div>
                                                            <input type="checkbox" id="vehicle1" name="para_id5[]"
                                                                value="{{ $para0[1] }}" checked>
                                                            <label for="vehicle1"> {{ $para[1] }}</label><br>

                                                            <input type="checkbox" id="vehicle1" name="para_id5[]"
                                                                value="{{ $para0[2] }}" checked>
                                                            <label for="vehicle1"> {{ $para[2] }}</label><br>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $date2[5][1] }}" name="month[]"
                                                            checked hidden><label>{{ $date2[5][0] }}</label></td>
                                                    <td>
                                                        <select name="select[]" onchange="showDiv6(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>

                                                        <select name="para_number[]" id="para6">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3" selected>3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <?php for($i=8;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td id="total6">
                                                        <input type="text" style="display:none;">
                                                        <div>
                                                            <input type="checkbox" id="vehicle1" name="para_id6[]"
                                                                value="{{ $para0[3] }}" checked>
                                                            <label for="vehicle1"> {{ $para[3] }}</label><br>

                                                            <input type="checkbox" id="vehicle1" name="para_id6[]"
                                                                value="{{ $para0[4] }}" checked>
                                                            <label for="vehicle1"> {{ $para[4] }}</label><br>

                                                            <input type="checkbox" id="vehicle1" name="para_id6[]"
                                                                value="{{ $para0[5] }}" checked>
                                                            <label for="vehicle1"> {{ $para[5] }}</label><br>
                                                        </div>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $date2[6][1] }}" name="month[]"
                                                            checked hidden><label>{{ $date2[6][0] }}</label></td>
                                                    <td>
                                                        <select name="select[]" onchange="showDiv7(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para7">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5" selected>5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <?php for($i=8;$i<=30;$i++){  
                                                            echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>

                                                    <td id="total7">

                                                        <input type="text" style="display:none;">
                                                        <div>
                                                            <input type="checkbox" id="vehicle1" name="para_id7[]"
                                                                value="{{ $para0[6] }}" checked>
                                                            <label for="vehicle1"> {{ $para[6] }}</label><br>

                                                            <input type="checkbox" id="vehicle1" name="para_id7[]"
                                                                value="{{ $para0[7] }}" checked>
                                                            <label for="vehicle1"> {{ $para[7] }}</label><br>

                                                            <input type="checkbox" id="vehicle1" name="para_id7[]"
                                                                value="{{ $para0[8] }}" checked>
                                                            <label for="vehicle1"> {{ $para[8] }}</label><br>
                                                            <input type="checkbox" id="vehicle1" name="para_id7[]"
                                                                value="{{ $para0[9] }}" checked>
                                                            <label for="vehicle1"> {{ $para[9] }}</label>

                                                            <input type="checkbox" id="vehicle1" name="para_id7[]"
                                                                value="{{ $para0[10] }}" checked>
                                                            <label for="vehicle1"> {{ $para[10] }}</label><br>

                                                        </div>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $date2[7][1] }}" name="month[]"
                                                            checked hidden><label>{{ $date2[7][0] }}</label></td>
                                                    <td>
                                                        <select name="select[]" onchange="showDiv8(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para8">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6" selected>6</option>
                                                            <option value="7">7</option>
                                                            <?php for($i=8;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>

                                                    <td id="total8">
                                                        <input type="text" style="display:none;">
                                                        <div>
                                                            <input type="checkbox" id="vehicle1" name="para_id8[]"
                                                                value="{{ $para0[11] }}" checked>
                                                            <label for="vehicle1"> {{ $para[11] }}</label><br>

                                                            <input type="checkbox" id="vehicle1" name="para_id8[]"
                                                                value="{{ $para0[12] }}" checked>
                                                            <label for="vehicle1"> {{ $para[12] }}</label><br>

                                                            <input type="checkbox" id="vehicle1" name="para_id8[]"
                                                                value="{{ $para0[13] }}" checked>
                                                            <label for="vehicle1"> {{ $para[13] }}</label><br>
                                                            <input type="checkbox" id="vehicle1" name="para_id8[]"
                                                                value="{{ $para0[14] }}" checked>
                                                            <label for="vehicle1"> {{ $para[14] }}</label><br>

                                                            <input type="checkbox" id="vehicle1" name="para_id8[]"
                                                                value="{{ $para0[15] }}" checked>
                                                            <label for="vehicle1"> {{ $para[15] }}</label><br>
                                                            <input type="checkbox" id="vehicle1" name="para_id8[]"
                                                                value="{{ $para0[16] }}" checked>
                                                            <label for="vehicle1"> {{ $para[16] }}</label><br>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $date2[8][1] }}" name="month[]"
                                                            checked hidden><label>{{ $date2[8][0] }}</label></td>
                                                    <td>
                                                        <select name="select[]" onchange="showDiv9(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para9">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6" selected>6</option>
                                                            <option value="7">7</option>
                                                            <?php for($i=8;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td id="total9">
                                                        <input type="text" style="display:none;">
                                                        <div>
                                                            <input type="checkbox" id="vehicle1" name="para_id9[]"
                                                                value="{{ $para0[17] }}" checked>
                                                            <label for="vehicle1"> {{ $para[17] }}</label><br>

                                                            <input type="checkbox" id="vehicle1" name="para_id9[]"
                                                                value="{{ $para0[18] }}" checked>
                                                            <label for="vehicle1"> {{ $para[18] }}</label<br>

                                                                <input type="checkbox" id="vehicle1" name="para_id9[]"
                                                                    value="{{ $para0[19] }}" checked>
                                                                <label for="vehicle1"> {{ $para[19] }}</label><br>
                                                                <input type="checkbox" id="vehicle1" name="para_id9[]"
                                                                    value="{{ $para0[20] }}" checked>
                                                                <label for="vehicle1"> {{ $para[20] }}</label><br>

                                                                <input type="checkbox" id="vehicle1" name="para_id9[]"
                                                                    value="{{ $para0[21] }}" checked>
                                                                <label for="vehicle1"> {{ $para[21] }}</label><br>
                                                                <input type="checkbox" id="vehicle1" name="para_id9[]"
                                                                    value="{{ $para0[22] }}" checked>
                                                                <label for="vehicle1"> {{ $para[22] }}</label><br>

                                                        </div>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $date2[9][1] }}" name="month[]"
                                                            checked hidden><label>{{ $date2[9][0] }}</label></td>
                                                    <td>
                                                        <select name="select[]" onchange="showDiv10(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para10">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7" selected>7</option>
                                                            <?php for($i=8;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td id="total10">
                                                        <input type="checkbox" id="vehicle1" name="para_id10[]"
                                                            value="{{ $para0[23] }}" checked>
                                                        <label for="vehicle1"> {{ $para[23] }}</label><br>

                                                        <input type="checkbox" id="vehicle1" name="para_id10[]"
                                                            value="{{ $para0[24] }}" checked>
                                                        <label for="vehicle1"> {{ $para[24] }}</label><br>

                                                        <input type="checkbox" id="vehicle1" name="para_id10[]"
                                                            value="{{ $para0[25] }}" checked>
                                                        <label for="vehicle1"> {{ $para[25] }}</label><br>
                                                        <input type="checkbox" id="vehicle1" name="para_id10[]"
                                                            value="{{ $para0[26] }}" checked>
                                                        <label for="vehicle1"> {{ $para[26] }}</label><br>

                                                        <input type="checkbox" id="vehicle1" name="para_id10[]"
                                                            value="{{ $para0[27] }}" checked>
                                                        <label for="vehicle1"> {{ $para[27] }}</label><br>
                                                        <input type="checkbox" id="vehicle1" name="para_id10[]"
                                                            value="{{ $para0[28] }}" checked>
                                                        <label for="vehicle1"> {{ $para[28] }}</label><br>
                                                        <input type="checkbox" id="vehicle1" name="para_id10[]"
                                                            value="{{ $para0[29] }}" checked>
                                                        <label for="vehicle1"> {{ $para[29] }}</label><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $date2[10][1] }}" name="month[]"
                                                            checked hidden><label>{{ $date2[10][0] }}</label></td>
                                                    <td>
                                                        <select name="select[]" onchange="showDiv11(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah">Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para11">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <?php for($i=8;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td id="total11"><input type="text"></td>
                                                </tr>
                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $date2[11][1] }}" name="month[]"
                                                            checked hidden><label>{{ $date2[11][0] }}</label></td>
                                                    <td>
                                                        <select name="select[]" onchange="showDiv12(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah">Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para12">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <?php for($i=8;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td id="total12"><input type="text"></td>
                                                </tr>
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-secondary" href="reload">Manually</a>
                    <button type="submit" class="btn btn-primary" style="margin-left:50%;">Submit</button>
                    </form>
@endsection
