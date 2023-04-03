@extends('layouts.master')
@section('content')
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Sick Students Detail</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <style>
                                        input {
                                            text-transform: capitalize;
                                        }

                                        tr {
                                            border-collapse: collapse;
                                        }

                                        .cell {
                                            text-align: center;
                                            border: 1px solid gray;
                                        }

                                        ::-webkit-scrollbar {
                                            display: none;
                                        }
                                    </style>
                                </div>
                                {{-- <button type="button" onMouseOver="this.style.color='#15A362'" onMouseOut="this.style.color='#676778'" style="border-radius:5px;padding:4px;background-color:white;border:1px solid #676778;;color:#676778; " class="col-auto" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap"><i class="fa fa-plus" aria-hidden="true"></i> Add </button> --}}

                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Sick Student Detail</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <strong>Whoops!</strong> There were some problems with your
                                                        input.<br><br>
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
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
                                    <table class="table app-table-hover mb-0 text-left" style="font-size: .700rem;">
                                        <thead>

                                            <tr>

                                                <th class="cell" style="font-size: 10px;" colspan="1">Session</th>
                                                <th class="cell" style="font-size: 10px;" colspan="1">چھٹی</th>
                                                <th class="cell" style="font-size: 10px;" colspan="4">بعد مغرب</th>
                                                <th class="cell" style="font-size: 10px;" colspan="4">بعد ظہر</th>
                                                <th class="cell" style="font-size: 10px;" colspan="4">بعد اشراق</th>
                                                <th class="cell" style="font-size: 10px;" colspan="4">بعد فجر </th>
                                                <th class="cell" style="font-size: 10px;" colspan="1">استاد</th>
                                                <th class="cell" style="font-size: 10px;" colspan="1">داخلہ نمبر</th>
                                                <th class="cell" style="font-size: 10px;" colspan="1">طالب علم</th>
                                                <th class="cell" style="font-size: 10px;" colspan="1">تاریخ</th>
                                                <th class="cell" style="font-size: 10px;" colspan="1">آئی ڈی</th>
                                            </tr>
                                            <tr>

                                                <th class="cell" style="font-size: 10px;"><span class="truncate"></th>
                                                <th class="cell" style="font-size: 10px;"><span class="truncate"></th>


                                                <th class="cell" style="font-size: 10px;"><span class="truncate">دوائی
                                                        دینے والے</th>
                                                <th class="cell" style="font-size: 10px;"><span class="truncate"> تفصیل
                                                </th>
                                                <th class="cell" style="font-size: 10px;"><span class="truncate">دوائی
                                                </th>
                                                <th class="cell" style="font-size: 10px;"><span class="truncate">غزا</th>
                                                <th class="cell" style="font-size: 10px;"><span class="truncate">دوائی
                                                        دینے والے</th>
                                                <th class="cell" style="font-size: 10px;"><span class="truncate"> تفصیل
                                                </th>
                                                <th class="cell" style="font-size: 10px;"><span class="truncate">دوائی
                                                </th>
                                                <th class="cell" style="font-size: 10px;"><span class="truncate">غزا</th>
                                                <th class="cell" style="font-size: 10px;"><span class="truncate">دوائی
                                                        دینے والے</th>
                                                <th class="cell" style="font-size: 10px;"><span class="truncate"> تفصیل
                                                </th>
                                                <th class="cell" style="font-size: 10px;"><span class="truncate">دوائی
                                                </th>
                                                <th class="cell" style="font-size: 10px;"><span class="truncate">غزا</th>
                                                <th class="cell" style="font-size: 10px;"><span class="truncate">دوائی
                                                        دینے والے</th>
                                                <th class="cell" style="font-size: 10px;"><span class="truncate"> تفصیل
                                                </th>
                                                <th class="cell" style="font-size: 10px;"><span class="truncate">دوائی
                                                </th>
                                                <th class="cell" style="font-size: 10px;"><span class="truncate">غزا</th>

                                                <th class="cell" style="font-size: 10px;"><span class="truncate"></th>
                                                <th class="cell" style="font-size: 10px;"><span class="truncate"></th>
                                                <th class="cell" style="font-size: 10px;"><span class="truncate"></th>
                                                <th class="cell" style="font-size: 10px;"><span class="truncate"></th>
                                                <th class="cell" style="font-size: 10px;"><span class="truncate"></th>
                                            </tr>

                                        </thead>

                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($sick_view as $data)
                                                <tr>

                                                    <?php $city = explode(',', $data->address)[0]; ?>

                                                    <td class="cell"><span class="truncate">{{ $data->session }}</span>
                                                    </td>
                                                    <td class="cell"><span class="truncate">{{ $data->leave }}</span>
                                                    </td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->medician_given_by4 }}</span></td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->description_4 }}</span></td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->medicine_4 }}</span></td>
                                                    <td class="cell"><span class="truncate">{{ $data->food_4 }}</span>
                                                    </td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->medician_given_by3 }}</span></td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->description_3 }}</span></td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->medicine_3 }}</span></td>
                                                    <td class="cell"><span class="truncate">{{ $data->food_3 }}</span>
                                                    </td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->medician_given_by2 }}</span></td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->description_2 }}</span></td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->medicine_2 }}</span></td>
                                                    <td class="cell"><span class="truncate">{{ $data->food_2 }}</span>
                                                    </td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->medician_given_by1 }}</span></td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->description_1 }}</span></td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->medicine_1 }}</span></td>
                                                    <td class="cell"><span class="truncate">{{ $data->food_1 }}</span>
                                                    </td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->teacher_name }}</span></td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->admission_no }}</span></td>
                                                    <td class="cell"><span
                                                            class="truncate">{{ $data->student_name }}-{{ $city }}</span>
                                                    </td>
                                                    <td class="cell"><span class="truncate">{{ $data->date }}</span>
                                                    </td>
                                                    <td class="cell">{{ $i++ }}</td>


                                                    {{--
											<td class="cell">
												<a href="{{ route('sick_detail_view',$data->id)  }}" class="btn btn-primary"><i class="fas fa-eye fa-1x"></i></a></td>


											</td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>







                                    </table>
                                </div>
                                <!--//table-responsive-->

                            </div>
                            <!--//app-card-body-->
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


                    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"
                        id="bootstrap-css">
                    <!-- Script -->
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>

                    <!-- Font Awesome JS -->
                    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
                        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
                    </script>
                    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
                        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
                    </script>
                    <script>
                        // display a modal (medium modal)
                        $(document).on('click', '#mediumButton', function(event) {
                            event.preventDefault();
                            let href = $(this).attr('data-attr');
                            $.ajax({
                                url: href,
                                beforeSend: function() {
                                    $('#loader').show();
                                },
                                // return the result
                                success: function(result) {
                                    $('#mediumModal').modal("show");
                                    $('#mediumBody').html(result).show();
                                },
                                complete: function() {
                                    $('#loader').hide();
                                },
                                error: function(jqXHR, testStatus, error) {
                                    console.log(error);
                                    alert("Page " + href + " cannot open. Error:" + error);
                                    $('#loader').hide();
                                },
                                timeout: 8000
                            })
                        });
                    </script>
                @endsection
