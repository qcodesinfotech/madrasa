@extends('layouts.master')
@section('content')
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto" style="display:inline;">
                        <h1 class="app-page-title mb-0">
                            {{ $student->name }}<br>
                            {{ $student->course_title}}
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

                                        td {
                                            text-align: center;
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
                <h4 style="text-align: center;">Hifz Syllabus</h4>
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
                                                <th class="cell">Target</th>
                                                <th class="cell">Total</th>
                                                <th class="cell">Target</th>
                                                <th class="cell">Total</th>
                                                <th class="cell">Target</th>
                                                <th class="cell">Total</th>
                                            </tr>
                                        </thead>
                                                                         
<?php foreach($parah as $data){
    $para[] = $data->para_order;
    $para0[] = $data ->id;
}
                 
?>  
                                        <tbody>
                                            <form action="add_hifz" method="POST">
                                                @csrf
                                                @method('POST')
                                                {{-- Row 1 --}}
                                                <tr>
                                                    {{--1 Column 1 --}}


                                                    <input type="hidden" name="student_id" value={{$student->id}}>
                                                    <input type="hidden" name="course_id" value={{$student->course_id}}>
                                                    <td class="cell">
                                                        <input type="checkbox" id="scales"
                                                            value="{{ $dat[0][1] }}" name="month[]"
                                                            checked><label>{{ $dat[0][0] }}</label>
                                                    </td>
                                                    {{--1 Column 2 --}}

                                                    <td>
                                                        <select name="select1[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <?php
                                                             for($i=1;$i<=30;$i++){ 
                                                                  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                          </select>
                                                    </td>

                                                    {{--1 Column 3 --}}
                                                    
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id1[]"
                                                            value="{{ $para0[0] }}" checked>
                                                        <label for="vehicle1"> {{ $para[0] }}</label>
                                                    </td>
                                                    

{{-- ///// --}}
{{--1 Column 4 --}}

                                                    <td>
                                                        <select name="select2[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    
                                                    {{--1 Column 5 --}}
                                                    
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id13[]"
                                                            value="{{$para0[9]}}" checked>
                                                        <label for="vehicle1"> {{ $para[9] }}</label>
                                                    </td>
                                                    
                                                    <td>
                                                        <select  name="select3[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    
                                                {{--1 Column 6 --}}

                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id25[]"
                                                            value="{{ $para0[18] }}" checked>
                                                        <label for="vehicle1"> {{ $para[18] }}</label>
                                                    </td>

                                                    {{--1 Column 7 --}}
                                                    <td>

                                                        <select name="select4[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>

                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <option value="1" selected>1</option>
                                                            <?php for($i=2;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--1 Column 8 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id37[]"
                                                            value="{{ $para0[27] }}" checked>
                                                        <label for="vehicle1"> {{ $para[27] }}</label>
                                                    </td>
                                                </tr>
                                                {{-- Row 2 --}}
                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $dat[1][1] }}" name="month[]"
                                                            checked><label>{{ $dat[1][0] }}</label></td>
                                                    {{--2 Column 2 --}}
                                                    <td>
                                                        <select name="select1[]"  onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--2 Column 3 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1"  name="para_id2[]"
                                                            value="{{ $para0[0] }}" checked>
                                                        <label for="vehicle1"> {{ $para[0] }}</label>
                                                    </td>

                                                    {{--2 Column 4 --}}
                                                    <td>
                                                        <select  name="select2[]"  onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>

                                                    {{--2 Column 5 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1"  name="para_id14[]"
                                                            value="{{ $para0[9] }}" checked>
                                                        <label for="vehicle1"> {{ $para[9] }}</label>
                                                    </td>
                                                    <td>
                                                        <select name="select3[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    
                                                {{--2 Column 6 --}}

                                                    <td>
                                                        <input type="checkbox" id="vehicle1"  name="para_id26[]"
                                                            value="{{ $para0[18] }}" checked>
                                                        <label for="vehicle1"> {{ $para[18] }}</label>
                                                    </td>

                                                {{--2 Column 7 --}}

                                                    <td>
                                                        <select name="select4[]"  onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <option value="1" selected>1</option>
                                                            <?php for($i=2;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--2 Column 8 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id38[]"
                                                            value="{{ $para0[28] }}" checked>

                                                        <label for="vehicle1"> {{ $para[28] }}</label>
                                                    </td>
                                                </tr>



                                                {{-- Row 3 --}}
                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $dat[2][1] }}" name="month[]"
                                                            checked><label>{{ $dat[2][0] }}</label>
                                                    </td>
                                                    {{--3 Column 2 --}}
                                                    <td>
                                                        <select  name="select1[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--3 Column 3 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id3[]"
                                                            value="{{ $para0[1] }}" checked>
                                                        <label for="vehicle1"> {{ $para[1] }}</label>
                                                    </td>
                                                    {{--3 Column 4 --}}
                                                    <td>
                                                        <select name="select2[]"  onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--3 Column 5 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1"  name="para_id15[]"
                                                            value="{{ $para0[10] }}" checked>
                                                        <label for="vehicle1"> {{ $para[10] }}</label>
                                                    </td>
                                                    <td>
                                                        <select name="select3[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    
                                                {{--3 Column 6 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1"  name="para_id27[]"
                                                            value="{{ $para0[19] }}" checked>
                                                        <label for="vehicle1"> {{ $para[19] }}</label>
                                                    </td>
                                                    {{--3 Column 7 --}}
                                                    <td>
                                                        <select name="select4[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <option value="1" selected>1</option>
                                                            <?php for($i=2;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--3 Column 8 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id39[]"
                                                            value="{{ $para0[29] }}" checked>
                                                        <label > {{ $para[29] }}</label>
                                                    </td>
                                                </tr>

                                                {{-- Row 4 --}}
                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $dat[3][1] }}" name="month[]"
                                                            checked><label>{{ $dat[3][0] }}</label></td>
                                                      {{--4 Column 2 --}}
                                                      <td>
                                                        <select name="select1[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--4 Column 3 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id4[]"
                                                            value="{{ $para0[1] }}" checked>
                                                        <label for="vehicle1"> {{ $para[1] }}</label>
                                                    </td>
                                                    {{--4 Column 4 --}}
                                                    <td>
                                                        <select  name="select2[]"  onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--4 Column 5 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1"  name="para_id16[]"
                                                            value="{{ $para0[10] }}" checked>
                                                        <label for="vehicle1"> {{ $para[10] }}</label>
                                                    </td>
                                                    <td>
                                                        <select name="select3[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    
                                                {{--4 Column 6 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1"  name="para_id28[]"
                                                            value="{{ $para0[19] }}" checked>
                                                        <label for="vehicle1"> {{ $para[19] }}</label>
                                                    </td>
                                                    {{--4 Column 7 --}}
                                                    <td>
                                                        <select name="select4[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah">Parah</option>
                                                            <option value="M-Dor"  selected>M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <option value="1" selected>1</option>
                                                            <?php for($i=2;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--4 Column 8 --}}
                                                    <td>
                                                 
                                                    <input type="text" value="1" name="para_id40[]" style="width:60px;">
                                                    </td>
                                                </tr>


                                                {{-- Row 5 --}}
                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $dat[4][1] }}" name="month[]"
                                                            checked><label>{{ $dat[4][0] }}</label></td>
                                                    {{--5 Column 2 --}}
                                                    <td>
                                                        <select  name="select1[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <option value="1" selected>1</option>
                                                            <?php for($i=2;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--5 Column 3 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id5[]"
                                                            value="{{ $para0[2] }}" checked>
                                                        <label for="vehicle1"> {{ $para[2] }}</label>
                                                    </td>
                                                    {{--5 Column 4 --}}
                                                    <td>
                                                        <select  name="select2[]"  onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <option value="1" selected>1</option>
                                                            
                                                            <?php for($i=2;$i<=30;$i++){ 
                                                            echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                            
                                                        </select>
                                                        
                                                    </td>
                                                    {{--5 Column 5 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id17[]"
                                                            value="{{ $para0[11] }}" checked>
                                                        <label for="vehicle1"> {{ $para[11] }}</label>
                                                    </td>
                                                    <td>
                                                        <select name="select3[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <option value="1" selected>1</option>
                                                            <?php
                                                             for($i=2;$i<=30;$i++){
                                                                   echo "<option value=".$i.">$i</option>";
                                                                     ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    
                                                {{--5 Column 6 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id29[]"
                                                            value="{{ $para0[20] }}" checked>
                                                        <label for="vehicle1"> {{ $para[20] }}</label>
                                                    </td>
                                                    {{--5 Column 7 --}}
                                                    <td>
                                                        <select name="select4[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah">Parah</option>
                                                            <option value="M-Dor"  selected>M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" >1/2</option>
                                                            <option value="1" selected>1</option>
                                                            <?php for($i=2;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                        
                                                    </td>
                                                    {{--5 Column 8 --}}
                                                    <td>
                                                    
                                                    <input type="text" value="2" name="para_id41[]" style="width:60px;">
                                                    </td>
                                                </tr>


                                                {{-- Row 6 --}}
                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $dat[5][1] }}" name="month[]"
                                                            checked><label>{{ $dat[5][0] }}</label></td>
                                                    {{--6 Column 2 --}}
                                                    <td>
                                                        <select name="select1[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <option value="1" selected>1</option>
                                                            <?php for($i=2;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--6 Column 3 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id6[]"
                                                            value="{{ $para0[3] }}" checked>
                                                        <label for="vehicle1"> {{ $para[3] }}</label>
                                                    </td>
                                                    {{--6 Column 4 --}}
                                                    <td>
                                                        <select name="select2[]"  onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <option value="1" selected>1</option>
                                                            <?php for($i=2;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--6 Column 5 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id18[]"
                                                            value="{{ $para0[12] }}" checked>
                                                        <label for="vehicle1"> {{ $para[12] }}</label>
                                                    </td>
                                                    <td>
                                                        <select name="select3[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <option value="1" selected>1</option>
                                                            <?php
                                                             for($i=2;$i<=30;$i++){
                                                                   echo "<option value=".$i.">$i</option>";
                                                                     ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    
                                                    {{--6 Column 6 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id30[]"
                                                            value="{{ $para0[21] }}" checked>
                                                        <label for="vehicle1"> {{ $para[21] }}</label>
                                                    </td>
                                                    {{--6 Column 7 --}}

                                                    <td>
                                                        <select name="select4[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah">Parah</option>
                                                            <option value="M-Dor"  selected>M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" >1/2</option>
                                                            <option value="1" >1</option>
                                                            <option value="2" selected>1</option>
                                                            <?php for($i=3;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--6 Column 8 --}}
                                                    <td>
                                                
                                                    <input type="text" value="2" name="para_id42[]" style="width:60px;">
                                                    </td>
                                                </tr>


                                                {{-- Row 7 --}}
                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $dat[6][1] }}" name="month[]"
                                                            checked><label>{{ $dat[6][0] }}</label></td>
                                                                    {{--7 Column 2 --}}
                                                                    <td>
                                                                        <select name="select1[]" onchange="showDiv1(this)" id="select1">
                                                                            <option value="">select category</option>
                                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                                            <option value="Parah" selected>Parah</option>
                                                                            <option value="M-Dor" >M-Dor</option>
                                                                        </select>
                                                                        <select name="para_number[]" id="para1">
                                                                            <option value="">Select Target</option>
                                                                            <option value="1/2">1/2</option>
                                                                            <option value="1" selected>1</option>
                                                                            <?php for($i=2;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </td>
                                                                    {{--7 Column 3 --}}
                                                                    <td>
                                                                        <input type="checkbox" id="vehicle1" name="para_id7[]"
                                                                            value="{{ $para0[4] }}" checked>
                                                                        <label for="vehicle1"> {{ $para[4] }}</label>
                                                                    </td>
                                                                    {{--7 Column 4 --}}
                                                                    <td>
                                                                        <select  name="select2[]"  onchange="showDiv1(this)" id="select1">
                                                                            <option value="">select category</option>
                                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                                            <option value="Parah" selected>Parah</option>
                                                                            <option value="M-Dor">M-Dor</option>
                                                                        </select>
                                                                        <select name="para_number[]" id="para1">
                                                                            <option value="">Select Target</option>
                                                                            <option value="1/2" selected>1/2</option>
                                                                            <option value="1" selected>1</option>
                                                                            <?php for($i=2;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </td>
                                                                    {{--7 Column 5 --}}
                                                                    <td>
                                                                        <input type="checkbox" id="vehicle1" name="para_id19[]"
                                                                            value="{{ $para0[13] }}" checked>
                                                                        <label for="vehicle1"> {{ $para[13] }}</label>
                                                                    </td>
                                                                    <td>
                                                                        <select name="select3[]" onchange="showDiv1(this)" id="select1">
                                                                            <option value="">select category</option>
                                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                                            <option value="Parah" selected>Parah</option>
                                                                            <option value="M-Dor">M-Dor</option>
                                                                        </select>
                                                                        <select name="para_number[]" id="para1">
                                                                            <option value="">Select Target</option>
                                                                            <option value="1/2" selected>1/2</option>
                                                                            <option value="1" selected>1</option>
                                                                            <?php
                                                                             for($i=2;$i<=30;$i++){
                                                                                   echo "<option value=".$i.">$i</option>";
                                                                                     ?>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </td>
                                                                    
                                                                {{--7 Column 6 --}}

                                                                    <td>
                                                                        <input type="checkbox" id="vehicle1" name="para_id31[]"
                                                                            value="{{ $para0[22] }}" checked>
                                                                        <label for="vehicle1"> {{ $para[22] }}</label>
                                                                    </td>
                                                                    {{--7 Column 7 --}}
                                                                    <td>
                                                                        <select name="select4[]" onchange="showDiv1(this)" id="select1">
                                                                            <option value="">select category</option>
                                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                                            <option value="Parah">Parah</option>
                                                                            <option value="M-Dor"  selected>M-Dor</option>
                                                                        </select>
                                                                        <select name="para_number[]" id="para1">
                                                                            <option value="">Select Target</option>
                                                                            <option value="1/2" >1/2</option>
                                                                            <option value="1" >1</option>
                                                                            <option value="2" selected>1</option>
                                                                            <?php for($i=3;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                                            <?php } ?>
                                                                        </select>

                                                                    </td>
                                                                    {{--7 Column 8 --}}
                                                                    <td>
                                                                     <input type="text" value="1" name="para_id43[]" style="width:60px;">
                                                                    </td>
                                                                </tr>

                                                {{-- Row 8 --}}

                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $dat[7][1] }}" name="month[]"
                                                            checked><label>{{ $dat[7][0] }}</label></td>
                                               {{--8 Column 2 --}}
                                                    <td>
                                                        <select name="select1[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <option value="1" selected>1</option>
                                                            <?php for($i=2;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--8 Column 3 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id8[]"
                                                            value="{{ $para0[5] }}" checked>
                                                        <label for="vehicle1"> {{ $para[5] }}</label>
                                                    </td>
                                                    {{--8 Column 4 --}}
                                                    <td>
                                                        <select  name="select2[]"  onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <option value="1" selected>1</option>
                                                            <?php for($i=2;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--8 Column 5 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id20[]"
                                                            value="{{ $para0[14] }}" checked>
                                                        <label for="vehicle1"> {{ $para[14] }}</label>
                                                    </td>
                                                    <td>
                                                        <select name="select3[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <option value="1" selected>1</option>
                                                            <?php
                                                             for($i=2;$i<=30;$i++){
                                                                   echo "<option value=".$i.">$i</option>";
                                                                     ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    
                                                {{--8 Column 6 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id32[]"
                                                            value="{{ $para0[23] }}" checked>
                                                        <label for="vehicle1"> {{ $para[23] }}</label>
                                                    </td>
                                                    {{--8 Column 7 --}}
                                                    <td>
                                                        <select name="select4[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah">Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" >1/2</option>
                                                            <option value="1">1</option>
                                                            <?php for($i=2;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--8 Column 8 --}}
                                                    <td>
                                                    <input type="text" name="para_id44[]" style="width:60px;">
                                                    </td>
                                                </tr>



                                                {{-- Row 9 --}}
                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $dat[8][1] }}" name="month[]"
                                                            checked><label>{{ $dat[8][0] }}</label></td>
                                                    {{--9 Column 2 --}}
                                                    <td>
                                                        <select name="select1[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <option value="1" selected>1</option>
                                                            <?php for($i=2;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--9 Column 3 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id9[]"
                                                            value="{{ $para0[6] }}" checked>
                                                        <label for="vehicle1"> {{ $para[6] }}</label>
                                                    </td>

                                                    {{--9 Column 4 --}}
                                                    <td>
                                                        <select  name="select2[]"  onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--9 Column 5 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1"  name="para_id21[]"
                                                            value="{{ $para0[15] }}" checked>
                                                        <label for="vehicle1"> {{ $para[15] }}</label>
                                                    </td>
                                                    <td>
                                                        <select name="select3[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--9 Column 6 --}}
                                            
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id33[]"
                                                            value="{{ $para0[24]}}" checked>
                                                        <label for="vehicle1"> {{ $para[24] }}</label>
                                                    </td>
                                                        {{--9 Column 7 --}}
                                                    <td>
                                                        <select name="select4[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" >Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--9 Column 8 --}}
                                                    <td>
                                                        
                                                    <input type="text" name="para_id45[]" style="width:60px;">
                                                 </td>
                                                </tr>

                                                {{-- Row 10 --}}
                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $dat[9][1] }}" name="month[]"
                                                            checked><label>{{ $dat[9][0] }}</label></td>
                                                    {{--10 Column 2 --}}
                                                    <td>
                                                        <select name="select1[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <option value="1" selected>1</option>
                                                            <?php for($i=2;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--10 Column 3 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id10[]"
                                                            value="{{ $para0[7] }}" checked>
                                                        <label for="vehicle1"> {{ $para[7] }}</label>
                                                    </td>

                                                    {{--10 Column 4 --}}
                                                    <td>
                                                        <select  name="select2[]"  onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--10 Column 5 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1"  name="para_id22[]"
                                                            value="{{ $para0[16] }}" checked>
                                                        <label for="vehicle1"> {{ $para[16] }}</label>
                                                    </td>
                                                    <td>
                                                        <select name="select3[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--10  Column 6 --}}
                                              
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id34[]"
                                                            value="{{ $para0[25] }}" checked>
                                                        <label for="vehicle1"> {{ $para[25] }}</label>
                                                    </td>
                                                    {{--10 Column 7 --}}
                                                    <td>
                                                        <select name="select4[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah">Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" >1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--10 Column 8 --}}
                                                    <td>
                                                     
                                                    <input type="text" name="para_id56[]" style="width:60px;">
                                                    </td>

                                                </tr>
                                                {{-- Row 11 --}}

                                                <tr>
                                                    <td class="cell"><input type="checkbox" id="scales"
                                                            value="{{ $dat[10][1] }}" name="month[]"
                                                            checked><label>{{ $dat[10][0] }}</label></td>
                                                    {{--11 Column 2 --}}
                                                    <td>
                                                        <select name="select1[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <option value="1" selected>1</option>
                                                            <?php for($i=2;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--11 Column 3 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id11[]"
                                                            value="{{ $para0[8] }}" checked>
                                                        <label for="vehicle1"> {{ $para[8] }}</label>
                                                    </td>

                                                    {{--11 Column 4 --}}
                                                    <td>
                                                        <select name="select2[]"  onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--11 Column 5 --}}
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id23[]"
                                                            value="{{ $para0[17] }}" checked>
                                                        <label for="vehicle1"> {{ $para[17] }}</label>
                                                    </td>
                                                    <td>
                                                        <select name="select3[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" selected>1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--11 Column 6 --}}
                                              
                                                    <td>
                                                        <input type="checkbox" id="vehicle1" name="para_id35[]"
                                                            value="{{ $para0[26] }}" checked>
                                                        <label for="vehicle1"> {{ $para[26] }}</label>
                                                    </td>
                                                    {{--11 Column 7 --}}
                                                    <td>
                                                        <select name="select4[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah">Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" >1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    {{--11 Column 8 --}}
                                                    <td>
                                                      
                                                    <input type="text" name="para_id47[]" style="width:60px;">
                                                    </td>

                                                </tr>
                                                {{-- Row 12 --}}
                                              <tr>
                                                    <td class="cell">
                                                        <input type="checkbox" id="scales"
                                                            value="{{ $dat[11][1] }}" name="month[]"
                                                            checked><label>{{ $dat[11][0] }}</label></td> 
                                                            {{--12 Column 2  --}}
                                                    <td>
                                                        <div >

                                                        <select name="select1[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah" selected>Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <option value="1" selected>1/2</option>
                                                            <?php for($i=2;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    </td>

                                                    {{-- 12 Column 3 --}}
                                    
                                                    <td>
                                                     <input type="text"  name="para_id12[]" style="width:60px;">
                                                    </td>

                                                    {{--12 Column 4 --}}

                                                    <td>
                                                        <div >

                                                        <select name="select2[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah">Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    </td>

                                                    {{--12 Column 5 --}}
                                                    
                                                    <td>

                                                        <input type="text" name="para_id24" style="width:60px;">
                                                        
                                                    </div>
                                                    </td>
                                                    <td>
                                                     
                                                        <select name="select3[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah">Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2">1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    </td>
                                                    {{--12 Column 6 --}}
                                            
                                                    <td>
                                                     
                                                        <input type="text" name="para_id36[]" style="width:60px;"> 
                                                    </div>
                                                    </td>
                                                    {{--12 Column 7 --}}
                                                    <td>
                                                
                                                        <select name="select4[]" onchange="showDiv1(this)" id="select1">
                                                            <option value="">select category</option>
                                                            <option value="Taq-Thi">Taq-Thi</option>
                                                            <option value="Parah">Parah</option>
                                                            <option value="M-Dor">M-Dor</option>
                                                        </select>
                                                        <select name="para_number[]" id="para1">
                                                            <option value="">Select Target</option>
                                                            <option value="1/2" >1/2</option>
                                                            <?php for($i=1;$i<=30;$i++){  echo "<option value=".$i.">$i</option>";  ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    </td>
                                                    {{--12 Column 8 --}}
                                                    <td>
                                                     
                                                    <input type="text" name="para_id48[]" style="width:60px;">
                                                    </td>

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
