<?php

namespace App\Http\Controllers;

use App\Models\Daily_naz_update;
use App\Models\Hifz_update;
use App\Models\Pre_end;
use App\Models\Dor_update;
use App\Models\Structure;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Para;
use App\Models\student_based_para;
use App\Models\Syllabus_add;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use GuzzleHttp\Client;
use Carbon\CarbonPeriod;

class ApiController extends Controller
{
    //////////////////////////////////////////////////--------//  PARA LIST  //---------////////////////////////
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
            $client = new Client();
            $res = $client->request('GET', 'https://api.aladhan.com/v1/gToH?date=' . $dat);
            $arabicdate = $res->getBody();
            $date1 = explode(',', $arabicdate);
            $date2 = explode(':', $date1[2]);
            $save = $date2[3];
            $datearr =  str_replace('"', "", $save);
            return response()->json([
                'status' => "Success",
                'arabicdate' => str_replace('-', "/", $datearr),
                'response' => 200,
            ]);
        }
    }
    public function remarknaz(Request $request)
    {
        $rules = array(
            "from" => "required",
            "to" => "required",
            "remark" => "required",
            "student_id" => "required",
            "teacher_id" => "required"
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $date_start = $list['start-date'] = Carbon::createFromFormat('d/m/Y', $request['from'])->format('d-m-Y');
            $date_end = $list['end-date'] = Carbon::createFromFormat('d/m/Y', $request['to'])->format('d-m-Y');
            $period = CarbonPeriod::create($date_start, $date_end);
            foreach ($period as $date) {
                $insert = DB::table("daily_naz_updates")
                    ->insert(
                        array(
                            "arabic_date" =>  $date->format('d/m/Y'),
                            "month" =>  $date->format('m'),
                            "student_id" => $request["student_id"],
                            "teacher_id" => $request["teacher_id"],
                            "remark" => $request["remark"],
                        )
                    );
            }
            if ($insert) {
                return response()->json([
                    'status' => "Success",
                    'message' => "Suceessfully Remark Added"
                ]);
            } else {
                return response()->json([
                    'status' => "Failure",
                    'message' => "Check Date Error"
                ]);
            }
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
    public function studentlist(Request $request)
    {
        function findupcomingpara1($sid)
        {

            //state
            $check_naz = DB::table('daily_naz_updates')
                ->where("student_id", '=', $sid)
                ->get();
            $condition = false;
            if (sizeof($check_naz) <= 0) {
                $condition = 7;
            } else {
                $condition = false;
            }

            foreach ($check_naz as $data) {
                if ($data->exam_1a == '0-28' || $data->exam_2a == '0-28' || $data->exam_3a == '0-28') {
                    $condition = true;
                    break;
                }
            }

            if ($condition == 7) {
                return "";
            } else if ($condition == false) {

                return 0;
            } else {
                return 1;
            }
        }

        function findObjectById($array, $id)
        {
            // print_r($id);
            for ($i = 0; $i < sizeof($array); $i++) {

                if ($array[$i]["paraid"] == $id) {

                    return $array[$i + 1];
                }
            }

            return false;
        }


        function findlastpara($data, $id)
        {
            // print_r($id);
            $globel = array();
            // $value = array();

            foreach ($data as $key) {

                if (str_contains($key->no_of_parah, 'Parah')) {
                    $arr = explode(",", $key->target);

                    $p = student_based_para::whereIn('student_based_paras.id', $arr)
                        ->join('paras', 'paras.id', '=', 'student_based_paras.para_order')
                        ->select('para_name', 'paras.id')->get();

                    foreach ($p as $a) {

                        $value = array();
                        $value["paraname"] = $a->para_name;
                        $value["paraid"] = $a->id;
                        $globel[] = $value;
                    }
                }
            }

            // print_r($globel);
            return findObjectById($globel, $id);
        }



        $status = $request->status;
        $course_id = $request->course_id;

        if ($status == 0) {
            $paras = DB::table('students')
                ->join('syllabus_types', 'syllabus_types.id', 'students.course_id')
                ->where('students.status', 0)
                ->select('students.*', 'syllabus_types.title as course')
                ->get();
        } else if ($status == 1) {

            $paras = DB::table('students')
                ->join('syllabus_types', 'syllabus_types.id', 'students.course_id')
                ->where('students.status', 1)
                ->select('students.*', 'syllabus_types.title as course')
                ->get();
        } else {
            $paras = DB::table('students')
                ->join('syllabus_types', 'syllabus_types.id', 'students.course_id')
                ->select('students.*', 'syllabus_types.title as course')
                ->get();
        }





        foreach ($paras as $key) {

            if ($key->course_id == $course_id) {
                $logArray = array();
                $logArray['id'] = $key->id;
                $logArray['admission_no'] = $key->admission_no;
                $logArray['student_photo'] = 'https://qcodesinfotech.com/madrasa/students_photo/' . $key->student_pic;
                $logArray['student_name'] = $key->name;
                $logArray['course_id'] = $key->course_id;
                $logArray['course'] = $key->course;
                $logArray['father_occupation'] = !empty($key->father_occupation) ? $key->father_occupation : "";
                $logArray['father_name'] = !empty($key->father_name) ? $key->father_name : "";
                $logArray['date_of_birth'] = !empty($key->date_of_birth) ? $key->date_of_birth : "";
                $logArray['aadhar_no'] = !empty($key->aadhar_no) ? $key->aadhar_no : "";
                $logArray['mobile_no'] = !empty($key->mobile_no) ? $key->mobile_no : "";
                $logArray['whatsapp_no'] = !empty($key->whatsapp_no) ? $key->whatsapp_no : "";
                $logArray['address'] = $key->address;
                $city = explode(",", $key->address)[0];
                $logArray['city'] = $city;
                $logArray['monthly_donation'] = !empty($key->monthly_donation) ? $key->monthly_donation : "";
                $logArray['admission_date'] = $key->Admission_date;
                $logArray['previous_school'] = !empty($key->previous_school) ? $key->previous_school : "";
                $logArray['status'] = $key->status;
                $logArray['created_date'] = $key->created_at;
                $pr_para = DB::table('pre_ends')
                    ->where('pre_ends.student_id', $key->id)
                    ->where('pre_ends.status', 1)
                    ->select('*')
                    ->orderByDesc('id')
                    ->first();
                $mansooq = DB::table('pre_ends')
                    ->where('pre_ends.student_id', $key->id)
                    ->where('pre_ends.status', 3)
                    ->select('*')
                    ->first();

                $previous =  DB::table('syllabus_adds')
                    ->where('student_id', $key->id)
                    ->select('target', 'no_of_parah')
                    ->get();

                if (!empty($mansooq)) {

                    $logArray['previous_para_id'] = !empty($pr_para) ? $pr_para->target : 0;
                    $logArray['office_para_status'] = $mansooq->status;
                    $logArray['mansooq_para'] =   $mansooq->target;
                } elseif (!empty($pr_para)) {
                    $check_para = findlastpara($previous, $pr_para->target);
                    $upcoming_para_id = findupcomingpara1($key->id);

                    $predel = !empty($pr_para) ? $pr_para->target : 0;
                    $logArray['previous_para_id'] =  !empty($pr_para) ? $pr_para->target : 0;
                    $logArray['office_para_status'] =  !empty($pr_para) ? $pr_para->status : 0;

                    if (!empty($check_para)) {

                        $logArray['upcoming_para_id'] = $check_para["paraid"];
                    } else if (strpos($predel, "0-") !== false) {

                        $logArray['upcoming_para_id'] =   '1';
                    } else {
                        $logArray['upcoming_para_id'] =    '0';
                    }
                } else {
                    $logArray['previous_para_id'] = "0";
                    $logArray['office_para_status'] = "0";
                    $upcoming_para_id = !empty(findupcomingpara1($key->id)) ? findupcomingpara1($key->id) : "0";
                    $logArray['upcoming_para_id'] =   $upcoming_para_id;
                }

                $materialsArray[] = $logArray;
            } elseif (empty($course_id)) {

                $logArray = array();
                $logArray['id'] = $key->id;
                $logArray['admission_no'] = $key->admission_no;
                $logArray['student_photo'] = 'https://qcodesinfotech.com/madrasa/students_photo/' . $key->student_pic;
                $logArray['student_name'] = $key->name;
                $logArray['course_id'] = $key->course_id;
                $logArray['course'] = $key->course;
                $logArray['father_occupation'] = !empty($key->father_occupation) ? $key->father_occupation : "";
                $logArray['father_name'] = !empty($key->father_name) ? $key->father_name : "";
                $logArray['date_of_birth'] = !empty($key->date_of_birth) ? $key->date_of_birth : "";
                $logArray['aadhar_no'] = !empty($key->aadhar_no) ? $key->aadhar_no : "";
                $logArray['mobile_no'] = $key->mobile_no;
                $logArray['whatsapp_no'] = !empty($key->whatsapp_no) ? $key->whatsapp_no : "";
                $logArray['address'] = $key->address;
                $city = explode(",", $key->address)[0];
                $logArray['city'] = $city;
                $logArray['monthly_donation'] = !empty($key->monthly_donation) ? $key->monthly_donation : "";
                $logArray['admission_date'] = $key->Admission_date;
                $logArray['blood_group'] = !empty($key->blood_group) ? $key->blood_group : "";
                $logArray['previous_school'] = !empty($key->previous_school) ? $key->previous_school : "";
                $logArray['status'] = $key->status;
                $logArray['created_date'] = $key->created_at;
                $pr_para = DB::table('pre_ends')
                    ->where('pre_ends.student_id', $key->id)
                    ->where('pre_ends.status', 1)
                    ->select('*')
                    ->orderByDesc('id')
                    ->first();

                $previous =  DB::table('syllabus_adds')
                    ->where('student_id', $key->id)
                    ->select('target', 'no_of_parah')
                    ->get();
                $mansooq = DB::table('pre_ends')
                    ->where('pre_ends.student_id', $key->id)
                    ->where('pre_ends.status', 3)
                    ->select('*')
                    ->first();
                if (!empty($mansooq)) {

                    $logArray['previous_para_id'] = !empty($pr_para) ? $pr_para->target : 0;
                    $logArray['office_para_status'] = $mansooq->status;
                    $logArray['mansooq_para'] =   $mansooq->target;
                } elseif (!empty($pr_para)) {

                    $check_para = findlastpara($previous, $pr_para->target);

                    $upcoming_para_id = findupcomingpara1($key->id);


                    $predel = !empty($pr_para) ? $pr_para->target : 0;
                    $logArray['previous_para_id'] =  !empty($pr_para) ? $pr_para->target : 0;
                    $logArray['office_para_status'] =  !empty($pr_para) ? $pr_para->status : 0;

                    if (!empty($check_para)) {
                        $logArray['upcoming_para_id'] =  $check_para["paraid"];
                    } else if (strpos($predel, "0-") !== false) {
                        $logArray['upcoming_para_id'] =   '1';
                    } else {
                        $logArray['upcoming_para_id'] =    '0';
                    }
                    // $logArray['upcoming_para_id'] =  $upcoming_para_id;
                } else {

                    $logArray['previous_para_id'] = "0";
                    $logArray['office_para_status'] = "0";
                    $upcoming_para_id = !empty(findupcomingpara1($key->id)) ? findupcomingpara1($key->id) : "0";
                    $logArray['upcoming_para_id'] =   $upcoming_para_id;
                }



                $materialsArray[] = $logArray;
            }
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
    ////////////////////////////////-------------Login ---------------------------------////////////////////////
    public function login(Request $request)
    {
        $device_id = $request['device_id'];
        $phone = $request['phone'];
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
            if (empty($user2->phone)) {
                return response()->json([
                    'status' => "Failure",
                    'message' => "Invalid Phone no or Password",
                ]);
            }
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
                ->orderBy('arabic_date', 'DESC')
                ->get();
            $a = 1;
            $exp_date = explode("/", $today);
            $req_date = $exp_date[2] . $exp_date[1] . $exp_date[0];
            foreach ($check as $key) {
                $exp_date1 = explode("/", $key->arabic_date == null ? "" : $key->arabic_date);
                $req_date1 = $exp_date1[2] . $exp_date1[1] . $exp_date1[0];
                if ((int)$req_date > (int)$req_date1) {
                    $logArray = array();
                    $logArray['id'] = $key->id;
                    $logArray['arabic_date'] = $key->arabic_date;
                    $logArray['exam_1'] = $key->exam_1 == null ? "" : $key->exam_1;
                    $logArray['exam_1a'] = $key->exam_1a == null ? "" : $key->exam_1a;
                    $logArray['exam_2'] = $key->exam_2 == null ? "" : $key->exam_2;
                    $logArray['exam_2a'] = $key->exam_2a == null ? "" : $key->exam_2a;
                    $logArray['exam_3'] = $key->exam_3 == null ? "" : $key->exam_3;
                    $logArray['exam_3a'] = $key->exam_3a == null ? "" : $key->exam_3a;
                    $logArray['exam1_time'] = $key->exam1_time == null ? "" : $key->exam1_time;
                    $logArray['exam2_time'] = $key->exam2_time == null ? "" : $key->exam2_time;
                    $logArray['exam3_time'] = $key->exam3_time == null ? "" : $key->exam3_time;
                    $logArray['remark'] = $key->remark == null ? "" : $key->remark;
                    $logArray['read_status'] = $key->read_status == null ? "" : $key->read_status;
                    $logArray['read_status1'] = $key->read_status1 == null ? "" : $key->read_status1;
                    $logArray['read_status2'] = $key->read_status2 == null ? "" : $key->read_status2;
                    $materialsArray[] = $logArray;
                    $a++;
                    if ($a == 10) {
                        break;
                    }
                }
            }
            $status = "Success";
            $array = DB::table('daily_naz_updates')
                ->where('student_id', $request->get('student_id'))
                ->where('arabic_date', $request['date'])
                ->get()->take(1);
            if (sizeof($array) < 1) {
                $array[]   =   array(
                    "id" => "",
                    "arabic_date" => "",
                    "day" => "",
                    "old_exam" => "",
                    "exam_1" => "",
                    "exam_1a" => "",
                    "exam_2" => "",
                    "remark_1" => "",
                    "remark_2" => "",
                    "remark_3" => "",
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
            if (isset($materialsArray) && sizeof($materialsArray) > 0) {
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
    ///
    public function listhifz(Request $request)
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
            $check = DB::table('hifz_updates')
                ->where("student_id", '=', $request->get('student_id'))
                ->orderBy('arabic_date', 'DESC')
                ->get();
            $a = 1;
            $exp_date = explode("/", $today);
            $req_date = $exp_date[2] . $exp_date[1] . $exp_date[0];
            foreach ($check as $key) {
                $exp_date1 = explode("/", $key->arabic_date == null ? "" : $key->arabic_date);
                $req_date1 = $exp_date1[2] . $exp_date1[1] . $exp_date1[0];
                if ((int)$req_date > (int)$req_date1) {
                    $logArray = array();
                    $logArray['id'] = $key->id;
                    $logArray['arabic_date'] = $key->arabic_date;
                    $logArray['exam_1'] = $key->exam_1 == null ? "" : $key->exam_1;
                    $logArray['exam_1a'] = $key->exam_1a == null ? "" : $key->exam_1a;
                    $logArray['exam_2'] = $key->exam_2 == null ? "" : $key->exam_2;
                    $logArray['exam_2a'] = $key->exam_2a == null ? "" : $key->exam_2a;
                    $logArray['exam_3'] = $key->exam_3 == null ? "" : $key->exam_3;
                    $logArray['exam_3a'] = $key->exam_3a == null ? "" : $key->exam_3a;
                    $logArray['exam1_time'] = $key->exam1_time == null ? "" : $key->exam1_time;
                    $logArray['exam2_time'] = $key->exam2_time == null ? "" : $key->exam2_time;
                    $logArray['exam3_time'] = $key->exam3_time == null ? "" : $key->exam3_time;
                    $logArray['remark'] = $key->remark == null ? "" : $key->remark;
                    $logArray['read_status'] = $key->read_status == null ? "" : $key->read_status;
                    $logArray['read_status1'] = $key->read_status1 == null ? "" : $key->read_status1;
                    $logArray['read_status2'] = $key->read_status2 == null ? "" : $key->read_status2;
                    $materialsArray[] = $logArray;
                    $a++;
                    if ($a == 10) {
                        break;
                    }
                }
            }
            $status = "Success";
            $array = DB::table('hifz_updates')
                ->where('student_id', $request->get('student_id'))
                ->where('arabic_date', $request['date'])
                ->get()->take(1);
            if (sizeof($array) < 1) {
                $array[]   =   array(
                    "id" => "",
                    "arabic_date" => "",
                    "day" => "",
                    "old_exam" => "",
                    "exam_1" => "",
                    "exam_1a" => "",
                    "exam_2" => "",
                    "remark_1" => "",
                    "remark_2" => "",
                    "remark_3" => "",
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
            if (isset($materialsArray) && sizeof($materialsArray) > 0) {
                $message = "Suceessfully Hifz Update data listed";
                $status = "Success";
            } else {
                $message = "No Hifz Records Found";
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

            function fundstr($mystring, $word)
            {

                if (strpos($mystring, $word) !== false) {
                    return  true;
                } else {
                    return false;
                }
            }
            $check_naz = DB::table('daily_naz_updates')
                ->where("student_id", '=', $request->get('student_id'))
                ->get();
            $condition = false;



            if (sizeof($check_naz) >= 0) {

                $e_1 = $request->get('exam_1') == '' ? '0-0' : $request->get('exam_1');
                $e_2 = $request->get('exam_1a') == '' ? '0-0' : $request->get('exam_1a');
                $e_3 =  $request->get('exam_2') == '' ? '0-0' : $request->get('exam_2');
                $e_4 =  $request->get('exam_2a') == '' ? '0-0' : $request->get('exam_2a');
                $e_5 =  $request->get('exam_3') == '' ? '0-0' : $request->get('exam_3');
                $e_6 =  $request->get('exam_3a') == '' ? '0-0' : $request->get('exam_3a');
                if (
                    fundstr($e_1, "0-") &&
                    fundstr($e_2, "0-") &&
                    fundstr($e_3, "0-") &&
                    fundstr($e_4, "0-") &&
                    fundstr($e_5, "0-") &&
                    fundstr($e_6, "0-")
                ) {
                    $condition = true;
                } else {
                    $condition = false;
                }
            }

            foreach ($check_naz as $data) {
                if ($data->exam_1a == '0-Completed' || $data->exam_2a == '0-Completed' || $data->exam_3a == '0-Completed') {
                    $condition = true;
                    break;
                }
            }


            // return $condition;

            if ($condition == false) {
                return response()->json([
                    'status' => "Failure",
                    'message' => "First Complete taqthi ka qaeeda",
                    'response' => 422,
                ]);
            } elseif ($condition = true) {
                $check = DB::table('daily_naz_updates')
                    ->where("student_id", '=', $request->get('student_id'))
                    ->where("course_id", '=', $request->get('course_id'))
                    ->get();
                $date = $request->arabic_date;
                $key = array();
                foreach ($check as $data) {
                    $key[] = !empty(explode('-', $data->exam_1)[1]) ? explode('-', $data->exam_1)[1] : null;
                    $key[] = !empty(explode('-', $data->exam_1a)[1]) ? explode('-', $data->exam_1a)[1] : null;
                    $key[] = !empty(explode('-', $data->exam_2)[1]) ? explode('-', $data->exam_2)[1] : null;
                    $key[] = !empty(explode('-', $data->exam_2a)[1]) ? explode('-', $data->exam_2a)[1] : null;
                    $key[] = !empty(explode('-', $data->exam_3)[1]) ? explode('-', $data->exam_3)[1] : null;
                    $key[] = !empty(explode('-', $data->exam_3a)[1]) ? explode('-', $data->exam_3a)[1] : null;
                }
                $value = array();
                foreach ($check as $data) {
                    $value[] = explode('-', $data->exam_1)[0] == "0" ? "0" : explode('-', $data->exam_1)[0];
                    $value[] = explode('-', $data->exam_1a)[0] == "0" ? "0" : explode('-', $data->exam_1a)[0];
                    $value[] = explode('-', $data->exam_2)[0] == "0" ? "0" : explode('-', $data->exam_2)[0];
                    $value[] = explode('-', $data->exam_2a)[0] == "0" ? "0" : explode('-', $data->exam_2a)[0];
                    $value[] = explode('-', $data->exam_3)[0] == "0" ? "0" : explode('-', $data->exam_3)[0];
                    $value[] = explode('-', $data->exam_3a)[0] == "0" ? "0" : explode('-', $data->exam_3a)[0];
                }
                $Array = DB::table('daily_naz_updates')
                    ->where('arabic_date', '=', $date)
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
                    $update->exam1_time = $request->get('exam1_time');
                    $update->exam2_time = $request->get('exam2_time');
                    $update->exam3_time = $request->get('exam3_time');
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
                    if (!empty($request->get('exam_1')) || !empty($request->get('exam_1a'))) {
                        DB::table("attendances")
                            ->insert(
                                array(
                                    "date" =>  $request->get('arabic_date'),
                                    "student_id" => $request["student_id"],
                                    // "teacher_id" => $request["teacher_id"],
                                    "remark" => $request["remark"],
                                    "session_1" => "1",
                                    "status_1" => "1",
                                )
                            );
                    }
                    if (!empty($request->get('exam_2')) || !empty($request->get('exam_2a'))) {
                        DB::table("attendances")
                            ->insert(
                                array(
                                    "date" => $request->get('arabic_date'),
                                    "student_id" => $request["student_id"],
                                    // "teacher_id" => $request["teacher_id"],
                                    "remark" => $request["remark"],
                                    "session_2" => "2",
                                    "status_2" => "1",
                                )
                            );
                    }
                    if (!empty($request->get('exam_3')) || !empty($request->get('exam_3a'))) {
                        DB::table("attendances")
                            ->insert(
                                array(
                                    "date" => $request->get('arabic_date'),
                                    "student_id" => $request["student_id"],
                                    // "teacher_id" => $request["teacher_id"],
                                    "remark" => $request["remark"],
                                    "session_3" => "3",
                                    "status_3" => "1",
                                )
                            );
                    }
                }
                if ($update) {
                    $message = "Suceessfully Daily Nazira Update data added";
                    $status = "Success";
                } else {
                    $message = "Nazira Record Already Submitted";
                    $status = "Failure";
                }
                return response()->json([
                    'status' => $status,
                    'message' => $message,
                ]);
            }
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

            function fundstr($mystring, $word)
            {
                if (strpos($mystring, $word) !== false) {
                    return  true;
                } else {
                    return false;
                }
            }

            $check_naz = DB::table('daily_naz_updates')
                ->where("student_id", '=', $request->get('student_id'))
                ->get();

            //   return $check_naz;

            $condition = true;



            foreach ($check_naz as $data) {
                if ($data->exam_1a == '0-28' || $data->exam_2a == '0-28' || $data->exam_3a == '0-28') {

                    $condition = false;
                    break;
                }
            }




            if ($condition) {

                $e_1 =  $request->get('exam_1') == '' ? '0-0' : $request->get('exam_1');
                $e_2 =  $request->get('exam_1a') == '' ? '0-0' : $request->get('exam_1a');
                $e_3 =  $request->get('exam_2') == '' ? '0-0' : $request->get('exam_2');
                $e_4 =  $request->get('exam_2a') == '' ? '0-0' : $request->get('exam_2a');
                $e_5 =  $request->get('exam_3') == '' ? '0-0' : $request->get('exam_3');
                $e_6 =  $request->get('exam_3a') == '' ? '0-0' : $request->get('exam_3a');

                if (
                    fundstr($e_1, "1-") &&
                    fundstr($e_2, "1-") &&
                    fundstr($e_3, "1-") &&
                    fundstr($e_4, "1-") &&
                    fundstr($e_5, "1-") &&
                    fundstr($e_6, "1-")
                ) {
                    $condition = true;
                } else {
                    $condition = false;
                }
            }



            if ($condition) {

                return response()->json([
                    'status' => "Failure",
                    'message' => "First Complete taqthi ka qaeeda",
                    'response' => 422,
                ]);
            } else {


                $input = collect(request()->all())->filter()->all();

                // return $input;
                // $update = Daily_naz_update::where('id', $request->get('id'))->update($input);

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
                $update->remark_1 = $request->get('remark_1');
                $update->remark_2 = $request->get('remark_2');
                $update->remark_3 = $request->get('remark_3');
                $update->exam1_time = $request->get('exam1_time');
                $update->exam2_time = $request->get('exam2_time');
                $update->exam3_time = $request->get('exam3_time');
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

                if (!empty($request->get('exam_1')) || !empty($request->get('exam_1a'))) {
                    DB::table("attendances")
                        ->where('date', $request->get('arabic_date'))
                        ->update(
                            array(
                                "date" =>  $request->get('arabic_date'),
                                "student_id" => $request["student_id"],
                                // "teacher_id" => $request["teacher_id"],
                                "remark" => $request["remark"],
                                "session_1" => "1",
                                "status_1" => "1",
                            )
                        );
                }
                if (!empty($request->get('exam_2')) || !empty($request->get('exam_2a'))) {
                    DB::table("attendances")
                        ->where('date', $request->get('arabic_date'))
                        ->update(
                            array(
                                "date" => $request->get('arabic_date'),
                                "student_id" => $request["student_id"],
                                // "teacher_id" => $request["teacher_id"],
                                "remark" => $request["remark"],
                                "session_2" => "2",
                                "status_2" => "1",
                            )
                        );
                }
                if (!empty($request->get('exam_3')) || !empty($request->get('exam_3a'))) {
                    DB::table("attendances")
                        ->where('date', $request->get('arabic_date'))
                        ->update(
                            array(
                                "date" => $request->get('arabic_date'),
                                "student_id" => $request["student_id"],
                                // "teacher_id" => $request["teacher_id"],
                                "remark" => $request["remark"],
                                "session_3" => "3",
                                "status_3" => "1",
                            )
                        );
                }
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
    }
    /////////////////////////////check previeas old Exam ////////////////////////////////////
    public function naz_exam(Request $request)
    {
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
                ->orderBy('created_at', 'DESC')->get()->take(1);
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
                    "exam1_time" => "",
                    "exam2_time" => "",
                    "exam3_time" => "",
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
    /////////
    /////////////////////////////
    public function hifzlist(Request $request)
    {
        $rules = array(
            "student_id" => "required",
            "course_id" => "required",
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
                    "exam1_time" => "",
                    "exam2_time" => "",
                    "exam3_time" => "",
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
                $update->exam1_time = $request->get('exam1_time');
                $update->exam2_time = $request->get('exam2_time');
                $update->exam3_time = $request->get('exam3_time');
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
            ->where('pre_ends.status', '=', '0')
            ->select('pre_ends.id', 'pre_ends.type', 'pre_ends.student_id', 'pre_ends.target', 'pre_ends.course_id', 'students.name', 'pre_ends.remark', 'date', 'pre_ends.status')
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
            $logArray['type'] = $key->type;
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
            "target" => "required",
            "type" => "required",
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {



            $check_office_para = DB::table('pre_ends')
                ->where("student_id",  $request->student_id)
                ->where('status', 0)
                ->first();
            if (!empty($check_office_para)) {
                return response()->json([
                    'status' => "Failure",
                    'message' => "First Complete Hold Para",
                    'response' => 422,
                ]);
            }


            $update = new Pre_end();
            $update->student_id = $request->get('student_id');
            $update->teacher_id = $request->get('teacher_id');
            $update->date = $request->get('date');
            $update->target = $request->get('target');
            $update->course_id = $request->get('course_id');
            $update->remark = $request->get('remark');
            $update->type = $request->get('type');
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
            "id" => "required",
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
                    ->where('pre_ends.id', '=', $request['id'])
                    ->first();
                // return $pre;

                $value1 = explode("-", $pre->target)[0];
                $value2 = explode("-", $pre->target)[1];
                if ($value1 == 0) {
                    $con = false;
                } else {
                    $con = true;
                }
                if ($value2 == 7) {
                    $con1 = true;
                } else {
                    $con1 = false;
                }
                if ($con && $con1) {
                    $add_stur = new Structure();
                    $add_stur->para_id = $value1;
                    $add_stur->teacher_id = $pre->teacher_id;
                    $add_stur->student_id = $pre->student_id;
                    $add_stur->arabic_date = $pre->date;
                    $add_stur->course_id = $pre->course_id;
                    $add_stur->save();
                }
                $num = Carbon::createFromFormat('d/m/Y', $pre->date)->format('m');
                $num = ltrim($num, '0');
                $assign = DB::table("syllabus_adds")
                    ->where("syllabus_adds.student_id", $pre->student_id)
                    ->where("syllabus_adds.month", $num)
                    ->where('syllabus_adds.course_id', $pre->course_id)
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
                    if ($value1 == 0 || $value2 == 7) {
                        $add = DB::table("syllabus_adds")
                            ->where('id', $assign->id)
                            ->update([
                                'c_target' => $data . "" . explode('-', $pre->target)[1]
                            ]);
                        if (!empty($add)) {
                            $update = true;
                        }
                    }
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



        function findupcomingpara($sid)
        {
            $check_naz = DB::table('daily_naz_updates')
                ->where("student_id", '=', $sid)
                ->get();
            $condition = false;
            if (sizeof($check_naz) <= 0) {
                $condition = 7;
            } else {
                $condition = false;
            }
            foreach ($check_naz as $data) {
                if ($data->exam_1a == '0-28' || $data->exam_2a == '0-28' || $data->exam_3a == '0-28') {
                    $condition = true;
                    break;
                }
            }

            if ($condition == 7) {
                return "";
            } else if ($condition == false) {
                return 0;
            } else {
                return 1;
            }
        }



        function findObjectById1($array, $id)
        {
            // print_r($id);
            for ($i = 0; $i < sizeof($array); $i++) {
                if ($array[$i]["paraid"] == $id) {
                    return $array[$i + 1];
                }
            }
            return false;
        }

        function findlastpara1($data, $id)
        {

            // print_r($id);


            $globel = array();
            // $value = array();

            foreach ($data as $key) {
                if (str_contains($key->no_of_parah, 'Parah')) {

                    $arr = explode(",", $key->target);
                    $p = student_based_para::whereIn('student_based_paras.id', $arr)
                        ->join('paras', 'paras.id', '=', 'student_based_paras.para_order')
                        ->select('para_name', 'paras.id')->get();

                    foreach ($p as $a) {
                        $value = array();
                        $value["paraname"] = $a->para_name;
                        $value["paraid"] = $a->id;
                        $globel[] = $value;
                    }
                }
            }

            // print_r($globel);
            return findObjectById1($globel, $id);
        }
        $status = $request->status;
        $status = $request->status;
        $course_id = $request->course_id;

        if ($status == 2) {
            $paras = DB::table('teachers')
                ->join("students", "students.id", "=", "teachers.student_id")
                ->join("syllabus_types", "syllabus_types.id", '=', 'students.course_id')
                ->where('teachers.teacher_id', '=', $request->get('teacher_id'))
                ->where('students.course_id', 2)
                ->select('students.id', 'students.name', 'students.course_id', 'students.admission_no', 'students.address', 'syllabus_types.year as year')
                ->get();
        } else if ($status == 1) {

            $paras = DB::table('teachers')
                ->join("students", "students.id", "=", "teachers.student_id")
                ->join("syllabus_types", "syllabus_types.id", '=', 'students.course_id')
                ->where('teachers.teacher_id', '=', $request->get('teacher_id'))
                ->where('students.course_id', 1)
                ->select('students.id', 'students.name', 'students.course_id', 'students.admission_no', 'students.address', 'syllabus_types.year as year')
                ->get();
        } else {
            $paras = DB::table('teachers')
                ->join("students", "students.id", "=", "teachers.student_id")
                ->join("syllabus_types", "syllabus_types.id", '=', 'students.course_id')
                ->where('teachers.teacher_id', '=', $request->get('teacher_id'))
                ->select('students.id', 'students.name', 'students.course_id', 'students.admission_no', 'students.address', 'syllabus_types.year as year')
                ->get();
        }
        foreach ($paras as $key) {
            $logArray = array();
            $logArray['id'] = $key->id;
            $logArray['name'] = $key->name;
            $logArray['course_id'] = $key->course_id;
            $logArray['year_id'] = $key->year;
            $logArray['admission_no'] = $key->admission_no;
            $logArray['address'] = $key->address;
            $city = explode(",", $key->address)[0];
            $logArray['city'] = $city;
            $pr_para = DB::table('pre_ends')
                ->where('pre_ends.student_id', $key->id)
                ->where('pre_ends.status', 1)
                ->orwhere('pre_ends.status', 2)
                ->select('*')
                ->orderByDesc('pre_ends.id')
                ->first();
            $previous =  DB::table('syllabus_adds')
                ->where('student_id', $key->id)
                ->select('target', 'no_of_parah')
                ->get();
            $mansooq = DB::table('pre_ends')
                ->where('pre_ends.student_id', $key->id)
                ->where('pre_ends.status', 3)
                ->select('*')
                ->first();
            if (!empty($mansooq)) {

                $logArray['previous_para_id'] = !empty($pr_para) ? $pr_para->target : 0;
                $logArray['office_para_status'] = $mansooq->status;
                $logArray['mansooq_para'] =   $mansooq->target;
            } elseif (!empty($pr_para)) {
                $check_para = findlastpara1($previous, $pr_para->target);
                // return $previous;
                $predel = !empty($pr_para) ? $pr_para->target : 0;
                $logArray['previous_para_id'] =  !empty($pr_para) ? $pr_para->target : 0;
                $logArray['office_para_status'] =  !empty($pr_para) ? $pr_para->status : 0;
                if (!empty($check_para)) {
                    $logArray['upcoming_para_id'] =  $check_para["paraid"];
                } else if (strpos($predel, "0-") !== false) {
                    $logArray['upcoming_para_id'] =   '1';
                } else {
                    $logArray['upcoming_para_id'] =    '0';
                }
            } else {

                $logArray['previous_para_id'] = "0";
                $logArray['office_para_status'] = "0";
                $upcoming_para_id = !empty(findupcomingpara($key->id)) ? findupcomingpara($key->id) : "0";
                $logArray['upcoming_para_id'] =   $upcoming_para_id;
            }
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

    public function attendenceremark(Request $request)
    {
        $rules = array(
            "remark" => "required",
            "from" => "required",
            "to" => "required",
            "student_id" => "required|exists:students,id",
            "teacher_id" => "required",
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {

            $date_start = $list['start-date'] = Carbon::createFromFormat('d/m/Y', $request['from'])->format('d-m-Y');
            $date_end = $list['end-date'] = Carbon::createFromFormat('d/m/Y', $request['to'])->format('d-m-Y');
            $period = CarbonPeriod::create($date_start, $date_end);
            if ($request["session"] == 0) {
                foreach ($period as $date) {
                    $insert = DB::table("attendances")
                        ->insert(
                            array(
                                "date" =>  $date->format('d/m/Y'),
                                "student_id" => $request["student_id"],
                                // "teacher_id" => $request["teacher_id"],
                                "remark" => $request["remark"],
                                "status_1" => "2",
                                "status_2" => "2",
                                "status_3" => "2",
                            )
                        );
                }

                foreach ($period as $date) {
                    $insert = DB::table("daily_naz_updates")
                        ->insert(
                            array(
                                "arabic_date" =>  $date->format('d/m/Y'),
                                "month" =>  $date->format('m'),
                                "student_id" => $request["student_id"],
                                "teacher_id" => $request["teacher_id"],
                                "remark" => $request["remark"],
                            )
                        );
                }
            } else {
                foreach ($period as $date) {
                    $insert = DB::table("attendances")
                        ->insert(
                            array(
                                "date" =>  $date->format('d/m/Y'),
                                "student_id" => $request["student_id"],
                                // "teacher_id" => $request["teacher_id"],
                                "remark" => $request["remark"],
                                "status_1" =>  $request["status_1"],
                                "status_2" =>  $request["status_2"],
                                "status_3" =>  $request["status_3"],
                                "session_1" => $request["session_1"],
                                "session_2" => $request["session_2"],
                                "session_3" => $request["session_3"],
                            )
                        );
                }
            }
            if ($insert) {
                return response()->json([
                    'status' => "Success",
                    'message' => "Suceessfully Remark Added"
                ]);
            } else {
                return response()->json([
                    'status' => "Failure",
                    'message' => "Check Date Error"
                ]);
            }
        }
    }
    public function editnaz(Request $request)
    {
        $rules = array(
            "student_id" => "required",
            "date" => "required",
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $list = DB::table('daily_naz_updates')
                ->where('student_id', $request->get('student_id'))
                ->where('arabic_date', $request->get('date'))
                ->orderBy('arabic_date', 'desc')
                ->select(
                    'arabic_date',
                    'old_exam',
                    'exam1_time',
                    'exam2_time',
                    'exam3_time',
                    'old_exam',
                    'course_id',
                    'exam_1',
                    'exam_1a',
                    'exam_2',
                    'exam_2a',
                    'exam_3',
                    'exam_3a',
                    'remark'
                )
                ->first();
            if ($list) {
                return response()->json([
                    'status' => "Success",
                    'data' => $list
                ]);
            } else {
                return response()->json([
                    'status' => "Failure",
                    'data' => "failure"
                ]);
            }
        }
    }
    public function deletenaz(Request $request)
    {
        $rules = array(
            "student_id" => "required",
            "date" => "required",
            "remark" => "required"
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $list = DB::table('daily_naz_updates')
                ->where('student_id', $request->get('student_id'))
                ->where('arabic_date', $request->get('date'))
                ->delete();
            $check = DB::table("attendances")
                ->where("student_id", '=', $request->get('student_id'))
                ->where("date", '=', $request->get('date'))
                ->first();
            if (!empty($check)) {
                $user = Attendance::find($check->id);
                $user->remark = $request['remark'];
                $user->save();
            } else {
                $user = new Attendance();
                $user->remark = $request['remark'];
                $user->save();
            }
            if ($list) {
                return response()->json([
                    'status' => "Success",
                    'message' => "deleted"
                ]);
            } else {
                return response()->json([
                    'status' => "Failure",
                    'message' => "failure"
                ]);
            }
        }
    }
    //durai
    public function updateattendance(Request $request)
    {
        $rules = array(
            "date" => "required",
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
            $check = DB::table('attendances')
                ->where('date', $request['date'])
                ->where('student_id', $request['student_id'])
                ->where('teacher_id', $request['teacher_id'])
                ->first();
            // return $check;
            $inq =  DB::table("daily_naz_updates")
                ->where("student_id",  $request->get('student_id'))
                ->where("arabic_date", $request["date"])
                ->first();
            // return $inq;
            $update = Daily_naz_update::find($inq->id);
            if (!empty($request['session_1'])) {
                $update->exam_1 = $request->get('remark_1');
                $update->exam_1a = $request->get('remark_1');
            }
            if (!empty($request['session_2'])) {
                $update->exam_2 = $request->get('remark_2');
                $update->exam_2a = $request->get('remark_2');
            }
            if (!empty($request['session_3'])) {
                $update->exam_3 = $request->get('remark_3');
                $update->exam_3a = $request->get('remark_3');
            }
            $update->save();

            $user = Attendance::find($check->id);
            $user->student_id = $request['student_id'];
            $user->date = $request['date'];
            // $user->date = $request['teacher_id'];
            if (!empty($request['session_1'])) {
                $user->session_1 = empty($request['session_1']) ? "0" : $request['session_1'];
                $user->status_1 = empty($request['status_1']) ? "0" : $request['status_1'];
            }
            if (!empty($request['session_2'])) {
                $user->session_2 = empty($request['session_2']) ? "0" : $request['session_2'];
                $user->status_2 = empty($request['status_2']) ? "0" : $request['status_2'];
            }
            if (!empty($request['session_3'])) {
                $user->session_3 = empty($request['session_3']) ? "0" : $request['session_3'];
                $user->status_3 = empty($request['status_3']) ? "0" : $request['status_3'];
            }
            $user->remark = $request['remark'];
            $user->save();
            if ($user) {
                return response()->json([
                    'status' => "Success",
                    'message' => "Suceessfully Added"
                ]);
            } else {
                return response()->json([
                    'status' => "Failure",
                    'message' => "Check Data"
                ]);
            }
        }
    }
    public function list_daily_update(Request $request)
    {
        $rules = array(
            "date" => "required",
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
            $list = DB::table('daily_naz_updates')
                ->where('student_id', $request->get('student_id'))
                ->join('syllabus_types', 'syllabus_types.id', '=', 'daily_naz_updates.course_id')
                ->orderBy('arabic_date', 'desc')
                ->select(
                    'arabic_date',
                    'syllabus_types.title as course',
                    'old_exam',
                    'exam1_time',
                    'exam2_time',
                    'exam3_time',
                    'course_id',
                    'exam_1',
                    'exam_1a',
                    'exam_2',
                    'exam_2a',
                    'exam_3',
                    'exam_3a',
                    'remark'
                )
                ->get();
            $students = DB::table('students')
                ->join('syllabus_types', 'syllabus_types.id', '=', 'students.course_id')
                ->where('students.id', $request['student_id'])
                ->select('students.id as student_id', 'syllabus_types.title as course_name', 'name', 'course_id', 'Admission_date')
                ->first();
            $a = 1;
            $exp_date = explode("/", $request->date);
            $req_date = $exp_date[2] . $exp_date[1] . $exp_date[0];
            foreach ($list as $key) {
                $exp_date1 = explode("/", $key->arabic_date == null ? "" : $key->arabic_date);

                $req_date1 = $exp_date1[2] . $exp_date1[1] . $exp_date1[0];
                if ((int)$req_date >= (int)$req_date1) {
                    $logArray = array();
                    $logArray['arabic_date'] = $key->arabic_date == null ? "" : $key->arabic_date;
                    $date_end = Carbon::createFromFormat('d/m/Y', $key->arabic_date)->format('Y-m-d');
                    $logArray['day'] = date('l', strtotime($date_end));
                    $logArray['course_name'] = $key->course;
                    $logArray['old_exam'] = $key->old_exam;
                    $logArray['course_id'] = $key->course_id;
                    $logArray['exam_1'] = $key->exam_1 == null ? "" : $key->exam_1;
                    $logArray['exam_1a'] = $key->exam_1a == null ? "" : $key->exam_1a;
                    $logArray['exam_2'] = $key->exam_2 == null ? "" : $key->exam_2;
                    $logArray['exam_2a'] = $key->exam_2a == null ? "" : $key->exam_2a;
                    $logArray['exam_3'] = $key->exam_3 == null ? "" : $key->exam_3;
                    $logArray['exam_3a'] = $key->exam_3a == null ? "" : $key->exam_3a;
                    $logArray['exam1_time'] = $key->exam1_time == null ? "" : $key->exam1_time;
                    $logArray['exam2_time'] = $key->exam2_time == null ? "" : $key->exam2_time;
                    $logArray['exam3_time'] = $key->exam3_time == null ? "" : $key->exam3_time;
                    $logArray['remark'] = $key->remark == null ? "" : $key->remark;
                    $materialsArray[] = $logArray;
                    $a++;
                    if ($a == 10) {
                        break;
                    }
                }
            }
            return response()->json([
                'status' => "success",
                'user_data' => $students,
                'data' => isset($materialsArray) ? $materialsArray : [],
                'response' => 200,
            ]);
        }
    }
    public function attendence(Request $request)
    {
        $rules = array(
            "date" => "required",
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
                ->where("date", '=', $request->get('date'))
                ->first();
            $month = explode("/", $request["date"])[1];
            $check1 = DB::table("students")
                ->where("id", '=', $request->get('student_id'))
                ->first();
            if ($check1->course_id == 1) {
                $inq =  DB::table("daily_naz_updates")
                    ->where("student_id",  $request->get('student_id'))
                    ->where("arabic_date", $request["date"])
                    ->first();
                if ($inq == false) {
                    $update = new Daily_naz_update;
                    $update->arabic_date = $request->get('date');
                    $update->student_id = $request->get('student_id');
                    $update->month = $month;
                    if (!empty($request['session_1'])) {
                        $update->exam_1 = $request->get('remark_1');
                        $update->exam_1a = $request->get('remark_1');
                    }
                    if (!empty($request['session_2'])) {
                        $update->exam_2 = $request->get('remark_2');
                        $update->exam_2a = $request->get('remark_2');
                    }
                    if (!empty($request['session_3'])) {
                        $update->exam_3 = $request->get('remark_3');
                        $update->exam_3a = $request->get('remark_3');
                    }
                    $update->save();
                } else {
                    $update = Daily_naz_update::find($inq->id);
                    $update->arabic_date = $request->get('date');
                    $update->student_id = $request->get('student_id');
                    $update->month = $month;
                    if (!empty($request['session_1'])) {
                        $update->exam_1 = $request->get('remark_1');
                        $update->exam_1a = $request->get('remark_1');
                    }
                    if (!empty($request['session_2'])) {
                        $update->exam_2 = $request->get('remark_2');
                        $update->exam_2a = $request->get('remark_2');
                    }
                    if (!empty($request['session_3'])) {
                        $update->exam_3 = $request->get('remark_3');
                        $update->exam_3a = $request->get('remark_3');
                    }
                    $update->save();
                }
            }
            if (!empty($check)) {
                $user = Attendance::find($check->id);
                $user->student_id = $request['student_id'];
                $user->date = $request['date'];
                if (!empty($request['session_1'])) {
                    $user->session_1 = empty($request['session_1']) ? "0" : $request['session_1'];
                    $user->status_1 = empty($request['status_1']) ? "0" : $request['status_1'];
                }
                if (!empty($request['session_2'])) {
                    $user->session_2 = empty($request['session_2']) ? "0" : $request['session_2'];
                    $user->status_2 = empty($request['status_2']) ? "0" : $request['status_2'];
                }
                if (!empty($request['session_3'])) {
                    $user->session_3 = empty($request['session_3']) ? "0" : $request['session_3'];
                    $user->status_3 = empty($request['status_3']) ? "0" : $request['status_3'];
                }
                $user->remark = $request['remark_1'];
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
                $user = new Attendance();
                $user->student_id = $request['student_id'];
                $user->date = $request['date'];
                if (!empty($request['session_1'])) {
                    $user->session_1 = empty($request['session_1']) ? "0" : $request['session_1'];
                    $user->status_1 = empty($request['status_1']) ? "0" : $request['status_1'];
                }
                if (!empty($request['session_2'])) {
                    $user->session_2 = empty($request['session_2']) ? "0" : $request['session_2'];
                    $user->status_2 = empty($request['status_2']) ? "0" : $request['status_2'];
                }
                if (!empty($request['session_3'])) {
                    $user->session_3 = empty($request['session_3']) ? "0" : $request['session_3'];
                    $user->status_3 = empty($request['status_3']) ? "0" : $request['status_3'];
                }
                $user->remark = $request['remark'];
                $user->save();
                if ($user) {
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
        // $rules = array(
        //     "from_date" => "required",
        //     "student_id" => "required|exists:attendances,student_id"
        // );
        // $validator = Validator::make($request->all(), $rules);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => "Failure",
        //         'message' => $validator->errors()->first(),
        //         'response' => 422,
        //     ]);
        // } else {
        $from = DB::table('attendances')
            ->where('date', $request->from_date)
            ->first();
        // return $from;
        $to = DB::table('attendances')
            ->where('date', $request->to_date)
            ->first();
        // return $to;
        if (!empty($to) && !empty($from)) {
            $list = DB::table('attendances')
                ->where('student_id', '=', $request->student_id)
                ->whereBetween('id', [$from->id, $to->id])
                ->get();
            // return $list;
        } else {
            $from = $request->from_date;
            $month =  explode("/", $from)[1];
            $list = DB::table('attendances')
                ->where('student_id', '=', $request->student_id)
                ->get();
            foreach ($list as $key) {
                if (explode("/", $key->date)[1]  == $month) {
                    $logArray = array();
                    $logArray['id'] = $key->id;
                    $logArray["student_id"] =  $key->student_id;
                    $logArray["teacher_id"] = $key->teacher_id;
                    $logArray["date"] = $key->date;
                    $logArray["remark"] = $key->remark;
                    $logArray["status_1"] =  $key->status_1;
                    $logArray["session_1"] =  $key->session_1;
                    $logArray["session_2"] =  $key->session_2;
                    $logArray["session_3"] = $key->session_3;
                    $logArray["status_2"] =  $key->status_2;
                    $logArray["status_3"] =  $key->status_3;
                    $materialsArray[] = $logArray;
                }
            }
            $list =  $materialsArray;
        }
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
    // }
    public function listsickdetail(Request $request)
    {
        $rules = array(
            "patient_id" => "required",
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $sick_leave = DB::table('sick_leave_details')
                ->join('patients_list', 'patients_list.id', 'sick_leave_details.patient_id')
                ->join('students', 'students.id', 'patients_list.student_id')
                ->join('users', 'users.id', 'sick_leave_details.teacher_id')
                ->where('sick_leave_details.patient_id', $request->patient_id)
                ->select('sick_leave_details.*', 'students.name as student_name', 'users.full_name as teacher_name',)
                ->get();
            //print_r($sick_leave);
            if (sizeof($sick_leave) > 0) {
                $message = "Suceessfully student Data are listed";
                $status = "Success";
            } else {
                $message = "No student Records Found";
                $status = "Success";
                $sick_leave = [];
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $sick_leave
            ]);
        }
    }
    public function addsickdetail(Request $request)
    {
        $rules = array(
            // "id" => "required",
            "patient_id" => "required",
            "date" => "required",
            "session" => "required",
            "teacher_id" => "required",
            //    "food_1"=> "required",
            //    "medicine_1"=> "required",
            //    "description_1" => "required",
            //    "food_2" => "required",
            //    "medicine_2" => "required",
            //    "description_2"=> "required",
            //    "food_3"=> "required",
            //    "medicine_3"=> "required",
            //    "description_3" => "required",
            //    "food_4"=> "required",
            //    "medicine_4" => "required",
            //    "description_4"=> "required",
            //    "leave" => "required",
        );
        $users = DB::table('sick_leave_details')
            ->where('date', $request->date)
            ->where('patient_id', $request->patient_id)
            ->first();
        $message = "";
        if (!empty($users)) {
            return response()->json([
                'status' => "failure",
                'message' => "Date already  exist",
            ]);
        }
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
                    "patient_id" =>  $request["patient_id"],
                    "date" => $request["date"],
                    "teacher_id" => $request["teacher_id"],
                    "session" => $request["session"],
                    "food_1" => $request["food_1"],
                    "medicine_1" => $request["medicine_1"],
                    "description_1" => $request["description_1"],
                    "medician_given_by1" => $request["medician_given_by1"],
                    "food_2" => $request["food_2"],
                    "medicine_2" => $request["medicine_2"],
                    "description_2" => $request["description_2"],
                    "medician_given_by2" => $request["medician_given_by2"],
                    "food_3" => $request["food_3"],
                    "medicine_3" => $request["medicine_3"],
                    "description_3" => $request["description_3"],
                    "medician_given_by3" => $request["medician_given_by3"],
                    "food_4" => $request["food_4"],
                    "medicine_4" => $request["medicine_4"],
                    "description_4" => $request["description_4"],
                    "medician_given_by4" => $request["medician_given_by4"],
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
    public function updatesickdetail(Request $request)
    {
        $data = DB::table("sick_leave_details")
            ->where('patient_id', $request->patient_id)
            ->update(array(
                "patient_id" =>  $request["patient_id"],
                "date" => $request["date"],
                "teacher_id" => $request["teacher_id"],
                "session" => $request["session"],
                "food_1" => $request["food_1"],
                "medicine_1" => $request["medicine_1"],
                "description_1" => $request["description_1"],
                "medician_given_by1" => $request["medician_given_by1"],
                "food_2" => $request["food_2"],
                "medicine_2" => $request["medicine_2"],
                "description_2" => $request["description_2"],
                "medician_given_by2" => $request["medician_given_by2"],
                "food_3" => $request["food_3"],
                "medicine_3" => $request["medicine_3"],
                "description_3" => $request["description_3"],
                "medician_given_by3" => $request["medician_given_by3"],
                "food_4" => $request["food_4"],
                "medicine_4" => $request["medicine_4"],
                "description_4" => $request["description_4"],
                "medician_given_by4" => $request["medician_given_by4"],
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
    public function destroysickdetail(Request $request)
    {
        $rules = array(
            "patient_id" => "required",
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
                ->where('patient_id', $request->patient_id)
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
    public function list(Request $request)
    {
        $sick_leave = DB::table('students')
            ->select('students.id', 'students.name')
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
                'data' => $sick_leave
            ]);
        }
    }
    public function listsickleave(Request $request)
    {
        // $sick = DB::table('patients_list')
        // ->get();
        $current_date = date("d/m/Y");

        $sick_leave = DB::table('patients_list')
            ->join('students', 'students.id', 'patients_list.student_id')
            ->where('patients_list.date', $current_date)
            ->where('patients_list.status', 1)
            ->select('patients_list.*', 'students.name as student_name', 'students.admission_no', 'students.address')
            ->orderBy('patients_list.status', 'ASC',)
            ->get();

        $sick_leave1 = DB::table('patients_list')
            ->join('students', 'students.id', 'patients_list.student_id')
            ->where('patients_list.status', 0)
            ->select('patients_list.*', 'students.name as student_name', 'students.admission_no', 'students.address')
            ->orderByDesc('patients_list.id',)
            ->get();

        $sick = array_merge((array)json_decode($sick_leave1), (array) json_decode($sick_leave));
        return response()->json([
            'status' => "success",
            'message' => "listed successfully",
            'data' => $sick

        ]);


        if (sizeof($sick_leave) > 0) {
            return response()->json([
                'status' => "success",
                'message' => "listed successfully",
                'data' => $sick
            ]);
        } else {
            return response()->json([
                'status' => "failure",
                'message' => "Empty data listed",
                'data' => []

            ]);
        }
    }


    // public function listsickleave(Request $request)
    // {
    //     $sick_leave = DB::table('patients_list')
    //         ->join('students', 'students.id', 'patients_list.student_id')
    //         ->select('patients_list.*', 'students.name as student_name','students.admission_no','students.address')
    //         ->orderByDesc('patients_list.status')
    //         ->get();
    //     // print_r($sick_leave);
    //     return response()->json([
    //         'status' => "success",
    //         'message' => "listed successfully",
    //         'data' => $sick_leave
    //     ]);
    //     if (sizeof($sick_leave) > 0) {
    //         return response()->json([
    //             'status' => "success",
    //             'message' => "listed successfully",
    //             'data' => $sick_leave
    //         ]);
    //     } else {
    //         return response()->json([
    //             'status' => "failure",
    //             'message' => "Empty data listed",
    //             'data' => $sick_leave
    //         ]);
    //     }
    // }
    public function createsickleave(Request $request)
    {
        $rules = array(
            "student_id" => "required",
            "disease" => "required",
            "date" => "required",
            "status" => "required",
            "session" => "required",
        );


        $pateint = DB::table('patients_list')
            ->where('student_id', $request->student_id)
            ->where('status', 0)
            ->first();
        $users = DB::table('patients_list')
            ->where('student_id', $request->student_id)
            ->where('date', $request->date)
            ->first();

        $message = "";
        if (!empty($users || $pateint)) {
            return response()->json([
                'status' => "failure",
                'message' => "Patient already  exist",
            ]);
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $created = DB::table("patients_list")
                ->insert(array(
                    "student_id" =>  $request["student_id"],
                    "disease" => $request["disease"],
                    "date" => $request["date"],
                    "status" => $request["status"],
                    "session" => $request["session"],
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
    public function updatesickleave(Request $request)
    {
        $data = DB::table("patients_list")
            ->where('id', $request->id)
            ->update(array(
                "student_id" =>  $request["student_id"],
                "disease" => $request["disease"],
                "date" => $request["date"],
                "status" => $request["status"],
                "session" => $request["session"],
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
    public function update_sickleave(Request $request)
    {
        $data = DB::table("patients_list")
            ->where('id', $request->id)
            ->update(array(
                "status" => 1,
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
    public function deletesickleave(Request $request)
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
            $deleted = DB::table('patients_list')
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
    public function listhifz_update(Request $request)
    {
        $rules = array(
            "student_id" => "required",
            "date" => "required",
        );
        $users = DB::table('hifz_daily_update')
            ->where('date', $request->date)
            ->where('student_id', $request->student_id)
            ->first();
        $message = "";
        if (empty($users)) {
            return response()->json([
                'status' => "failure",
                'message' => "Student not  exist",
            ]);
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            if (!empty($request->date)) {
                $hifz_update = DB::table('hifz_daily_update')
                    ->join('students', 'students.id', 'hifz_daily_update.student_id')
                    ->join('users', 'users.id', 'hifz_daily_update.teacher_id')
                    ->where('hifz_daily_update.student_id', $request->student_id)
                    ->where('hifz_daily_update.date', $request->date)
                    ->select('hifz_daily_update.*', 'students.name as student_name', 'users.full_name as teacher_name',)
                    ->get();
            } else {
                $hifz_update = DB::table('hifz_daily_update')
                    ->join('students', 'students.id', 'hifz_daily_update.student_id')
                    ->join('users', 'users.id', 'hifz_daily_update.teacher_id')
                    ->where('hifz_daily_update.student_id', $request->student_id)
                    ->select('hifz_daily_update.*', 'students.name as student_name', 'users.full_name as teacher_name',)
                    ->get();
            }
            //print_r($sick_leave);
            if (sizeof($hifz_update) > 0) {
                $message = "Suceessfully Hifz Data are listed";
                $status = "Success";
            } else {
                $message = "No Hifz Records Found";
                $status = "Success";
                $hifz_update = [];
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $hifz_update
            ]);
        }
    }
    public function addhifz_update(Request $request)
    {
        $rules = array(
            "student_id" => "required",
            "date" => "required",
            "arabic_date" => "required",
            //    "amuqtha" => "required",
            //    "amuqtha_ustad"=> "required",
            //    "a_remark"=> "required",
            //    "a_status" => "required",
            //    "a_mark" => "required",
            //    "end_parah" => "required",
            //    "end_paraha_ustad"=> "required",
            //    "e_remark"=> "required",
            //    "e_mark"=> "required",
            //    "e_status" => "required",
            //    "last_end_paraha"=> "required",
            //    "last_end_paraha_ustad" => "required",
            //    "le_remark"=> "required",
            //    "le_status" => "required",
            //   "le_mark"=> "required",
            //    "failed_parah" => "required",
            //    "failed_parah_ustad" => "required",
            //    "f_remark" => "required",
            //    "f_status"=> "required",
            //    "f_mark"=> "required",
            //    "sabaq_interactions" => "required",
            //    "sabaq_parah" => "required",
            //    "new_parah" => "required",
            //    "s_ramark"=> "required",
            "teacher_id" => "required",
        );
        $student = DB::table('students')
            ->where('id', $request->student_id)
            ->where('course_id', 2)
            ->first();



        $teacher = User::find($request->teacher_id);
        $date = DB::table('hifz_daily_update')
            ->where('student_id', $request->student_id)
            ->where('date', $request->date)
            ->first();

        if (!empty($date)) {
            return response()->json([
                'status' => "failure",
                'message' => "date already  exist",
            ]);
        }

        if (empty($student && $teacher)) {
            return response()->json([
                'status' => "failure",
                'message' => "Students or Teacher or Course does not  exist",
            ]);
        }
        // $validate=DB::table('hifz_daily_update')
        // ->join('students', 'students.id', 'hifz_daily_update.student_id')
        // ->where('students.course_id',0 ,)
        // ->where('date',$request->date)
        // // ->where('student_id',$request->student_id)
        // ->first();
        // if (empty($student && $teacher)) {
        //     return response()->json([
        //         'status' => "failure",
        //         'message' => "Students or Teacher does not  exist",]);
        // }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $created = DB::table("hifz_daily_update")
                ->insert(array(
                    "student_id" =>  $request["student_id"],
                    "date" => $request["date"],
                    "arabic_date" => $request["arabic_date"],
                    "amuqtha" => $request["amuqtha"],
                    "amuqtha_ustad" => $request["amuqtha_ustad"],
                    "a_remark" => $request["a_remark"],
                    "a_status" => $request["a_status"],
                    "a_mark" => $request["a_mark"],
                    "end_parah" => $request["end_parah"],
                    "end_paraha_ustad" => $request["end_paraha_ustad"],
                    "e_remark" => $request["e_remark"],
                    "e_mark" => $request["e_mark"],
                    "e_status" => $request["e_status"],
                    "last_end_paraha" => $request["last_end_paraha"],
                    "last_end_paraha_ustad" => $request["last_end_paraha_ustad"],
                    "le_remark" => $request["le_remark"],
                    "le_status" => $request["le_status"],
                    "le_mark" =>  $request["le_mark"],
                    "failed_parah" => $request["failed_parah"],
                    "failed_parah_ustad" => $request["failed_parah_ustad"],
                    "f_remark" => $request["f_remark"],
                    "f_status" => $request["f_status"],
                    "f_mark" => $request["f_mark"],
                    "sabaq_interactions" => $request["sabaq_interactions"],
                    "sabaq_parah" => $request["sabaq_parah"],
                    "new_parah" => $request["new_parah"],
                    "s_ramark" => $request["s_ramark"],
                    "teacher_id" => $request["teacher_id"],
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
    public function updatehifz_update(Request $request)
    {
        $data = DB::table("hifz_daily_update")
            ->where('student_id', $request->student_id)
            ->where('date', $request->date)
            ->update(array(
                "student_id" =>  $request["student_id"],
                "date" => $request["date"],
                "arabic_date" => $request["arabic_date"],
                "amuqtha" => $request["amuqtha"],
                "amuqtha_ustad" => $request["amuqtha_ustad"],
                "a_remark" => $request["a_remark"],
                "a_status" => $request["a_status"],
                "a_mark" => $request["a_mark"],
                "end_parah" => $request["end_parah"],
                "end_paraha_ustad" => $request["end_paraha_ustad"],
                "e_remark" => $request["e_remark"],
                "e_mark" => $request["e_mark"],
                "e_status" => $request["e_status"],
                "last_end_paraha" => $request["last_end_paraha"],
                "last_end_paraha_ustad" => $request["last_end_paraha_ustad"],
                "le_remark" => $request["le_remark"],
                "le_status" => $request["le_status"],
                "le_mark" =>  $request["le_mark"],
                "failed_parah" => $request["failed_parah"],
                "failed_parah_ustad" => $request["failed_parah_ustad"],
                "f_remark" => $request["f_remark"],
                "f_status" => $request["f_status"],
                "f_mark" => $request["f_mark"],
                "sabaq_interactions" => $request["sabaq_interactions"],
                "sabaq_parah" => $request["sabaq_parah"],
                "new_parah" => $request["new_parah"],
                "s_ramark" => $request["s_ramark"],
                "teacher_id" => $request["teacher_id"],
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
    public function destroyhifz_update(Request $request)
    {
        $rules = array(
            "student_id" => "required",
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $deleted = DB::table('hifz_daily_update')
                ->where('student_id', $request->student_id)
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
    //  "student_id": "1",
    //    "date" : "09-09-2022",
    //    "arabic_date" : "12/12/1443",
    // "hifz_id" : "3",
    // "mistake_on" : "1:2,2",
    // "course_id	": "2",
    // "mistake_id": "1",
    // "mark_detected" : "1:2,3",
    // "mark" : "30",
    // "remark" : "need more attention",
    //    "teacher_id": "1",
    public function listmistake_detail(Request $request)
    {
        $rules = array(
            "student_id" => "required",
            "course_id" => "required",
            // "hifz_id" => "required",
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $sick_leave = DB::table('mistake_details')
                ->join('students', 'students.id', 'mistake_details.student_id')
                ->join('users', 'users.id', 'mistake_details.teacher_id')
                ->join('syllabus_types', 'syllabus_types.id', 'mistake_details.course_id')
                ->join('hifz_daily_update', 'hifz_daily_update.id', 'mistake_details.hifz_id')
                ->where('mistake_details.student_id', $request->student_id)
                ->where('mistake_details.course_id', $request->course_id)
                ->select('mistake_details.*', 'students.name as student_name', 'users.full_name as teacher_name',)
                ->get();
            //print_r($sick_leave);
            if (sizeof($sick_leave) > 0) {
                $message = "Suceessfully student mistake detail are listed";
                $status = "Success";
            } else {
                $message = "No student mistake detail Records Found";
                $status = "Success";
                $sick_leave = [];
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $sick_leave
            ]);
        }
    }
    public function addmistake_detail(Request $request)
    {
        $rules = array(
            "student_id" => "required",
            "teacher_id" => "required",
            "hifz_id" => "required",
            "mistake_on" => "required",
            "course_id" => "required",
            "mistake_id" => "required",
            "mark_detected" => "required",
            "mark" => "required",
            "remark" => "required",
            "date" => "required",
            "arabic_date" => "required",
        );
        $student = Student::find($request->student_id);
        $teacher = User::find($request->teacher_id);
        // $mistake = mistake_table::find($request->mistake_id);
        $mistake =  DB::table('mistake_table')
            ->where('mistake_table.id', $request->mistake_id)
            ->first();
        if (empty($student && $teacher && $mistake)) {
            return response()->json([
                'status' => "failure",
                'message' => "Students_id or Teacher_id or Mistake_id does not  exist",
            ]);
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $created = DB::table("mistake_details")
                ->insert(array(
                    "student_id" =>  $request["student_id"],
                    "teacher_id" => $request["teacher_id"],
                    "hifz_id" => $request["hifz_id"],
                    "mistake_on" => $request["mistake_on"],
                    "course_id" => $request["course_id"],
                    "mistake_id" => $request["mistake_id"],
                    "mark_detected" => $request["mark_detected"],
                    "mark" => $request["mark"],
                    "remark" => $request["remark"],
                    "date" => $request["date"],
                    "arabic_date" => $request["arabic_date"],
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
    public function updatemistake_detail(Request $request)
    {
        $data = DB::table("mistake_details")
            ->where('student_id', $request->student_id)
            ->update(array(
                "student_id" =>  $request["student_id"],
                "teacher_id" => $request["teacher_id"],
                "hifz_id" => $request["hifz_id"],
                "mistake_on" => $request["mistake_on"],
                "course_id" => $request["course_id"],
                "mistake_id" => $request["mistake_id"],
                "mark_detected" => $request["mark_detected"],
                "mark" => $request["mark"],
                "remark" => $request["remark"],
                "date" => $request["date"],
                "arabic_date" => $request["arabic_date"],
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
    public function destroymistake_detail(Request $request)
    {
        $rules = array(
            "student_id" => "required",
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $deleted = DB::table('mistake_details')
                ->where('student_id', $request->student_id)
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
    public function listmistake(Request $request)
    {
        $rules = array(
            "course_id" => "required",
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $sick_leave = DB::table('mistake_table')
                ->join('syllabus_types', 'syllabus_types.id', 'mistake_table.course_id')
                ->where('mistake_table.course_id', $request->course_id)
                ->select('mistake_table.*', 'syllabus_types.title as course',)
                ->get();
            //print_r($sick_leave);
            if (sizeof($sick_leave) > 0) {
                $message = "Suceessfully Mistake Details are listed";
                $status = "Success";
            } else {
                $message = "No  Records Found";
                $status = "Success";
                $sick_leave = [];
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $sick_leave
            ]);
        }
    }
    public function addmistake(Request $request)
    {
        $rules = array(
            "title" => "required",
            "neglectable_mark" => "required",
            "course_id	" => "required",
        );
        // $users=DB::table('hifz_daily_update')
        // ->where('date',$request->date)
        // // ->where('student_id',$request->student_id)
        // ->first();
        // $message = "";
        // if ($users) {
        //     return response()->json([
        //         'status' => "failure",
        //         'message' => "Date already  exist",]);
        // }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $created = DB::table("mistake_table")
                ->insert(array(
                    "title" =>  $request["title"],
                    "neglectable_mark" => $request["neglectable_mark"],
                    "course_id	" => $request["course_id	"],
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
    public function updatemistake(Request $request)
    {
        $data = DB::table("mistake_table")
            ->where('student_id', $request->student_id)
            ->update(array(
                "title" =>  $request["title"],
                "neglectable_mark" => $request["neglectable_mark"],
                "course_id	" => $request["course_id"],
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
    public function destroymistake(Request $request)
    {
        $rules = array(
            "course_id" => "required",
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $deleted = DB::table('mistake_table')
                ->where('course_id', $request->course_id)
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
    public function failed_para_api(Request $request)
    {
        $rules = array(
            "student_id" => "required",
            "failed_parah" => "required",
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
            $student = Student::find($request->student_id);
            if (empty($student)) {
                return response()->json([
                    'status' => "failure",
                    'message' => "Students_id  does not  exist",
                ]);
            }
        } else {
            $failed_parahs = DB::table('hifz_daily_update')
                ->join('students', 'students.id', 'hifz_daily_update.student_id')
                ->where('hifz_daily_update.student_id', $request->student_id)
                ->where('hifz_daily_update.failed_parah', $request->failed_parah)
                ->select(
                    'hifz_daily_update.failed_parah',
                    'hifz_daily_update.failed_parah_ustad',
                    'hifz_daily_update.f_remark',
                    'hifz_daily_update.f_status',
                    'hifz_daily_update.f_mark',
                    'hifz_daily_update.student_id',
                    'students.name'
                )
                // ->orderByDesc('date')
                ->get();
            //print_r($sick_leave);
            if (sizeof($failed_parahs) > 0) {
                $message = "Suceessfully Failed Para Details are listed";
                $status = "Success";
            } else {
                $message = "No Records Found";
                $status = "Success";
                $failed_parahs = [];
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $failed_parahs
            ]);
        }
    }
    public function last_ten_day_record(Request $request)
    {
        $today = $request['date'];
        $rules = array(
            "date" => "required",
            "student_id" => "required"
        );
        // $student = Student::find($request->student_id);
        $dates = DB::table('hifz_daily_update')
            // ->where('hifz_daily_update.arabic_date', $request->date)
            ->where('hifz_daily_update.student_id', $request->student_id)
            ->first();
        if (empty($dates)) {
            return response()->json([
                'status' => "failure",
                'message' => "Students_id or date does not  exist",
            ]);
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $check = DB::table('hifz_daily_update')
                ->where("student_id", '=', $request->get('student_id'))
                ->orderBy('e_status', 'DESC')
                ->get();
            $a = 1;
            $exp_date = explode("/", $today);
            $req_date = $exp_date[2] . $exp_date[1] . $exp_date[0];
            foreach ($check as $key) {
                $exp_date1 = explode("/", $key->arabic_date == null ? "" : $key->arabic_date);
                $req_date1 = $exp_date1[2] . $exp_date1[1] . $exp_date1[0];
                if ((int)$req_date > (int)$req_date1) {
                    $logArray = array();
                    $logArray['id'] = $key->id;
                    $logArray['arabic_date'] = $key->arabic_date;
                    $logArray['amuqtha'] = $key->amuqtha == null ? "" : $key->amuqtha;
                    $logArray['amuqtha_ustad'] = $key->amuqtha_ustad == null ? "" : $key->amuqtha_ustad;
                    $logArray['a_remark'] = $key->a_remark == null ? "" : $key->a_remark;
                    $logArray['a_status'] = $key->a_status == null ? "" : $key->a_status;
                    $logArray['a_mark'] = $key->a_mark == null ? "" : $key->a_mark;
                    $logArray['end_parah'] = $key->end_parah == null ? "" : $key->end_parah;
                    $logArray['end_paraha_ustad'] = $key->end_paraha_ustad == null ? "" : $key->end_paraha_ustad;
                    $logArray['e_remark'] = $key->e_remark == null ? "" : $key->e_remark;
                    $logArray['e_mark'] = $key->e_mark == null ? "" : $key->e_mark;
                    $logArray['e_status'] = $key->e_status == null ? "" : $key->e_status;
                    $logArray['last_end_paraha'] = $key->last_end_paraha == null ? "" : $key->last_end_paraha;
                    $logArray['last_end_paraha_ustad'] = $key->last_end_paraha_ustad == null ? "" : $key->last_end_paraha_ustad;
                    $logArray['le_remark'] = $key->le_remark == null ? "" : $key->le_remark;
                    $logArray['le_status'] = $key->le_status == null ? "" : $key->le_status;
                    $logArray['le_mark'] = $key->le_mark == null ? "" : $key->le_mark;
                    $logArray['failed_parah'] = $key->failed_parah == null ? "" : $key->failed_parah;
                    $logArray['failed_parah_ustad'] = $key->failed_parah_ustad == null ? "" : $key->failed_parah_ustad;
                    $logArray['f_remark'] = $key->f_remark == null ? "" : $key->f_remark;
                    $logArray['f_status'] = $key->f_status == null ? "" : $key->f_status;
                    $logArray['f_mark'] = $key->f_mark == null ? "" : $key->f_mark;
                    $logArray['sabaq_interactions'] = $key->sabaq_interactions == null ? "" : $key->sabaq_interactions;
                    $logArray['sabaq_parah'] = $key->sabaq_parah == null ? "" : $key->sabaq_parah;
                    $logArray['new_parah'] = $key->new_parah == null ? "" : $key->new_parah;
                    $logArray['s_ramark'] = $key->s_ramark == null ? "" : $key->s_ramark;
                    $logArray['teacher_id'] = $key->teacher_id == null ? "" : $key->teacher_id;
                    $materialsArray[] = $logArray;
                    $a++;
                    if ($a == 10) {
                        break;
                    }
                }
            }
            $status = "Success";
            $array = DB::table('hifz_daily_update')
                ->where('student_id', $request->get('student_id'))
                ->where('arabic_date', $request['date'])
                ->get()->take(1);
            // if (sizeof($array) < 1) {
            //     $array[]   =   array(
            //         "id" => "",
            //         "student_id" => "",
            //         "date" => "",
            //         "arabic_date" => "",
            //         "amuqtha" => "",
            //         "amuqtha_ustad" => "",
            //         "a_remark" => "",
            //         "a_status" => "",
            //         "a_mark" => "",
            //         "end_parah" => "",
            //         "end_paraha_ustad" => "",
            //         "e_remark" => "",
            //         "e_mark" => "",
            //         "e_status" => "",
            //         "last_end_paraha" => "",
            //         "last_end_paraha_ustad" => "",
            //         "le_remark" => "",
            //         "le_status" => "",
            //         "le_mark" => "",
            //         "failed_parah" => "",
            //         "failed_parah_ustad" => "",
            //         "f_remark" => "",
            //         "f_status" => "",
            //         "f_mark" => "",
            //         "sabaq_interactions" => "",
            //         "sabaq_parah" => "",
            //         "new_parah" => "",
            //         "s_ramark" => "",
            //         "teacher_id" => "",
            //     );
            // }
            if (isset($materialsArray) && sizeof($materialsArray) > 0) {
                $message = "Suceessfully Daily Hifz List data ";
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
    public function daily_hifz_update(Request $request)
    {
        $rules = array(
            "student_id" => "required",
            "date" => "required"
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
            $student = Student::find($request->student_id);
            if (empty($student)) {
                return response()->json([
                    'status' => "failure",
                    'message' => "Students_id  does not  exist",
                ]);
            }
        }
        $hifz_update = DB::table('hifz_daily_update')
            ->join('students', 'students.id', 'hifz_daily_update.student_id')
            ->join('users', 'users.id', 'hifz_daily_update.teacher_id')
            ->where('hifz_daily_update.student_id', $request->student_id)
            ->where('hifz_daily_update.date', $request->date)
            ->first();
        if (!empty($hifz_update)) {
            $data = DB::table("hifz_daily_update")
                ->where('student_id', $request->student_id)
                ->update(array(
                    "student_id" =>  $request["student_id"],
                    "date" => $request["date"],
                    "arabic_date" => $request["arabic_date"],
                    "amuqtha" => $request["amuqtha"],
                    "amuqtha_ustad" => $request["amuqtha_ustad"],
                    "a_remark" => $request["a_remark"],
                    "a_status" => $request["a_status"],
                    "a_mark" => $request["a_mark"],
                    "end_parah" => $request["end_parah"],
                    "end_paraha_ustad" => $request["end_paraha_ustad"],
                    "e_remark" => $request["e_remark"],
                    "e_mark" => $request["e_mark"],
                    "e_status" => $request["e_status"],
                    "last_end_paraha" => $request["last_end_paraha"],
                    "last_end_paraha_ustad" => $request["last_end_paraha_ustad"],
                    "le_remark" => $request["le_remark"],
                    "le_status" => $request["le_status"],
                    "le_mark" =>  $request["le_mark"],
                    "failed_parah" => $request["failed_parah"],
                    "failed_parah_ustad" => $request["failed_parah_ustad"],
                    "f_remark" => $request["f_remark"],
                    "f_status" => $request["f_status"],
                    "f_mark" => $request["f_mark"],
                    "sabaq_interactions" => $request["sabaq_interactions"],
                    "sabaq_parah" => $request["sabaq_parah"],
                    "new_parah" => $request["new_parah"],
                    "s_ramark" => $request["s_ramark"],
                    "teacher_id" => $request["teacher_id"],
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
        } elseif (empty($hifz_update)) {
            $created = DB::table("hifz_daily_update")
                ->insert(array(
                    "student_id" =>  $request["student_id"],
                    "date" => $request["date"],
                    "arabic_date" => $request["arabic_date"],
                    "amuqtha" => $request["amuqtha"],
                    "amuqtha_ustad" => $request["amuqtha_ustad"],
                    "a_remark" => $request["a_remark"],
                    "a_status" => $request["a_status"],
                    "a_mark" => $request["a_mark"],
                    "end_parah" => $request["end_parah"],
                    "end_paraha_ustad" => $request["end_paraha_ustad"],
                    "e_remark" => $request["e_remark"],
                    "e_mark" => $request["e_mark"],
                    "e_status" => $request["e_status"],
                    "last_end_paraha" => $request["last_end_paraha"],
                    "last_end_paraha_ustad" => $request["last_end_paraha_ustad"],
                    "le_remark" => $request["le_remark"],
                    "le_status" => $request["le_status"],
                    "le_mark" =>  $request["le_mark"],
                    "failed_parah" => $request["failed_parah"],
                    "failed_parah_ustad" => $request["failed_parah_ustad"],
                    "f_remark" => $request["f_remark"],
                    "f_status" => $request["f_status"],
                    "f_mark" => $request["f_mark"],
                    "sabaq_interactions" => $request["sabaq_interactions"],
                    "sabaq_parah" => $request["sabaq_parah"],
                    "new_parah" => $request["new_parah"],
                    "s_ramark" => $request["s_ramark"],
                    "teacher_id" => $request["teacher_id"],
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
    public function complete_para(Request $request)
    {
        $rules = array(
            "student_id" => "required",
            "teacher_id" => "required",
            "parah" => "required",
            "mark" => "required",
            "remark" => "required",
            "arabic_date" => "required"
        );
        $check_office_para = DB::table('pre_ends')
            ->where("student_id",  $request->student_id)
            ->where('status', 0)
            ->first();

        if (!empty($check_office_para)) {
            return response()->json([
                'status' => "Failure",
                'message' => "First Complete Hold Para",
                'response' => 422,
            ]);
        }
        $user = User::find($request->teacher_id);
        $student = Student::find($request->student_id);
        // $course = Student::find($student->course_id == 2);
        // return $course;
        if (empty($student && $user)) {
            return response()->json([
                'status' => "failure",
                'message' => "Students_id or teacher_id or cours id does not  exist",
            ]);
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $created = DB::table("pre_ends")
                ->insert(array(
                    "student_id" =>  $request["student_id"],
                    "teacher_id" => $request["teacher_id"],
                    "target" => $request["parah"],
                    "remark" => $request["remark"],
                    "date" => $request["arabic_date"],
                    "course_id" => 2
                ));
            if ($created) {
                return response()->json([
                    'status' => "success",
                    'message' => "Complete Para created successfully",
                ]);
            } else {
                return response()->json([
                    'status' => "failure",
                    'message' => "Complete Para Not created",
                ]);
            }
        }
    }
    public function amuqtha_tyari(Request $request)
    {
        $rules = array(
            "student_id" => "required",
            "date" => "required"
        );
        // dd-mm-yyy
        $student = Structure::find($request->student_id);
        if (empty($student)) {
            return response()->json([
                'status' => "failure",
                'message' => "Students_id  does not  exist",
            ]);
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
        } else {
            $last_para = DB::table('structures')
                ->join('paras', 'paras.id', 'structures.para_id')
                ->join('students', 'students.id', 'structures.student_id')
                ->join('users', 'users.id', 'structures.teacher_id')
                ->where('structures.student_id', $request->student_id)
                ->select('students.id as students_id', 'students.name as students_name', 'paras.para_name', 'paras.id as para_id')
                ->orderByDesc('structures.id')
                ->first();
            // return $last_para;
            $check = DB::table('amuqtha')
                ->where("student_id", $request["student_id"])
                ->first();
            if (empty($check)) {
                $check_para = DB::table("structures")
                    ->join('paras', 'paras.id', 'structures.para_id')
                    ->join('students', 'students.id', 'structures.student_id')
                    ->where('structures.student_id', $request->student_id)
                    ->select('students.id as students_id', 'students.name as students_name', 'paras.para_name', 'paras.id as para_id')
                    ->take(3)->get()
                    ->toarray();
                $arr = array();
                $value = array();
                $arr[] = $last_para->para_id;
                foreach ($check_para as $pdata) {
                    $arr[] = $pdata->para_id;
                    $value[] = $pdata->para_id;
                }
            } else {
                // $ua[] = $last_para->para_id;
                $lastarray = array($last_para->para_id);
                $alreadyexistarray = explode(",", $check->last_para);
                $lastvalue = end($alreadyexistarray);
                $check_para = DB::table("structures")
                    ->join('paras', 'paras.id', 'structures.para_id')
                    ->join('students', 'students.id', 'structures.student_id')
                    ->where('structures.student_id', $request->student_id)
                    ->select('students.id as students_id', 'students.name as students_name', 'paras.para_name', 'paras.id as para_id')
                    ->whereNotIn('para_id', $lastarray)
                    ->skip($lastvalue)
                    ->take(3)->get()
                    ->toarray();
                $value = false;
                if (!empty($check_para)) {
                    if (sizeof($check_para) == 3) {
                        $value = false;
                    } else {
                        $totalsize = sizeof($check_para);
                        $remain = 3 - $totalsize;
                        $check_para1 = DB::table("structures")
                            ->join('paras', 'paras.id', 'structures.para_id')
                            ->join('students', 'students.id', 'structures.student_id')
                            ->where('structures.student_id', $request->student_id)
                            ->select('students.id as students_id', 'students.name as students_name', 'paras.para_name', 'paras.id as para_id')
                            ->take($remain)->get()
                            ->toarray();
                        $check_para = array_merge($check_para, $check_para1);
                    }
                } else {
                    $check_para = DB::table("structures")
                        ->join('paras', 'paras.id', 'structures.para_id')
                        ->join('students', 'students.id', 'structures.student_id')
                        ->where('structures.student_id', $request->student_id)
                        ->select('students.id as students_id', 'students.name as students_name', 'paras.para_name', 'paras.id as para_id')
                        ->take(3)->get()
                        ->toarray();
                }
                $arr = array();
                $value = array();
                $arr[] = $last_para->para_id;
                // foreach ($alreadyexistarray as $data) {
                //     $value[] = $data;
                // }
                foreach ($check_para as $pdata) {
                    $arr[] = $pdata->para_id;
                    $value[] = $pdata->para_id;
                }
            }
            $last_paras = implode(",", $value);
            $checkdate = DB::table('amuqtha')
                ->where("student_id", $request["student_id"])
                ->where("date", $request["date"])
                ->first();


            if (empty($checkdate)) {
                if (!empty($check)) {
                    $add = DB::table('amuqtha')
                        ->where("student_id", $request["student_id"])
                        ->update(array(
                            "student_id" =>  $request["student_id"],
                            "date" => $request["date"],
                            "last_para" => $last_paras,
                        ));
                } else {
                    $add = DB::table('amuqtha')
                        ->insert(array(
                            "student_id" =>  $request["student_id"],
                            "date" => $request["date"],
                            "last_para" => $last_paras,
                        ));
                }
            }


            if ($check_para) {
                $message = "Suceessfully structures Details are listed";
                $status = "Success";
            } else {
                $message = "No  Records Found";
                $status = "Success";
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
                'para' => $check_para,
                'last_end_para' => $last_para
            ]);
        }
    }


    public function aapas_para(Request $request)
    {

        $rules = array(
            "student_id" => "required",


        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => "Failure",
                'message' => $validator->errors()->first(),
                'response' => 422,
            ]);
            $user = Para::find($request->para_id);

            if (empty($user)) {
                return response()->json([
                    'status' => "failure",
                    'message' => "para_id  does not  exist",
                ]);
            }
        } else {

            $hifz_update = DB::table('hifz_daily_update')
                ->join('students', 'students.id', 'hifz_daily_update.student_id')
                ->join('users', 'users.id', 'hifz_daily_update.teacher_id')
                ->where('hifz_daily_update.student_id', $request->student_id)
                ->select('hifz_daily_update.*', 'students.name as student_name', 'users.full_name as teacher_name',)
                ->orderByDesc('hifz_daily_update.id')
                ->first();



            $hifz_update1 = DB::table('hifz_daily_update')
                ->join('students', 'students.id', 'hifz_daily_update.student_id')
                ->join('users', 'users.id', 'hifz_daily_update.teacher_id')
                ->where('hifz_daily_update.student_id', $request->student_id)
                ->select('hifz_daily_update.*', 'students.name as student_name', 'users.full_name as teacher_name',)
                ->orderByDesc('hifz_daily_update.id')
                ->get();


            $materialsArray = [];
            if (!empty($hifz_update)) {
                $index1 = explode("-", $hifz_update->sabaq_parah)[0];
                foreach ($hifz_update1 as $data) {
                    $index2 = explode("-", $data->sabaq_parah)[0];

                    $para_name = DB::table("paras")
                        ->where('paras.para_no', $index1)
                        ->select('para_name')
                        ->first();
                    // return $para_name;


                    if ($index1 == $index2) {
                        $logArray = array();
                        $logArray['id'] = $data->id;
                        $logArray['student_id'] = $data->student_id;
                        $logArray['student_name'] = $data->student_name;
                        $logArray['para_name'] = $para_name->para_name;
                        $logArray['para_no'] = $data->sabaq_parah;
                        $logArray['e_status'] = $data->e_status;
                        $materialsArray[] = $logArray;
                    }
                }
            }
        }
        if (true) {
            $message = "Suceessfully Aapas Para Details are listed";
            $status = "Success";
        } else {
            $message = "No  Records Found";
            $status = "Success";
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $materialsArray
        ]);
    }
    public function not_assign_students(Request $request)
    {
        $checkid = DB::table('teachers')
            ->select('student_id')
            ->get()->toarray();
        foreach ($checkid as $qdata) {
            $arr[] = $qdata->student_id;
        }


        if (!isset($arr)) {
            $arr = array();
        }
        $student = DB::table("students")
            ->join('syllabus_types', 'syllabus_types.id', 'students.course_id')
            ->whereNotIn('students.id', $arr)
            ->select('students.*', 'syllabus_types.title as course')
            ->get();
        foreach ($student as $key) {
            $logArray['id'] = $key->id;
            $logArray['admission_no'] = $key->admission_no;
            $logArray['student_photo'] = 'https://qcodesinfotech.com/madrasa/students_photo/' . $key->student_pic;
            $logArray['student_name'] = $key->name;
            $logArray['course_id'] = $key->course_id;
            $logArray['course'] = $key->course;
            $logArray['father_occupation'] = $key->father_occupation;
            $logArray['father_name'] = $key->father_name;
            $logArray['date_of_birth'] = $key->date_of_birth;
            $logArray['aadhar_no'] = $key->aadhar_no;
            $logArray['mobile_no'] = $key->mobile_no;
            $logArray['whatsapp_no'] = $key->whatsapp_no;
            $logArray['address'] = $key->address;
            $logArray['monthly_donation'] = $key->monthly_donation;
            $logArray['admission_date'] = $key->Admission_date;
            $logArray['blood_group'] = $key->blood_group;
            $logArray['previous_school'] = $key->previous_school;
            $logArray['status'] = $key->status;
            $logArray['created_date'] = $key->created_at;
        }
        $materialsArray[] = $logArray;


        if ($student) {
            $message = "Suceessfully structures Details are listed";
            $status = "Success";
        } else {
            $message = "No  Records Found";
            $status = "Success";
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $student,

        ]);
    }


    public function AdminDotnet(Request $request)
    {

        $std = [];

        if ($request->file('ProfilePic')) {
            $file = $request->file('ProfilePic');
            $destinationPath = 'DotnetImage/';
            $profileImage1 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage1);
            $std['ProfilePic'] = 'https://qcodesinfotech.com/madrasa/DotnetImage/' . $profileImage1;
        }


        return response()->json([
            'message' => "Suceessfully Uploaded",
            'status' => "Success",
            'data' => $std
        ]);
    }



    public function Productupload(Request $request)
    {

        $std = [];
        if ($request->file('water_input_image')) {
            $file1 = $request->file('water_input_image');
            $destinationPath = 'DotnetImage/';
            $profileImage1 = date('YmdHis') . "A1." . $file1->getClientOriginalExtension();
            $file1->move($destinationPath, $profileImage1);
            $std['water_img'] = 'https://qcodesinfotech.com/madrasa/DotnetImage/' . $profileImage1;
        }
        if ($request->file('grey_water_discharge_image')) {
            $file2 = $request->file('grey_water_discharge_image');
            $destinationPath = 'DotnetImage/';
            $profileImage2 = date('YmdHis') . "A2." . $file2->getClientOriginalExtension();
            $file2->move($destinationPath, $profileImage2);
            $std['grey_water_discharge_image'] = 'https://qcodesinfotech.com/madrasa/DotnetImage/' . $profileImage2;
        }
        if ($request->file('black_water_image')) {
            $file3 = $request->file('black_water_image');
            $destinationPath = 'DotnetImage/';
            $profileImage3 = date('YmdHis') . "A3." . $file3->getClientOriginalExtension();
            $file3->move($destinationPath, $profileImage3);
            $std['black_img'] = 'https://qcodesinfotech.com/madrasa/DotnetImage/' . $profileImage3;
        }

        if ($request->file('electric_conn_type_image')) {
            $file4 = $request->file('electric_conn_type_image');
            $destinationPath = 'DotnetImage/';
            $profileImage4 = date('YmdHis') . "A4." . $file4->getClientOriginalExtension();
            $file4->move($destinationPath, $profileImage4);
            $std['electric_img'] = 'https://qcodesinfotech.com/madrasa/DotnetImage/' . $profileImage4;
        }


        if ($request->file('power_input_image')) {
            $file5 = $request->file('power_input_image');
            $destinationPath = 'DotnetImage/';
            $profileImage5 = date('YmdHis') . "A5." . $file5->getClientOriginalExtension();
            $file5->move($destinationPath, $profileImage5);
            $std['power_img'] = 'https://qcodesinfotech.com/madrasa/DotnetImage/' . $profileImage5;
        }



        return response()->json([
            'message' => "Suceessfully Uploaded",
            'status' => "Success",
            'data' => $std
        ]);
    }

    public function fruitapp(Request $request)
    {

        $std = [];

        if ($request->file('image')) {
            $file = $request->file('image');
            $destinationPath = 'fruitapp/';
            $profileImage1 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage1);
            $std['image'] = 'https://qcodesinfotech.com/madrasa/fruitapp/' . $profileImage1;

            return response()->json([
                'message' => "Suceessfully Uploaded",
                'status' => "Success",
                'data' => $std
            ]);
        } else {
            return response()->json([
                'message' => "please Send image File",
                'status' => "Failure",
                'data' => $std
            ]);
        }
    }

    public function deletedata()
    {

        $dailynaz = DB::table('daily_naz_updates')
            ->delete();
        $preend = DB::table('pre_ends')
            ->delete();

        return response()->json([
            'message' => "Suceessfully Deleted",
            'status' => "Success",

        ]);
    }
    public function  resume(Request $request)
    {
        $std = [];
        if ($request->file('image')) {
            $file = $request->file('image');
            $destinationPath = 'qcodesresume/';
            $profileImage1 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage1);
            $std['image'] = 'https://qcodesinfotech.com/madrasa/qcodesresume/' . $profileImage1;

            return response()->json([
                'message' => "Suceessfully Uploaded",
                'status' => "Success",
                'data' => $std
            ]);
        } else {
            return response()->json([
                'message' => "please Send image File",
                'status' => "Failure",
                'data' => $std
            ]);
        }
    }
}
