@extends('layouts.master')
@section('content')
    <?php
    use Illuminate\Support\Facades\DB;
    ?>
    <script language="Javascript" src="admin/jquery.js"></script>
    <script type="text/JavaScript" src='admin/state.js'></script>
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
            border: 1px solid gray;
            border-radius: 2px;
            height: 39px;
            width: 300px;
        }
        th.cell {
            text-align: center;
        }
    </style>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">users</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <form class="table-search-form row gx-1 align-items-center">
                                        <div class="col-auto">
                                            <input type="text" id="search-orders" name="searchorders"
                                                class="form-control search-orders" placeholder="Search">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn app-btn-secondary">Search</button>
                                        </div>
                                    </form>
                                </div>
                                <button type="button" onMouseOver="this.style.color='#15A362'"
                                    onMouseOut="this.style.color='#676778'"
                                    style="border-radius:5px;padding:4px;background-color:white;border:1px solid #676778;;color:#676778; "
                                    class="col-auto" data-bs-toggle="modal" data-bs-target="#laravel">Add
                                    user</button>
                                <div class="modal fade" id="laravel" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Enter Question</h5>
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
                                                <form action="{{ route('user.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Role</label>
                                                        <select name="role_id" class="form-select" id="">
                                                            <option value="">select Role</option>
                                                            <option value="0">Teacher</option>
                                                            <option value="1">Admin</option>
                                                            <option value=" ">Super Admin</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
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
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" name="submit"
                                                            class="btn btn-primary">Save</button>
                                                </form>
                                            </div>
                                            <div id="dumdiv" align="center" style=" font-size: 10px;color: #dadada;"> </div>
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
                                                <th class="cell">Id</th>
                                                <th class="cell">Role</th>
                                                <th class="cell">full_name</th>
                                                <th class="cell">phone</th>
                                                <th class="cell">Address</th>
                                                <th class="cell">Father</th>
                                                <th class="cell">Degree</th>
                                                <th class="cell">Device Updates</th>
                                                <th class="cell">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody> <?php $i = 1; ?>
                                            @foreach ($user as $data)
                                                <tr>
                                                    <td class="cell">{{ $i++ }}</td>
                                                    <td class="cell">
                                                        <?php if ($data->role_id == 1) {
                                                            echo 'Admin';
                                                        } elseif ($data->role_id == 2) {
                                                            echo 'super Admin';
                                                        } else {
                                                            echo 'Teacher';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="cell">{{ $data->full_name }}</td>
                                                    <td class="cell">{{ $data->phone }}<br>{{ $data->phone2 }}
                                                    </td>
                                                    <td class="cell">{{ $data->address }}</td>
                                                    <td class="cell">{{ $data->father }}</td>
                                                    <td class="cell">{{ $data->degree }}</td>
                                                    <td class="cell">
                                                        <?php
                                                     if (!empty($data->value)) {
                                                            ?>
                                                        <div id="divID">
                                                            <a href="{{ route('checkdevice', $data->id) }}?device=yes"
                                                                class="btn btn-google-lg"><i class="fa fa-check fa-1x"
                                                                    aria-hidden="true"></i></a>
                                                            <a href="{{ route('checkdevice', $data->id) }}?device=no"
                                                                class="btn btn-google-lg"><i class="fa fa-times fa-1x"
                                                                    aria-hidden="true"></i></a>
                                                        </div>
                                                        <?php
                                                          } 
                                                          ?>
                                                    </td>
                                                    <td class="cell">
                                                      
                                                        <a href="{{ route('user.edit', $data->id) }}"
                                                            class="btn btn-primary"><i class="fas fa-edit fa-1x"></i></a>
                                              
                                                            <?php if( session("LoggedUser") == $data->id || $data->role_id == 2 ){ ?>
                                                   
                
                                                     <?php }else{ ?>
                                                        <form action="{{ route('user.destroy', $data->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                onclick="return confirm('you want to delete?');"
                                                                class="btn btn-danger">
                                                                <i class="fas fa-trash fa-1x"></i>
                                                            </button>
                                                           </td>
                                                         </form>

                                                       <?php } ?>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                         </div>
                    </div>

                    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"
                        id="bootstrap-css">
                    <!-- Script -->
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>
                    <!-- small modal -->
                    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog"
                        aria-labelledby="smallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="smallBody">
                                    <div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- medium modal -->
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
                                        <!-- the result to be displayed apply here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        function showDiv(select1) {
                            if (select1.value == "0") {
                                document.getElementById('image').style.display = "inline";
                            } else {
                                document.getElementById('image').style.display = "none";
                            }
                        }
                    @endsection
