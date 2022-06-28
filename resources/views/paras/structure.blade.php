@extends('layouts.master')
@section('content')
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
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                    <?php if(isset($parahead)){?>
                                        
<footer  id="print">
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
</style>
                                    <table class="table app-table-hover mb-0 text-left">
                                        <thead>
                                            <tr>
                                                @foreach ($parahead as $data)
                                                    <?php $student_id = $data->student_id; ?>
                                                    <th class="cell">{{ $data->para_id}}</th>
                                                @endforeach
                                            <th class="cell">Id</th>
                                          
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($daily_naz as $data)
                                                <tr>
                                                    <?php if($student_id==$data->student_id) {?>
                                                    <?php
                                                    for ($index = 0; $index < count($parahead); $index++) {
                                                        $day = [];
                                                        echo "<td class='cell'>";
                                                            // echo $parahead[$index]->para_order."--</br>".$data->para_id;
                                                    
                                                            $val = explode("-",$data->para_id)[0];
                                                    if ($parahead[$index]->para_order == $val) {
                                                     $arr = explode("/",$data->arabic_date);
                                                     echo $arr[0]."</br>";
                                                    ?>
                                                    <div style="text-decoration-line: overline">
                                                    <?php

                                                     echo $arr[1];

                                                        }
                                                        echo '</div></span></td>';
                                                    }
                                                    ?>

                                                    <td class="cell">{{ $i++}}</span></td>
                                             
                                                    </form>
                                                </tr>
                                                <?php }?>
                                            @endforeach
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
