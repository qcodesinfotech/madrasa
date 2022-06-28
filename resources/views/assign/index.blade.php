@extends('layouts.master')
@section('content')
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    </head>
    <style>
        select {
            width: 100%;
            height: 30%;
            border-radius: 5px;
        }
        th,
        td.cell {
            width: 100px !important;
            border: 1px solid black;
        }
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        #customers tr:hover {
            background-color: #ddd;
        }
        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
        #hel{
            margin-left:20%;
        }
        
        @media only screen and (max-width: 900px) {
     #hel {
     margin-left:0%;
  }
}
    </style>
    <body>
        <div id="hel">
            <h2>Assign Syllabus</h2>
            <div class="form-group">
                <form action={{ route('studentbase') }} method="POST">
                    @csrf
                    @method('post')
                    <div class="md-3">
                        <label for="student">Student:</label>
                        <select id="student" name="student" class="form-control" required>
                            <option value="" selected disabled>Select Student</option>
                            @foreach ($student as $stud)
                                <option value={{ $stud->id }}> {{ $stud->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="report" style="color:red font-size:18px;"></div>
                    <p></p>
                    <h4>SELECT PARA</h4>


                    <table id="customers">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Paras</th>
                                <th>id</th>
                                <th>Paras</th>
                                <th>id</th>
                                <th>Paras</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <tr>
                                <td>1</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[29]->id }}">{{ $parah[29]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>2</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[28]->id }}">{{ $parah[28]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>3</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[27]->id }}">{{ $parah[27]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[26]->id }}">{{ $parah[26]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>5</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[25]->id }}">{{ $parah[25]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>6</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[0]->id }}">{{ $parah[0]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[1]->id }}">{{ $parah[1]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>8</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[2]->id }}">{{ $parah[2]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>9</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[3]->id }}">{{ $parah[3]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[4]->id }}">{{ $parah[4]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>11</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[5]->id }}">{{ $parah[5]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>12</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[6]->id }}">{{ $parah[6]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>13</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[7]->id }}">{{ $parah[7]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>14</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[8]->id }}">{{ $parah[8]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>15</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[9]->id }}">{{ $parah[9]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>16</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[10]->id }}">{{ $parah[10]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>17</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[11]->id }}">{{ $parah[11]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>18</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[12]->id }}">{{ $parah[12]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>19</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[13]->id }}">{{ $parah[13]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>20</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[14]->id }}">{{ $parah[14]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>21</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[15]->id }}">{{ $parah[15]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[16]->id }}">{{ $parah[16]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>23</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[17]->id }}">{{ $parah[17]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>24</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[18]->id }}">{{ $parah[18]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>25</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[19]->id }}">{{ $parah[19]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>26</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[20]->id }}">{{ $parah[20]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>27</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[21]->id }}">{{ $parah[21]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>28</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[22]->id }}">{{ $parah[22]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>29</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[23]->id }}">{{ $parah[23]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>30</td>
                                <td>
                                    <select name="para_order[]" class="form-select" id="" required>
                                        <option value="{{ $parah[24]->id }}">{{ $parah[24]->para_name }}</option>
                                        @foreach ($parah as $data)
                                            <option value="{{ $data->id }}">{{ $data->para_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            </tr>
                        </tbody>
                    </table>





                    

                    <a href="{{ route('assign.index') }}" class="btn btn-danger">Reset</a>
                    <button class="btn btn-primary" type="submit">submit</button>
                </form>
                </html>
            @endsection
