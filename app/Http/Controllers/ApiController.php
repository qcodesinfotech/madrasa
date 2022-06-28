<?php

namespace App\Http\Controllers;

use App\Models\Daily_naz_update;
use App\Models\Hifz_update;
use App\Models\Pre_end;
use App\Models\Dor_update;
use App\Models\Structure;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use  Illuminate\Support\Carbon;
use Maatwebsite\Excel\Validators\Failure;


use GuzzleHttp\Client;

class ApiController extends Controller
{

    //////////////////////////////////////////////////--------------PARA LIST---------////////////////////////


    public function arabicdate(Request $request)
    {

        $rules = array(
            "date" => "required"

        );


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {

            $dat = str_replace('/', "-", "$request->date");

            // $date= date('d-m-Y', strtotime("0 days"));
            $client = new Client();
            $res = $client->request('GET', 'https://api.aladhan.com/v1/gToH?date=' . $dat);

            $arabicdate = $res->getBody();
            $date1 = explode(',', $arabicdate);
            $date2 = explode(':', $date1[2]);
            $save = $date2[3];

            return response()->json([
                'status' => "Success",
                'arabicdate' => str_replace('"', "", "$save"),
                'response' => 200,
            ]);
        }
    }

    public function paralist()
    {
        $paras = DB::table('paras')
            ->get();

        foreach ($paras as $key) {
            $logArray = array();
            $logArray['id'] = $key->id;
            $logArray['para_name'] = $key->para_name;
            $logArray['para_no'] = $key->para_no;
            $logArray['rukus'] = $key->rukus;
            $logArray['created_date'] = $key->created_at;
            $materialsArray[] = $logArray;
        }
        if (sizeof($paras) > 0) {
            $message = "Suceessfully para Data are listed";
            $status = "Success";
        } else {
            $message = "No para Records Found";
            $status = "Failure";
            $materialsArray = [];
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $materialsArray
        ]);
    }
    ///////////////////////////////////Student List ////////////////////////////////////////////////////////
    public function studentlist()
    {
        $paras = DB::table('students')
            ->get();
        foreach ($paras as $key) {
            $logArray = array();
            $logArray['id'] = $key->id;
            $logArray['admission_no'] = $key->admission_no;
            $logArray['student_photo'] = 'https://qcodesinfotech.com/madrasa/students_photo/' . $key->student_pic;
            $logArray['student_name'] = $key->name;
            $logArray['course_id'] = $key->course_id;
            $logArray['father_occupation'] = $key->father_occupation;
            $logArray['date_of_birth'] = $key->date_of_birth;
            $logArray['aadhar_no'] = $key->aadhar_no;
            $logArray['mobile_no'] = $key->mobile_no;
            $logArray['whatsapp_no'] = $key->whatsapp_no;
            $logArray['address'] = $key->address;
            $logArray['monthly_donation'] = $key->monthly_donation;
            $logArray['admission_date'] = $key->Admission_date;
            $logArray['blood_group'] = $key->blood_group;
            $logArray['previous_school'] = $key->previous_school;
            $logArray['created_date'] = $key->created_at;
            $materialsArray[] = $logArray;
        }
        if (sizeof($paras) > 0) {
            $message = "Suceessfully Students Data are listed";
            $status = "Success";
        } else {
            $message = "No para Records Found";
            $status = "Failure";
            $materialsArray = [];
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $materialsArray
        ]);
    }
    ////////////////////////////////-------------LOgin ---------------------------------////////////////////////


    public function login(Request $request)
    {
        $device_id = $request['device_id'];
        $phone = $request['phone'];
        // $device_type = $request['device_token'];
        $rules = array(
            "phone" => "required|min:10",
            "password" => "required",
        );


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {

            $user1 = DB::table('users')
                ->where('phone', $phone)
                ->first();

            if (!empty($user1->value)) {
                return response()->json([
                    'status' => "Failure",
                    'message' => "Your device_id is changed",

                ]);
            }

            if (isset($device_id)) {
                $check_id = DB::table('users')
                    ->where('device_id', $device_id)
                    ->first();
                if (!empty($user1)) {
                    if (!empty($check_id)) {

                        $user = User::find($user1->id);

                        $user->device_id = $request['device_id'];
                        $user->save();
                    } else {
                        $user = User::find($user1->id);
                        $user->value = $request['device_id'];
                        $user->save();
                        return response()->json([
                            'status' => "Failure",
                            'message' => "Your device_id is changed",

                        ]);
                    }
                }
            }


            $user2 = DB::table('users')
                ->where('phone', $phone)
                ->first();
            if (Hash::check($request->password, $user2->password)) {
                $user = DB::table('users')
                    ->where('phone', $phone)
                    ->get();
            } else {
                $user = [];
            }
            $array = [];
            $message = "";
            $status = "";
            if (sizeof($user) > 0) {
                foreach ($user as $key) {
                    $logArray = array();
                    $logArray['id'] = $key->id;
                    $logArray['full_name'] = $key->full_name;
                    $logArray['phone'] = $key->phone;
                    $logArray['phone2'] = $key->phone2;
                    $logArray['father'] = $key->father;
                    $logArray['degree'] = $key->degree;
                    $logArray['role'] = $key->role_id;
                    $logArray['device_id'] = $key->device_id;
                    $logArray['address'] = $key->address;
                    $logArray['device_token'] = $key->device_token;
                    $logArray['created_date'] = $key->created_at;
                    $materialsArray[] = $logArray;
                }
                foreach ($user as $users) {
                    $delete_id =  $users->is_delete;
                }
                $message = "Suceessfully login Data are listed";
                $status = "Success";
            } else {
                $message = "No login Records Found";
                $status = "Failure";
                $materialsArray = [];
            }
            if (isset($delete_id)) {
                if ($delete_id == 0) {
                    return response()->json([
                        'status' => $status,
                        'message' => $message,
                        'data' => $materialsArray
                    ]);
                } else {
                    return response()->json([
                        'status' => "Restricted",
                        'message' => "User is Restricted",
                        'data' => $array
                    ]);
                }
            } else {
                return response()->json([
                    'status' => $status,
                    'message' => $message,
                    'data' => $materialsArray
                ]);
            }
        }
    }


    ///// register Api FOr Teacher /////////////////////



    public function passupdate(Request $request)
    {

        $rules = array(

            "teacher_id" => "required|exists:users,id",
            "new_password" => "required",
            "old_password" => "required",

        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {

            $add = DB::table("users")
                ->where('id',  $request->get('teacher_id'))
                ->first();
            $user = false;


            if (Hash::check($request->get('old_password'), $add->password)) {
                $user = DB::table('users')
                    ->where('id',  $request->get('teacher_id'))
                    ->update([
                        'password' => Hash::make($request->get('new_password'))
                    ]);
            }

            if ($user) {
                $message = "Suceessfully password Update";
                $status = "Success";
            } else {
                $message = "Password not updated check Old Password ";
                $status = "Failure";
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
            ]);
        }
    }




    //////////////////////////////////////// nazira ////////////////////////



    public function listnaz(Request $request)
    {



        $today = $request['date'];


        $rules = array(
            "date" => "required",
            "student_id" => "required"
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->errors()->first();
        } else {
            $check = DB::table('daily_naz_updates')
                ->where("student_id", '=', $request->get('student_id'))
                ->where('arabic_date', '<', $today)
                ->orderBy('id', 'desc')->get()->take(10);

            foreach ($check as $key) {
                $logArray = array();
                $logArray['id'] = $key->id;
                $logArray['exam_1'] = $key->exam_1 == null ? "" : $key->exam_1;
                $logArray['exam_1a'] = $key->exam_1a == null ? "" : $key->exam_1a;
                $logArray['exam_2'] = $key->exam_2 == null ? "" : $key->exam_2;
                $logArray['exam_2a'] = $key->exam_2a == null ? "" : $key->exam_2a;
                $logArray['exam_3'] = $key->exam_3 == null ? "" : $key->exam_3;
                $logArray['exam_3a'] = $key->exam_3a == null ? "" : $key->exam_3a;
                $logArray['read_status'] = $key->read_status == null ? "" : $key->read_status;
                $logArray['read_status1'] = $key->read_status1 == null ? "" : $key->read_status1;
                $logArray['read_status2'] = $key->read_status2 == null ? "" : $key->read_status2;
                $materialsArray[] = $logArray;
            }
            $status = "Success";
            $array = DB::table('daily_naz_updates')
                ->where('student_id', $request->get('student_id'))
                ->where('arabic_date', '=', $today)
                ->orderBy('arabic_date', 'desc')->get()->take(1);

            if (sizeof($array) < 1) {
                $array[]   =   array(
                    "id" => "",
                    "arabic_date" => "",
                    "day" => "",
                    "old_exam" => "",
                    "exam_1" => "",
                    "exam_1a" => "",
                    "exam_2" => "",
                    "exam_2a" => "",
                    "exam_3" => "",
                    "exam_3a" => "",
                    "total" => "",
                    "revision" => "",
                    "n_exam" => "",
                    "month" => "",
                    "total_sub_week" => "",
                    "remark" => "",
                    "nisf" => "",
                    "overall_para" => "",
                    "course_id" => "",
                    "e_parah" => "",
                    "teacher_id" => "",
                    "student_id" => "",
                    "read_status" => "",
                    "read_status1" => "",
                    "read_status2" => "",
                    "created_at" => "",
                    "updated_at" => ""
                );
                // $status="failure";
            }


            if (sizeof($check) > 0) {
                $message = "Suceessfully Daily Nazira Update data added";
                $status = "Success";
            } else {
                $message = "No Nazira Records Found";
                $status = $status;
                $materialsArray = [];
            }

            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $materialsArray,
                'today_data' => $array,
            ]);
        }
    }
    public function addnaz(Request $request)
    {
        $rules = array(
            "course_id" => "required|exists:syllabus_types,id",
            "teacher_id" => "required|exists:users,id",
            "student_id" => "required|exists:students,id"
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $check = DB::table('daily_naz_updates')
                ->where("student_id", '=', $request->get('student_id'))
                ->get();
            $date = date('Y-m-d');

            $Array = DB::table('daily_naz_updates')
                ->whereDate('created_at', '=', $date)
                ->where("student_id", '=', $request->get('student_id'))
                ->get();
            if (sizeof($Array) > 0) {
                $update = false;
            } else {
                $update = new Daily_naz_update();
                $update->arabic_date = $request->get('arabic_date');
                $update->day = $request->get('day');
                $update->old_exam = $request->get('old_exam');
                $update->exam_1 = $request->get('exam_1');
                $update->exam_1a = $request->get('exam_1a');
                $update->exam_2 = $request->get('exam_2');
                $update->exam_2a = $request->get('exam_2a');
                $update->exam_3 = $request->get('exam_3');
                $update->exam_3a = $request->get('exam_3a');
                $update->total = $request->get('total');
                $update->revision = $request->get('revision');
                $update->n_exam = $request->get('n_exam');
                $update->total_sub_week = $request->get('total_sub_week');
                $update->remark = $request->get('remark');
                $update->nisf = $request->get('nisf');
                $update->month = $request->get('month');
                $update->course_id = $request->get('course_id');
                $update->e_parah = $request->get('e_parah');
                $update->overall_para = $request->get('overall_para');
                $update->read_status = empty($request->get('read_status')) ? "0" : $request->get('read_status');
                $update->teacher_id = $request->get('teacher_id');
                $update->read_status1 = $request->get('read_status1');
                $update->read_status2 = $request->get('read_status2');
                $update->student_id = $request->get('student_id');
                $update->save();
            }
            if ($update) {
                $message = "Suceessfully Daily Nazira Update data added";
                $status = "Success";
            } else {
                $message = "No Nazira Records Found";
                $status = "Failure";
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
            ]);
        }
    }
    /////////////////////////////////////////////Update Nazira ////////////////////////////
    public function update_naz(Request $request)
    {
        $rules = array(
            "teacher_id" => "required|exists:users,id",
            "id" => "required|exists:daily_naz_updates,id",
            "student_id" => "required|exists:students,id"
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {

            $update = Daily_naz_update::find($request->get('id'));
            $update->arabic_date = $request->get('arabic_date');
            $update->day = $request->get('day');
            $update->old_exam = $request->get('old_exam');
            $update->exam_1 = $request->get('exam_1');
            $update->exam_1a = $request->get('exam_1a');
            $update->exam_2 = $request->get('exam_2');
            $update->exam_2a = $request->get('exam_2a');
            $update->exam_3 = $request->get('exam_3');
            $update->exam_3a = $request->get('exam_3a');
            $update->total = $request->get('total');
            $update->revision = $request->get('revision');
            $update->n_exam = $request->get('n_exam');
            $update->total_sub_week = $request->get('total_sub_week');
            $update->remark = $request->get('remark');
            $update->nisf = $request->get('nisf');
            $update->month = $request->get('month');
            $update->course_id = $request->get('course_id');
            $update->e_parah = $request->get('e_parah');
            $update->overall_para = $request->get('overall_para');
            $update->read_status = empty($request->get('read_status')) ? "0" : $request->get('read_status');
            $update->teacher_id = $request->get('teacher_id');
            $update->read_status1 = $request->get('read_status1');
            $update->read_status2 = $request->get('read_status2');
            $update->student_id = $request->get('student_id');
            $update->save();
            if ($update) {
                $message = "Suceessfully Daily Nazira data Updated";
                $status = "Success";
            } else {
                $message = "No Nazira Records Found";
                $status = "Failure";
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
            ]);
        }
    }
    /////////////////////////////check previeas old Exam ////////////////////////////////////
    public function naz_exam(Request $request)
    {
        // $date = date('Y-m-d', strtotime(" -1 days"));
        $date = date('Y-m-d', strtotime(" -1 days"));
        $rules = array(
            "student_id" => "required",
            "course_id" => "required|exists:syllabus_types,id",
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $materialsArray = DB::table('daily_naz_updates')
                ->where('student_id', $request->get('student_id'))
                ->where('course_id', $request->get('course_id'))
                ->whereDate('created_at', '<=', $date)
                ->orderBy('created_at', 'desc')->get()->take(1);
            if (sizeof($materialsArray) > 0) {
                $message = "Suceessfully naz Data are listed";
                $status = "Success";
            } else {
                $message = "No Naza Records Found";
                $status = "Failure";
                $materialsArray = [];
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $materialsArray
            ]);
        }
    }
    public function teacherlist()
    {
        $paras = DB::table('users')
            ->get();
        foreach ($paras as $key) {
            $logArray = array();
            $logArray['id'] = $key->id;
            $logArray['role_id'] = $key->role_id;
            $logArray['full_name'] = $key->full_name;
            $logArray['phone'] = $key->phone;
            $materialsArray[] = $logArray;
        }
        if (sizeof($paras) > 0) {
            $message = "Suceessfully teachers Data are listed";
            $status = "Success";
        } else {
            $message = "No teacher Records Found";
            $status = "Failure";
            $materialsArray = [];
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $materialsArray
        ]);
    }
    //////////////////////////////////////current date and privieus nazira/////////////////////
    public function naz_data(Request $request)
    {

        $today = $request['date'];
        // $today = strtr($request['date'], '/', '-');
        // $today =  date('Y-m-d', strtotime($today));
        $rules = array(
            "date" => "required",
            "student_id" => "required|exists:daily_naz_updates,student_id",
            "course_id" => "required|exists:syllabus_types,id",
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $materialsArray = DB::table('daily_naz_updates')
                ->where('student_id', $request->get('student_id'))
                ->where('course_id', $request->get('course_id'))
                ->where('arabic_date', '<', $today)
                ->orderBy('arabic_date', 'desc')->get()->take(10);
            $array = DB::table('daily_naz_updates')
                ->where('student_id', $request->get('student_id'))
                ->where('course_id', $request->get('course_id'))
                ->where('arabic_date', '=', $today)
                ->orderBy('arabic_date', 'desc')->get()->take(1);
            if (sizeof($array) < 1) {
                $array[]   =   array(
                    "id" => "",
                    "arabic_date" => "",
                    "day" => "",
                    "old_exam" => "",
                    "exam_1" => "",
                    "exam_1a" => "",
                    "exam_2" => "",
                    "exam_2a" => "",
                    "exam_3" => "",
                    "exam_3a" => "",
                    "total" => "",
                    "revision" => "",
                    "n_exam" => "",
                    "month" => "",
                    "total_sub_week" => "",
                    "remark" => "",
                    "nisf" => "",
                    "overall_para" => "",
                    "course_id" => "",
                    "e_parah" => "",
                    "teacher_id" => "",
                    "student_id" => "",
                    "read_status" => "",
                    "read_status1" => "",
                    "read_status2" => "",
                    "created_at" => "",
                    "updated_at" => ""
                );
            }
            if (sizeof($materialsArray) > 0 && sizeof($array) > 0) {
                $message = "Suceessfully naz Data are listed";
                $status = "Success";
            } else {
                $message = "No Naza Records Found";
                $status = "Failure";
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
                'lastdata' => $materialsArray,
                'todaydata' => $array
            ]);
        }
    }
    /////////////////////List nazira///////
    public function nazlist(Request $request)
    {
        $rules = array(
            "student_id" => "required|exists:daily_naz_updates,student_id",
            "course_id" => "required|exists:syllabus_types,id",
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $materialsArray = DB::table('daily_naz_updates')
                ->where('student_id', $request->get('student_id'))
                ->where('course_id', $request->get('course_id'))
                ->get();
            if (sizeof($materialsArray) > 0) {
                $message = "Suceessfully naz Data are listed";
                $status = "Success";
            } else {
                $message = "No Naza Records Found";
                $status = "Failure";
                $materialsArray = [];
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $materialsArray
            ]);
        }
    }
    /////////////////////////////////// Stucture ///////////////////////////////////
    /////Add structure///////
    public function stucture(Request $request)
    {
        $rules = array(
            "para_id" => "required|exists:paras,id",
            "arabic_date" => "required",
            "teacher_id" => "required|exists:users,id",
            "student_id" => "required|exists:students,id"
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $add_stur = new Structure();
            $add_stur->para_id = $request->get('para_id');
            $add_stur->teacher_id = $request->get('teacher_id');
            $add_stur->student_id = $request->get('student_id');
            $add_stur->arabic_date = $request->get('arabic_date');
            $add_stur->save();
            if ($add_stur) {
                $message = "Suceessfully structure data added";
                $status = "Success";
            } else {
                $message = "No Nazira Records Found";
                $status = "Failure";
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
            ]);
        }
    }
    ///////////////////////////////previos list of HIFz///////////////////////////
    public function hifz_exam(Request $request)
    {
        $rules = array(
            "student_id" => "required|exists:students,id",
            "course_id" => "required|exists:syllabus_types,id",
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $date = date('Y-m-d', strtotime(" -1 days"));
            $materialsArray = DB::table('hifz_updates')
                ->where('student_id', $request->get('student_id'))
                ->where('course_id', $request->get('course_id'))
                ->whereDate('created_at', '<=', $date)
                ->orderBy('created_at', 'desc')->get()->take(1);
            if (sizeof($materialsArray) > 0) {
                $message = "Suceessfully naz Data are listed";
                $status = "Success";
            } else {
                $message = "No Naza Records Found";
                $status = "Failure";
                $materialsArray = [];
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $materialsArray
            ]);
        }
    }
    //////////////////////////////////////
    public function hifzlist(Request $request)
    {
        $rules = array(
            "student_id" => "required|exists:hifz_updates,student_id",
            "course_id" => "required|exists:syllabus_types,id",
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $materialsArray = DB::table('hifz_updates')
                ->where('student_id', $request->get('student_id'))
                ->where('course_id', $request->get('course_id'))
                ->get();
            if (sizeof($materialsArray) > 0) {
                $message = "Suceessfully naz Data are listed";
                $status = "Success";
            } else {
                $message = "No Naza Records Found";
                $status = "Failure";
                $materialsArray = [];
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $materialsArray
            ]);
        }
    }
    public function hifz_data(Request $request)
    {

        $today = $request['date'];
        // $today = strtr($request['date'], '/', '-');
        // $today =  date('Y-m-d', strtotime($today));

        $rules = array(
            "date" => "required",
            "student_id" => "required|exists:hifz_updates,student_id",
            "course_id" => "required|exists:hifz_updates,course_id",

        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $materialsArray = DB::table('hifz_updates')
                ->where('student_id', $request->get('student_id'))
                ->where('course_id', $request->get('course_id'))
                ->where('arabic_date', '<', $today)
                ->orderBy('arabic_date', 'desc')->get()->take(1);
            $array = DB::table('hifz_updates')
                ->where('student_id', $request->get('student_id'))
                ->where('course_id', $request->get('course_id'))
                ->where('arabic_date', '=', $today)
                ->orderBy('arabic_date', 'desc')->get()->take(1);




            if (sizeof($array) < 1) {
                $array[]   =   array(
                    "id" => "",
                    "arabic_date" => "",
                    "day" => "",
                    "old_exam" => "",
                    "exam_1" => "",
                    "exam_1a" => "",
                    "exam_2" => "",
                    "exam_2a" => "",
                    "exam_3" => "",
                    "exam_3a" => "",
                    "total" => "",
                    "revision" => "",
                    "n_exam" => "",
                    "month" => "",
                    "total_sub_week" => "",
                    "remark" => "",
                    "nisf" => "",
                    "overall_para" => "",
                    "course_id" => "",
                    "e_parah" => "",
                    "teacher_id" => "",
                    "student_id" => "",
                    "read_status" => "",
                    "read_status1" => "",
                    "read_status2" => "",
                    "created_at" => "",
                    "updated_at" => ""
                );
            }



            if (sizeof($materialsArray) > 0 && sizeof($array) > 0) {
                $message = "Suceessfully naz Data are listed";
                $status = "Success";
            } else {
                $message = "No Naza Records Found";
                $status = "Failure";
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
                'lastdata' => $materialsArray,
                'todaydata' => $array
            ]);
        }
    }
    //////////////////////////////Addd HIFZ///////////////////////////
    public function hifz(Request $request)
    {
        $rules = array(
            "course_id" => "required|exists:syllabus_types,id",
            "teacher_id" => "required|exists:users,id",
            "student_id" => "required|exists:students,id"
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $date = date('Y-m-d');
            $Array = DB::table('hifz_updates')
                ->whereDate('created_at', '=', $date)
                ->where("student_id", '=', $request->get('student_id'))
                ->get();
            if (sizeof($Array) > 0) {
                $update = false;
            } else {
                $update = new Hifz_update();
                $update->arabic_date = $request->get('arabic_date');
                $update->day = $request->get('day');
                $update->old_exam = $request->get('old_exam');
                $update->exam_1 = $request->get('exam_1');
                $update->exam_1a = $request->get('exam_1a');
                $update->exam_2 = $request->get('exam_2');
                $update->exam_2a = $request->get('exam_2a');
                $update->exam_3 = $request->get('exam_3');
                $update->exam_3a = $request->get('exam_3a');
                $update->total = $request->get('total');
                $update->revision = $request->get('revision');
                $update->n_exam = $request->get('n_exam');
                $update->total_sub_week = $request->get('total_sub_week');
                $update->remark = $request->get('remark');
                $update->nisf = $request->get('nisf');
                $update->month = $request->get('month');
                $update->course_id = $request->get('course_id');
                $update->e_parah = $request->get('e_parah');
                $update->overall_para = $request->get('overall_para');
                $update->read_status = empty($request->get('read_status')) ? "0" : $request->get('read_status');
                $update->teacher_id = $request->get('teacher_id');
                $update->read_status1 = $request->get('read_status1');
                $update->read_status2 = $request->get('read_status2');
                $update->student_id = $request->get('student_id');
                $update->save();
            }
            if ($update) {
                $message = "Suceessfully  Hifa data added";
                $status = "Success";
            } else {
                $message = "No Hifa  Records Found";
                $status = "Failure";
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
            ]);
        }
    }
    /////////////////////////////////////Update HIFZ ////////////////////////////////
    public function update_hifz(Request $request)
    {
        $rules = array(
            "id" => "required",
            "nisf" => "required",
            "month" => "required",
            "course_id" => "required|exists:syllabus_types,id",
            "overall_para" => "required",
            "teacher_id" => "required|exists:users,id",
            "student_id" => "required|exists:students,id"
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $update = Hifz_update::find($request->get('id'));
            $update->arabic_date = $request->get('arabic_date');
            $update->day = $request->get('day');
            $update->old_exam = $request->get('old_exam');
            $update->exam_1 = $request->get('exam_1');
            $update->exam_1a = $request->get('exam_1a');
            $update->exam_2 = $request->get('exam_2');
            $update->exam_2a = $request->get('exam_2a');
            $update->exam_3 = $request->get('exam_3');
            $update->exam_3a = $request->get('exam_3a');
            $update->remark = $request->get('remark');
            $update->total = $request->get('total');
            $update->revision = $request->get('revision');
            $update->n_exam = $request->get('n_exam');
            $update->total_sub_week = $request->get('total_sub_week');
            $update->nisf = $request->get('nisf');
            $update->month = $request->get('month');
            $update->course_id = $request->get('course_id');
            $update->e_parah = $request->get('e_parah');
            $update->overall_para = $request->get('overall_para');
            $update->read_status = empty($request->get('read_status')) ? "0" : $request->get('read_status');
            $update->teacher_id = $request->get('teacher_id');
            $update->read_status1 = $request->get('read_status1');
            $update->read_status2 = $request->get('read_status2');
            $update->student_id = $request->get('student_id');
            $update->save();
            if ($update) {
                $message = "Suceessfully data Updated";
                $status = "Success";
            } else {
                $message = "No Nazira Records Found";
                $status = "Failure";
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
            ]);
        }
    }
    public function dorupdate(Request $request)
    {
        $rules = array(
            "month" => "required",
            "overall_para" => "required",
            "course_id" => "required|exists:syllabus_types,id",
            "teacher_id" => "required|exists:users,id",
            "student_id" => "required|exists:students,id"
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $date = date('Y-m-d');
            $Array = DB::table('dor_updates')
                ->whereDate('created_at', '=', $date)
                ->where("student_id", '=', $request->get('student_id'))
                ->get();
            if (sizeof($Array) > 0) {
                $update = false;
            } else {
                $update = new Dor_update();
                $update->arabic_date = $request->get('arabic_date');
                $update->day = $request->get('day');
                $update->old_exam = $request->get('old_exam');
                $update->exam_1 = $request->get('exam_1');
                $update->exam_1a = $request->get('exam_1a');
                $update->exam_2 = $request->get('exam_2');
                $update->exam_2a = $request->get('exam_2a');
                $update->exam_3 = $request->get('exam_3');
                $update->exam_3a = $request->get('exam_3a');
                $update->total = $request->get('total');
                $update->revision = $request->get('revision');
                $update->n_exam = $request->get('n_exam');
                $update->total_sub_week = $request->get('total_sub_week');
                $update->remark = $request->get('remark');
                $update->nisf = $request->get('nisf');
                $update->month = $request->get('month');
                $update->course_id = $request->get('course_id');
                $update->e_parah = $request->get('e_parah');
                $update->overall_para = $request->get('overall_para');
                $update->read_status = empty($request->get('read_status')) ? "0" : $request->get('read_status');
                $update->teacher_id = $request->get('teacher_id');
                $update->read_status1 = $request->get('read_status1');
                $update->read_status2 = $request->get('read_status2');
                $update->student_id = $request->get('student_id');
                $update->save();
            }
            if ($update) {
                $message = "Suceessfully  Dor data added";
                $status = "Success";
            } else {
                $message = "No dor  Records Found";
                $status = "Failure";
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
            ]);
        }
    }
    public function update_dor(Request $request)
    {
        $rules = array(
            "id" => "required",
            "nisf" => "required",
            "course_id" => "required|exists:syllabus_types,id",
            "month" => "required",
            "overall_para" => "required",
            "teacher_id" => "required|exists:users,id",
            "student_id" => "required|exists:students,id"
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $update = Dor_update::find($request->get('id'));
            $update->arabic_date = $request->get('arabic_date');
            $update->day = $request->get('day');
            $update->old_exam = $request->get('old_exam');
            $update->exam_1 = $request->get('exam_1');
            $update->exam_1a = $request->get('exam_1a');
            $update->exam_2 = $request->get('exam_2');
            $update->exam_2a = $request->get('exam_2a');
            $update->exam_3 = $request->get('exam_3');
            $update->exam_3a = $request->get('exam_3a');
            $update->remark = $request->get('remark');
            $update->total = $request->get('total');
            $update->revision = $request->get('revision');
            $update->n_exam = $request->get('n_exam');
            $update->total_sub_week = $request->get('total_sub_week');
            $update->nisf = $request->get('nisf');
            $update->month = $request->get('month');
            $update->course_id = $request->get('course_id');
            $update->e_parah = $request->get('e_parah');
            $update->overall_para = $request->get('overall_para');
            $update->read_status = empty($request->get('read_status')) ? "0" : $request->get('read_status');
            $update->teacher_id = $request->get('teacher_id');
            $update->read_status1 = $request->get('read_status1');
            $update->read_status2 = $request->get('read_status2');
            $update->student_id = $request->get('student_id');
            $update->save();
            if ($update) {
                $message = "Suceessfully data Updated";
                $status = "Success";
            } else {
                $message = "No Nazira Records Found";
                $status = "Failure";
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
            ]);
        }
    }
    public function dor_data(Request $request)
    {



        $today = $request['date'];
        // $today = strtr($request['date'], '/', '-');
        // $today =  date('Y-m-d', strtotime($today));
        $rules = array(
            "date" => "required",
            "student_id" => "required|exists:dor_updates,student_id",
            "course_id" => "required|exists:dor_updates,course_id",
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $materialsArray = DB::table('dor_updates')
                ->where('student_id', $request->get('student_id'))
                ->where('course_id', $request->get('course_id'))
                ->where('arabic_date', '<', $today)
                ->orderBy('arabic_date', 'desc')->get()->take(1);
            $array = DB::table('dor_updates')
                ->where('student_id', $request->get('student_id'))
                ->where('course_id', $request->get('course_id'))
                ->where('arabic_date', '=', $today)
                ->orderBy('arabic_date', 'desc')->get()->take(1);
            if (sizeof($array) < 1) {
                $array[]   =   array(
                    "id" => "",
                    "arabic_date" => "",
                    "day" => "",
                    "old_exam" => "",
                    "exam_1" => "",
                    "exam_1a" => "",
                    "exam_2" => "",
                    "exam_2a" => "",
                    "exam_3" => "",
                    "exam_3a" => "",
                    "total" => "",
                    "revision" => "",
                    "n_exam" => "",
                    "month" => "",
                    "total_sub_week" => "",
                    "remark" => "",
                    "nisf" => "",
                    "overall_para" => "",
                    "course_id" => "",
                    "e_parah" => "",
                    "teacher_id" => "",
                    "student_id" => "",
                    "read_status" => "",
                    "read_status1" => "",
                    "read_status2" => "",
                    "created_at" => "",
                    "updated_at" => ""
                );
            }
            if (sizeof($materialsArray) > 0 && sizeof($array) > 0) {
                $message = "Suceessfully naz Data are listed";
                $status = "Success";
            } else {
                $message = "No Naza Records Found";
                $status = "Failure";
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
                'lastdata' => $materialsArray,
                'todaydata' => $array
            ]);
        }
    }
    public function listpre_end()
    {
        $paras = DB::table('pre_ends')
            ->join("students", "students.id", "=", "pre_ends.student_id")
            ->join("paras", "paras.id", "=", "pre_ends.target")
            ->where('status', '=', '0')
            ->select('pre_ends.id', 'pre_ends.student_id', 'pre_ends.target', 'pre_ends.course_id', 'students.name', 'pre_ends.remark', 'paras.para_name', 'date', 'pre_ends.status')
            ->get();
        foreach ($paras as $key) {
            $logArray = array();
            $logArray['id'] = $key->id;
            $logArray['student_id'] = $key->student_id;
            $logArray['date'] = $key->date;
            $logArray['target'] = $key->target;
            $logArray['course_id'] = $key->course_id;
            $logArray['remark'] = $key->remark;
            $logArray['status'] = $key->status;
            $logArray['student_name'] = $key->name;
            $logArray['para_name'] = $key->para_name;
            $materialsArray[] = $logArray;
        }
        if (sizeof($paras) > 0) {
            $message = "Suceessfully pre_ends Data are listed";
            $status = "Success";
        } else {
            $message = "No pre_ends Records Found";
            $status = "Failure";
            $materialsArray = [];
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $materialsArray
        ]);
    }
    public function addendparah(Request $request)
    {
        $rules = array(
            "course_id" => "required|exists:syllabus_types,id",
            "date" => "required",
            "teacher_id" => "required|exists:users,id",
            "student_id" => "required|exists:students,id",
            "target" => "required|exists:paras,id"
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $update = new Pre_end();
            $update->student_id = $request->get('student_id');
            $update->teacher_id = $request->get('teacher_id');
            $update->date = $request->get('date');
            $update->target = $request->get('target');
            $update->course_id = $request->get('course_id');
            $update->remark = $request->get('remark');
            if ($update->status == null) $update->status = "0";
            $update->save();
            if ($update) {
                $message = "Suceessfully data Updated";
                $status = "Success";
            } else {
                $message = "No End para Records Found";
                $status = "Failure";
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
            ]);
        }
    }
    public function preend_update(Request $request)
    {
        $rules = array(
            "id" => "required|exists:pre_ends,id",
            "status" => "required"
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            if ($request->status == "1") {
                $pre = DB::table('pre_ends')
                    ->where('pre_ends.id', '=', $request->id)
                    ->first();
                $add_stur = new Structure();
                $add_stur->para_id = $pre->target;
                $add_stur->teacher_id = $pre->teacher_id;
                $add_stur->student_id = $pre->student_id;
                $add_stur->arabic_date = $pre->date;
                $add_stur->course_id = $pre->course_id;
                $add_stur->save();
                $num = Carbon::createFromFormat('Y-m-d H:i:s', $pre->created_at)->format('m');
                $num = ltrim($num, '0');
                $assign = DB::table("syllabus_adds")
                    ->where("syllabus_adds.student_id", "=", $pre->student_id)
                    ->where("syllabus_adds.month", "=", $num)
                    ->where('no_of_parah', 'like', '%Para%')
                    ->where('syllabus_adds.course_id', "=", $pre->course_id)
                    ->first();
                if (empty($assign)) {
                    return response()->json([
                        'status' => "Failure",
                        'message' => "'Your status Not Updated Target course  student is invalid",
                    ]);
                } else {
                    $question = Pre_end::find($pre->id);
                    $question->status = 1;
                    $question->save();
                    if (empty($assign->c_target)) {
                        $data = "";
                    } else {
                        $data = $assign->c_target . ",";
                    }
                    $add = DB::table("syllabus_adds")
                        ->where('id', $assign->id)
                        ->update([
                            'c_target' => $data . "" . $pre->target
                        ]);
                }
                if (!empty($add)) {
                    $update = true;
                }
            } elseif ($request->status == "2") {
                $pre = DB::table('pre_ends')
                    ->where('pre_ends.id', '=', $request->id)
                    ->first();
                if (!empty($request->get('remark'))) {
                    DB::table('pre_ends')
                        ->where('id', $pre->id)
                        ->update([
                            'status' => 2,
                            'remark' => $request->get('remark')
                        ]);
                } elseif (empty($request->get('remark'))) {
                    DB::table('pre_ends')
                        ->where('id', $pre->id)
                        ->update([
                            'status' => 2
                        ]);
                } else {
                    $update = false;
                }
                $update = true;
            } else {
                $update = false;
            }
            if ($update) {
                $message = "Suceessfully data Updated";
                $status = "Success";
            } else {
                $message = "No End para Records Found";
                $status = "Failure";
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
            ]);
        }
    }
    public function findstudent(Request $request)
    {




        $paras = DB::table('teachers')
            ->join("students", "students.id", "=", "teachers.student_id")
            ->join("syllabus_types", "syllabus_types.id", '=', 'students.course_id')

            ->where('teachers.teacher_id', '=', $request->get('teacher_id'))
            ->select('students.id', 'students.name', 'students.course_id', 'syllabus_types.year as year')
            ->get();

        foreach ($paras as $key) {
            $logArray = array();
            $logArray['id'] = $key->id;
            $logArray['name'] = $key->name;
            $logArray['course_id'] = $key->course_id;
            $logArray['year_id'] = $key->year;
            $materialsArray[] = $logArray;
        }
        if (sizeof($paras) > 0) {
            $message = "Suceessfully student Data are listed";
            $status = "Success";
        } else {
            $message = "No student Records Found";
            $status = "Failure";
            $materialsArray = [];
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $materialsArray
        ]);
    }
    public function attendence(Request $request)
    {
        $rules = array(
            "date" => "required",
            "session" => "required",
            "student_id" => "required|exists:students,id"
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $check = DB::table("attendances")
                ->where("student_id", '=', $request->get('student_id'))
                ->where("session", '=', $request->get('session'))
                ->where("date", '=', $request->get('date'))
                ->first();
            if (!empty($check)) {
                $user = Attendance::find($check->id);
                $user->student_id = $request['student_id'];
                $user->date = $request['date'];
                $user->session = $request['session'];
                $user->remark = $request['remark'];
                $user->status = $request['status'];
                $user->save();
                if ($user) {
                    $message = "Suceessfully Attendence data updated";
                    $status = "Success";
                } else {
                    $message = "No Attendence Records Found";
                    $status = "Failure";
                }
                return response()->json([
                    'status' => $status,
                    'message' => $message,
                ]);
            } else {
                $add_stur = new Attendance();
                $add_stur->student_id = $request->get('student_id');
                $add_stur->session = $request->get('session');
                $add_stur->status = $request->get('status');
                $add_stur->remark = $request->get('remark');
                $add_stur->date = $request->get('date');
                $add_stur->save();
                if ($add_stur) {
                    $message = "Suceessfully Attendence data added";
                    $status = "Success";
                } else {
                    $message = "No Attendence Records Found";
                    $status = "Failure";
                }
                return response()->json([
                    'status' => $status,
                    'message' => $message,
                ]);
            }
        }
    }


    public function getattendencelist(Request $request)
    {
        $rules = array(
            "date" => "required",
            "student_id" => "required|exists:attendances,id"
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $list = DB::table('attendances')
                ->where('student_id', '=', $request->student_id)
                ->where('date', '=', $request->date)
                ->get();


            if (sizeof($list) > 0) {
                $message = "Suceessfully student Data are listed";
                $status = "Success";
            } else {
                $message = "No student Records Found";
                $status = "Failure";
                $list = [];
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $list
            ]);
        }
    }



    //<------------sick detail ------->//

    public function listsickdetail()
    {
        $sick_leave = DB::table('sick_leave_details')
        ->join('students', 'students.id', 'sick_leave_details.student_id')
        ->select('sick_leave_details.*','students.name as student_name')

        ->get();
        //print_r($sick_leave);
        return response()->json([
            'status' => "success",
            'message' => "listed successfully",
            'data' => $sick_leave
        ]);
        if (sizeof($sick_leave) > 0) {
            return response()->json([
                'status' => "success",
                'message' => "listed successfully",
                'data' => $sick_leave
            ]);
        } else {
            return response()->json([
                'status' => "failure",
                'message' => "Empty data listed",
                'data' => []
            ]);
        }
    }


    public function updatesickdetail(Request $request)
    {



        $rules = array(
            "student_id" => "required",
            "date" => "required",
            "food_1" => "required",
            "medicine_1" => "required",
            "description_1" => "required",
            "food_2" => "required",
            "medicine_2" => "required",
            "description_2" => "required",
            "food_3" => "required",
            "medicine_3" => "required",
            "description_3" => "required",
            "food_4" => "required",
            "medicine_4" => "required",
            "description_4" => "required",
            "leave" => "required",

        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {


            $data = DB::table("sick_leave_details")
                ->where('id', $request->id)
                ->update(array(
                    "student_id" =>  $request["student_id"],
                    "date" => $request["date"],
                    "food_1" => $request["food_1"],
                    "medicine_1" => $request["medicine_1"],
                    "description_1" => $request["description_1"],
                    "food_2" => $request["food_2"],
                    "medicine_2" => $request["medicine_2"],
                    "description_2" => $request["description_2"],
                    "food_3" => $request["food_3"],
                    "medicine_3" => $request["medicine_3"],
                    "description_3" => $request["description_3"],
                    "food_4" => $request["food_4"],
                    "medicine_4" => $request["medicine_4"],
                    "description_4" => $request["description_4"],
                    "leave" => $request["leave"],
                ));

            if ($data) {
                return response()->json([
                    'status' => "success",
                    'message' => "updated successfully",
                ]);
            } else {
                return response()->json([
                    'status' => "failure",
                    'message' => "Not updated",
                ]);
            }
        }
    }

    public function destroysickdetail(Request $request)
    {



        $rules = array(
            "id" => "required",


        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $deleted = DB::table('sick_leave_details')
                ->where('id', $request->id)
                ->delete();

            if ($deleted) {
                return response()->json([
                    'status' => "success",
                    'message' => "deleted successfully",
                ]);
            } else {
                return response()->json([
                    'status' => "failure",
                    'message' => "Not deleted",
                ]);
            }
        }
    }

    public function addsickdetail(Request $request)
    {


        $rules = array(
            "student_id" => "required",
            "date" => "required",
            "food_1" => "required",
            "medicine_1" => "required",
            "description_1" => "required",
            "food_2" => "required",
            "medicine_2" => "required",
            "description_2" => "required",
            "food_3" => "required",
            "medicine_3" => "required",
            "description_3" => "required",
            "food_4" => "required",
            "medicine_4" => "required",
            "description_4" => "required",
            "leave" => "required",

        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {

            $created = DB::table("sick_leave_details")
                ->insert(array(
                    "student_id" =>  $request["student_id"],
                    "date" => $request["date"],
                    "food_1" => $request["food_1"],
                    "medicine_1" => $request["medicine_1"],
                    "description_1" => $request["description_1"],
                    "food_2" => $request["food_2"],
                    "medicine_2" => $request["medicine_2"],
                    "description_2" => $request["description_2"],
                    "food_3" => $request["food_3"],
                    "medicine_3" => $request["medicine_3"],
                    "description_3" => $request["description_3"],
                    "food_4" => $request["food_4"],
                    "medicine_4" => $request["medicine_4"],
                    "description_4" => $request["description_4"],
                    "leave" => $request["leave"],
                ));

            if ($created) {
                return response()->json([
                    'status' => "success",
                    'message' => "created successfully",
                ]);
            } else {
                return response()->json([
                    'status' => "failure",
                    'message' => "Not created",
                ]);
            }
        }
    }
}
