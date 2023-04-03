@extends('layouts.master')
@section('content')
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">

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
                </div>



                <div>
                    <form action="" method="GET">
                        @csrf
                        <label>Month</label>


                        <?php
                if(isset($_GET['month_id'])){
                
                    $month = $_GET['month_id'];
                    $year = $_GET['year_id']; ?>

                        <select id="month" name="month_id" value={{ $month }}>
                            <?php
                
                
                }else{
                    $month = date('m');
                $year = date('Y');
                
                
                ?>
                            <select id="month" name="month_id" value={{ $month }}>
                                <?php
                
                }
                ?>

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
                            <label>Year</label>

                            <?php
                        if(isset($_GET['month_id'])){
                        
                            $month = $_GET['month_id'];
                            $year = $_GET['year_id']; ?>

                            <select id="year_id" name="year_id" value={{ $year }}>
                                <?php
                        
                        
                        }else{
                            $month = date('m');
                        $year = date('Y');
                        
                        
                        ?>

                                <select id="year_id" name="year_id" value={{ $year }}>
                                    <?php
                        
                        }
                        ?>



                                    <?php for($i=2020;$i<2100;$i++){ ?>
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    <?php } ?>
                                </select>
                                <button class="btn btn-danger" ><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>


                <div>
                    <div>
                        <?php $city = explode(",",$student->address)[0];?>
                        <h4>Student:{{ $student->name }}-{{$city}}</h4>
                        <h4>Admission No:{{ $student->admission_no }}</h4>

                    </div>

                    <style>
                        input {
                            text-transform: capitalize;
                        }

                        h2 {

                            text-align: center;
                            text-transform: uppercase;
                            border-top: 2px solid red;
                            border-bottom: 2px solid #009933;
                        }

                        .cell,
                        td,
                        th {
                            text-align: center;
                            text-transform: capitalize;
                            font-weight: 500 !important;
                            color: black !important;
                            font-weight: bolder;
                            font-size: 1vw;
                            border: 2px solid black !important;
                        }

                        table thead tr {
                            background-color: rgba(252, 252, 252, 0.26) !important;
                        }
                    </style>
                    <?php
                    
                    if (isset($_GET['month_id'])) {
                        $month = $_GET['month_id'];
                        $year = $_GET['year_id'];
                    
                        $monthNum = sprintf('%02s', $_GET['month_id']);
                        $monthName = date('F', mktime(null, null, null, $monthNum));
                        $i = $monthName;
                    } else {
                        $i = date('  F  ');
                        $month = date('m');
                        $year = date('Y');
                    }
                    
                    ?>
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

                                        <h2> {{ $i }}</h2>
                                        <table class="table app-table-hover mb-0 text-left">
                                            <thead style="background: rgb(190, 219, 226);">
                                                <tr>
                                                    <th class="cell">Date</th>
                                                    <th class="cell">session 1</th>
                                                    <th class="cell">session 2</th>
                                                    <th class="cell">session 3</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // if(!empty($list)){
                                                $i = 1;
                                                $imagetick = 'https://support.content.office.net/en-us/media/5e6bcf49-2b5f-42c6-9c53-91badba25aaf.png';
                                                $imagewrong =
                                                    'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAS1BMVEX///8AAAD7+/umpqajo6MICAj5+fkEBASgoKCpqamdnZ2srKzCwsK7u7uZmZnNzc0mJiYfHx/S0tLJyckODg5tbW0jIyMuLi7Dw8PK7dIsAAAE70lEQVR4nO2c4ZqaMBBFSRTQLVbX1W3f/0kbEAxKnAQySzL2nv3ZfpELySHAJEUBAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACwLrr7K7TWjI1WVTW0np4u2WFXVKyNVsXuwNlgDJWJeFSKN2JVfCh1zuIKdhw+VRuREb0zLX5mchXNFfxUl1KpDWOjm1KVtTodGZtcRGcXfVCqVi08EbXpotuuPdNqw+qvJQdjfv9w6gMyRdRDwDbiqeFocjmVCfillOlR/SFtGXTTSaYPaE5d4o6qW8mYA7ldxLKNGM/H0OtNg+YqHtLeFL+6gP0RGTeofXST23vA+tZRj2kS3uYxd8lY4saiudE/tdfphumgZ3GbyZwmAaMimkafA6bTTT+TsZKxLNeNlcw4YDrdjCVjidLNbzU9Y6l0081krGRGBxShG9NFJ2fsrpu1aSVzmXSp5WPRzmRclCl0s3V0qIiImgrYXkiOO+0splp/ZK5uXJIZw/z8GQB9zhfo5mN6a308YWv30sr8bV4nnK2bLRlwb34tyW1/bw7r9WAMH4tklzc/8OsHM3hg0Y1zJjMOuLpkLORYVKG68UmG45EsgtdjMfzsu2Yyln2R+Dk/XjeumUxGAWN1k7FkLBG6yVkylhjdZC4Zy3LdZC4Zy1LdZC8Zy3zd0I9L2UjGMls37FP3H2a+bsRIxjJXN/TjUlZjcGCebnyPSxkGnKMbETMZF4G6kTGTcRGqG4GSsYTpRsxMxkWIbgTNZFzQutnf/gdxnbOVjMWnG463Aknx6eZK/mvWkrHQV0mwZCxERCqfnIA+3bxKLkAyFlo37oACJGPx6caFEMlYqLHoQtAYHJgXUWDAGbqRJhlLoG6kScYSrhtxkrGEjUWRY3AgJKIJuPpHekb2ZU08C6paXeKrGROzo16p1bzV4Umoiish1FJdUx9gPG9/Dd98HPpKw27IvYr0i993iOh78WsRO6ehX/zekTsvpV/8jhKyLGJYGc8nbAfSxiL9CfsdIoZLxiJMN/QnbAfSdEN/wnYmlKQbeiZD3T9kjEXvJ2zWRQwp8EimvJKTABG68X3Cpj+QCtCN7xM29Q1YgG7C6mS4FjGsT3CdDPOaqfUIrZPhWcSQhPA6GaHlCt46mdGLX841U6ug9dxiPGm6WVCMJ0w384vxxOnm94KCWFG62S4qxhOjm+UVvzJ0E1XxK0I3MRW/QnQTV/ErQDexFb9Z64Zn7VLOumFau5SxbniWFWStG661S9nqhm/tUoa6aR+X6DM/rxjPt4ghwb4Yvqna3K5F6ybJ3ia8a5d8ull/f5ofWD9Id/r1bxoN1auWVRu+jnhJsi3d8dTvwzU930srfl26Ket2P7Hv9fejHbb1dGyvFnH/cuimbje9OzVpSlCPyrFfW9yee1PddLv6nbtdmxLQuPZNjKv4nY7FWv1pum0o+Y47HN1Mx2FsSfNzxGHvyzSF0vpJNyzLCqxukknGYs7rWDdMk+S7bjrJfDepd/V+0A3PPsKDbnrJ6NQR/1rdcC0rGMZiUsnc0VY3fOsmNo+SSf7CrdWNGYycT3Gbsm3SSCYTbvvqc/Yl3T65fCeayUzRxZn78Ua3ujl3L/My4cD9iGoiHtp4OVzD/hgq3rPdt5pJLwUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAwP/EP2d3K65r8T+LAAAAAElFTkSuQmCC';
                                                
                                                ?>

                                                @foreach ($list as $data => $filter)
                                                    <tr>
                                                        <td class="cell">{{ $filter['date'] }}</td>
                                                        <?php 
                                                         if($filter["status_1"] == 1){?>
                                                        <td class="cell"><img src="{{ $imagetick }}" /></td>

                                                        <?php }elseif($filter["status_1"] == 2){ ?>

                                                        <td class="cell"><img src="{{ $imagewrong }}" width="20px" />
                                                        </td>
                                                        <?php }else{?>

                                                        <td class="cell"></td>
                                                        <?php } ?>
                                                        <?php 
                                                         if($filter["status_2"] == 1){?>
                                                        <td class="cell"><img src="{{ $imagetick }}" /></td>

                                                        <?php }elseif($filter["status_2"] == 2){ ?>

                                                        <td class="cell"><img src="{{ $imagewrong }}" width="20px" />
                                                        </td>
                                                        <?php }else{?>

                                                        <td class="cell"></td>
                                                        <?php } ?>
                                                        <?php 
                                                         if($filter["status_3"] == 1){?>
                                                        <td class="cell"><img src="{{ $imagetick }}" /></td>

                                                        <?php }elseif($filter["status_2"] == 2){ ?>

                                                        <td class="cell"><img src="{{ $imagewrong }}" width="20px" />
                                                        </td>
                                                        <?php }else{?>

                                                        <td class="cell"></td>
                                                        <?php } ?>
                                                        
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            {{-- <?php }?> --}}
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
                    @endsection
