@extends('layouts.master')
@section('content')
    <script language="Javascript" src="admin/jquery.js"></script>
    <script type="text/JavaScript" src='admin/state.js'></script>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Teacher</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                {{-- <div class="col-auto">
                                <form class="table-search-form row gx-1 align-items-center">
                                    <div class="col-auto">
                                        <input type="text" id="search-orders" name="searchorders"
                                            class="form-control search-orders" placeholder="Search">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn app-btn-secondary">Search</button>
                                    </div>
                                </form>
                            </div> --}}
                                <button type="button" onMouseOver="this.style.color='#15A362'"
                                    onMouseOut="this.style.color='#676778'"
                                    style="border-radius:5px;padding:4px;background-color:white;border:1px solid #676778;;color:#676778; "
                                    class="col-auto" data-bs-toggle="modal" data-bs-target="#laravel"><i class="fa fa-plus"
                                        aria-hidden="true"></i>Add
                                    Teacher</button>
                                <div class="modal fade" id="laravel" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Enter Teacher</h5>
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
                                                <form action="{{ route('checkstudent') }}" method="get"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('get')
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Role</label>
                                                        <select name="teacher_id" id="" class="form-select">
                                                            <option value="">Select Teacher</option>
                                                            <?php foreach($teacher as $data){ ?>
                                                            <option value="{{ $data->id }}">{{ $data->full_name }}
                                                            </option>
                                                            <?php } ?>
                                                        </select>

                                                    </div>
                                                    {{-- <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">user Name</label>
                                                    <input type="text" name="full_name" class="form-control"
                                                        id="recipient-name">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">phone</label>
                                                    <input type="text" name="phone" class="form-control"
                                                        id="recipient-name">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">phone2
                                                    </label>
                                                    <input type="text" name="phone2" class="form-control"
                                                        id="recipient-name">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Father</label>
                                                    <input type="text" name="father" class="form-control"
                                                        id="recipient-name">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Degree</label>
                                                    <input type="text" name="degree" class="form-control"
                                                        id="recipient-name">
                                                </div>
                                                <div class="mb-3">
                                                    <div id="selection">
                                                        <label for="recipient-name"
                                                            class="col-form-label">Address</label><br>
                                                        <select name="state" class="iput" id="listBox"
                                                            onchange='selct_district(this.value)'>></select>
                                                        <select name="district" class="output" id='secondlist'>
                                                            <option value="">Select Dist</option>
                                                        </select>
                                                        <br>
                                                        <input type="text" name="city" class="output"
                                                            placeholder="city">
                                                        <input type="text" name="pincode" class="input"
                                                            placeholder="Pincode">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Upload
                                                            Docs</label>
                                                        <select name="file_type" class="form-select"
                                                            onchange="showDiv(this)">
                                                            <option value="">Dropdown for Upload</option>
                                                            <option value="0">Upload Doc Image </option>
                                                        </select>
                                                    </div>
                                                    <div id="image" style="display:none;">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="customFile">Proof
                                                                1</label>
                                                            <input type="file" name="proof1" class="form-control"
                                                                id="customFile" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="customFile">Proof
                                                                2</label>
                                                            <input type="file" name="proof2" class="form-control"
                                                                id="customFile" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="customFile">Proof
                                                                3</label>
                                                            <input type="file" name="proof3" class="form-control"
                                                                id="customFile" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="customFile">Proof
                                                                4</label>
                                                            <input type="file" name="proof4" class="form-control"
                                                                id="customFile" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="customFile">Proof
                                                                5</label>
                                                            <input type="file" name="proof5" class="form-control"
                                                                id="customFile" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="customFile">Proof
                                                                6</label>
                                                            <input type="file" name="proof6" class="form-control"
                                                                id="customFile" />
                                                        </div> --}}
                                                    {{-- </div> --}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                </form>
                                            </div>
                                            <div id="dumdiv" align="center" style=" font-size: 10px;color: #dadada;">
                                            </div>
                                            <a id="dum"
                                                style="padding-right:0px; text-decoration:none;color: green;text-align:center;"
                                                href="http://www.hscripts.com"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--//row-->
                        </div>
                        <!--//table-utilities-->
                    </div>
                    <!--//col-auto-->
                </div>
                <style>
                    input {
                        text-transform: capitalize;
                    }

                    .cell {
                        text-align: center;
                    }
                </style>
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
                                            <th class="cell">SNo</th>
                                            <th class="cell">teacher</th>
                                            <th class="cell">student</th>
                                            <th class="cell">view</th>
                                            <th class="cell">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>

                                        @foreach ($groupteacher as $data => $index)
                                            <tr>
                                                <td class="cell">{{ $i++ }}</td>
                                                <td class="cell"><span class="truncate">{{ $data }}</span></td>
                                                <td class="cell"><span class="truncate">{{ sizeof($index) }}</span></td>

                                                {{-- <input type="text" id="teacher_id" name="teacher_id" value="{{ $data }}"> --}}
                                                <td class="cell"><a href="viewstudent/{{ $data }}"><i
                                                            class="fas fa-eye fa-1x"></i></a></td>


                                                <td class="cell">
                                                    <form action="deleteteacher/{{ $data }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                            onclick="return confirm('you want to delete?');"
                                                            class="btn btn-danger">
                                                            <i class="fas fa-trash fa-1x"></i>
                                                        </button>

                                                </td>
                                                </form>
                                                </td>
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

                <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
                    aria-hidden="true">
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
