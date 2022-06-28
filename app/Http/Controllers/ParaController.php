<?php

namespace App\Http\Controllers;

use App\Models\Daily_naz_update;
use App\Models\Dor_update;
use App\Models\Hifz_update;
use App\Models\Structure;
use App\Models\Para;
use App\Models\student_based_para;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use  Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;


class ParaController extends Controller
{
    public function index()
    {
        $para = Para::all();
        return view('paras.index', compact('para'));
    }
    public function store(Request $request)
    {
        $question = new Para;
        $question->para_name = $request->get('para_name');
        $question->para_no = $request->get('para_no');
        $question->rukus = $request->get('rukus');
        $question->save();

        return redirect()->route('para.index')
        ->with('success, syllabus updated successfully');

    }

    public function edit(Para $para)
    {
        return view('paras.edit', compact('para'));
    }



    public function checkstudent(){

        $checkid = DB::table('teachers')
        ->select('student_id')
            ->get()->toarray();
     
            foreach($checkid as $qdata){
                $arr[]=$qdata->student_id;  
               }
    
              
               if(!isset($arr)){
                 $arr = array();
                }
            $student = DB::table("students")
            ->whereNotIn('id',$arr)
            ->get();
    
            $teacher = DB::table("users")->get();

        return view('course.checkstudent', compact('teacher','student'));
 
    }

    public function checkdevice(Request $request, $id)
    {

        $ch = DB::table('users')
            ->where('id', $id)
            ->first();

        if ($request->device == "yes") {

                DB::table('users')
                ->where('id', $id)
                ->update([
                    'device_id' => $ch->value,
                    'value' => null,
                ]);

           }else{

            DB::table('users')
                ->where('id', $id)
                ->update([
                    'value' => null,
                ]);
            }

          return redirect('user');

        }

    public function update(Request $request, $id)
    {

        $question = Para::find($id);
        $question->para_name = $request->get('para_name');
        $question->para_no = $request->get('para_no');
        $question->rukus = $request->get('rukus');
        $question->save();
        return redirect()->route('para.index')
               ->with('success, para updated successfully');

    }

    public function destroy(Para $para)
    {

        $para->delete();
        return redirect()->route('para.index')
            ->with('success', 'para deleted successfull');

    }

    public function structure()
    {
        $student = DB::table('students')->get();
        $para = DB::table('paras')->get();
        $daily_naz = DB::table('structures')->get();
        return view('paras.structure', compact('daily_naz', 'para', 'student'));
    }

    //////////////////////////////////////////////////Naz update//////////////////////////////////

    public function nazupdate(Request $request, $id)
    {

        $update =  Daily_naz_update::find($id);
        $update->arabic_date = $request->get('arabic_date');
        $update->day = $request->get('day');
        $update->old_exam = $request->get('old_exam');
        $update->exam_1 = $request->get('exam_1');
        $update->exam_2 = $request->get('exam_2');
        $update->exam_3 = $request->get('exam_3');
        $update->total = $request->get('total');
        $update->revision = $request->get('revision');
        $update->n_exam = $request->get('n_exam');
        $update->total_sub_week = $request->get('total_sub_week');
        $update->ruku = $request->get('ruku');
        $update->nisf = $request->get('nisf');
        $update->overall_para = $request->get('overall_para');
        $update->teacher_id = $request->get('teacher_id');
        $update->student_id = $request->get('student_id');
        $update->save();

        return redirect()->route('naz_update')->with('success', 'Naz data Updated successfully');
  
    }

    public function strucupdate(Request $request, $id)
    {

        $add_stur =  structure::find($id);
        $add_stur->para_id = $request->get('para_id');
        $add_stur->teacher_id = $request->get('teacher_id');
        $add_stur->student_id = $request->get('student_id');
        $add_stur->arabic_date = $request->get('arabic_date');
        $add_stur->save();
      
        return redirect()->route('structure')->with('success', 'structure data Updated successfully');
  
    }

    ///////////////////---  para update ----//////////////////////////////


    public function sparaupdate(Request $request, $id)
    {
        $add_stur =  student_based_para::find($id);
        $add_stur->para_id = $request->get('para_id');
        $add_stur->student_id = $request->get('student_id');
        $add_stur->para_order = $request->get('para_order');
        $add_stur->save();

        return redirect()->route('student_based')->with('success', 'structure data Updated successfully');

    }

    public function strucdelete($id)
    {

        $syllabus = structure::find($id);
        $syllabus->delete();

        return redirect()->route('structure')->with('success', 'Naz data deleted successfully');

    }

    public function strucedit($id)
    {


        $students = DB::table('students')->get();


        $users = DB::table('users')->get();

        $pannel = DB::table('structures')
            ->where('structures.id', '=', $id)
            ->join('students', 'students.id', '=', 'student_id')
            ->join('users', 'users.id', '=', 'structures.teacher_id')
            ->select('structures.*', 'students.name', 'users.full_name as teacher')
            ->get();

        foreach ($pannel as $daily_naz)
        {
           return view('paras.editstruct', compact('daily_naz', 'users', 'students'));
        }
    }

    //////////////////////////////////---- Student Based Parah -----------/////////////////////////
    public function studentbase(Request $request)
    {
$student = DB::table('students')
->where('students.id', '=', $request['student'])
->first();

$course =  DB::table('syllabus_types')
->where('id',$student->course_id)
->first();

$naz = 'naz';
$hifz = 'hifz';

if(preg_match("/{$naz}/i", $course->title)) {
    echo 'true';
}

$hello = DB::table('syllabus_adds')
        ->where('student_id', '=', $student->id)
        ->where('course_id', '=', $student->course_id)
        ->whereNotNull('target')
        ->where('no_of_parah', 'like', '%Para%')
        ->get();

        if (sizeof($hello) > 0) {
            for ($i = 0; $i < sizeof($hello); $i++) {
                $array = explode(",", $hello[$i]->target);
                $date[] = $array;
                }

            $filter = call_user_func_array('array_merge', $date);

            if (sizeof(array_filter($filter)) >= 30) {
                return redirect('assign');
            }

            $request->session()->put('student_id', $request['student']);
            if(preg_match("/{$naz}/i", $course->title)) {
                return redirect('nazview');

            }else if(preg_match("/{$hifz}/i", $course->title)){

                return redirect('hifzview');

            }else{

                return true;

            }

           
        } else {


            $i = 1;
            $day1 = $request['para_order'];
            $student_id = $request['student'];

            foreach ($day1 as $save_exam) {
                $i++;
                $question = new student_based_para;
                $question->para_order = $save_exam;
                $question->student_id = $student_id;
                $question->para_id = $i;
                $question->save();
            }

            $request->session()->put('student_id', $student_id);

            if(preg_match("/{$naz}/i", $course->title)) {

                return redirect('nazview');

            }else if(preg_match("/{$hifz}/i", $course->title)){

            return redirect('hifzview');

            }else{

                return true;

            }

        }
    
    }

    public function nazview(Request $request){

        $student = DB::table('students')
        ->where('students.id', '=', session('student_id'))
        ->join('syllabus_types', 'syllabus_types.id', 'students.course_id')
        ->select('students.name', 'students.id', 'syllabus_types.id as course_id', 'syllabus_types.title as course_title', 'students.Admission_date')
        ->first();

        $month_id = Carbon::createFromFormat('Y-m-d', $student->Admission_date)->format('m');

        $month = DB::table('months')
         ->whereBetween('id', array($month_id, 30))->get();
        $month_1 = DB::table('months')->get();


    foreach ($month as $month_start) {
        $dat[] = $month_start->month;

        $dat[] = $month_start->id;
    }

              foreach ($month_1 as $month_start) {
                    $dat[] = $month_start->month;
                    $dat[] = $month_start->id;
                        }
        $parah = DB::table('student_based_paras')
        ->where('student_based_paras.student_id', '=', $student->id)
        ->join('paras', 'paras.id', '=', 'student_based_paras.para_order')
        ->select('para_name as para_order',"student_based_paras.id")
        ->get();

        $dat = array_chunk($dat, 2);

        $count = DB::table("syllabus_adds")
        ->where('student_id', '=', $student->id)
        ->where('course_id', '=', $student->course_id)
        ->get()->all();

        return view('assign.naz', compact('student', 'parah', 'dat'));

    }

    public function hifzview(Request $request){
        $student = DB::table('students')
        ->where('students.id', '=', session('student_id'))
        ->join('syllabus_types', 'syllabus_types.id', 'students.course_id')
        ->select('students.name', 'students.id', 'syllabus_types.id as course_id', 'syllabus_types.title as course_title', 'students.Admission_date')
        ->first();

    $month_id = Carbon::createFromFormat('Y-m-d', $student->Admission_date)->format('m');
    $month = DB::table('months')
        ->whereBetween('id', array($month_id, 30))->get();
    $month_1 = DB::table('months')->get();
    foreach ($month as $month_start) {
        $dat[] = $month_start->month;
        $dat[] = $month_start->id;
    }
              foreach ($month_1 as $month_start) {
                    $dat[] = $month_start->month;
                    $dat[] = $month_start->id;
                        }

        $parah = DB::table('student_based_paras')
        ->where('student_based_paras.student_id', '=', $student->id)
        ->join('paras', 'paras.id', '=', 'student_based_paras.para_order')
        ->select('para_name as para_order',"student_based_paras.id")
        ->get();

        $dat = array_chunk($dat, 2);

        $count = DB::table("syllabus_adds")
        ->where('student_id', '=', $student->id)
        ->where('course_id', '=', $student->course_id)
        ->get()->all();

        return view('assign.hifz', compact('student', 'parah', 'dat'));
   
        }

   
    public function reload(Request $request)
    {

        session()->pull('para1');
        session()->pull('para_id');
        return redirect('setsyllabus');
   
    }

    public function setsyllabus(Request $request)
    {
        $student = DB::table('students')
       ->where('students.id', '=', session('student_id'))
        ->join('syllabus_types', 'syllabus_types.id', 'students.course_id')
        ->select('students.name', 'students.id', 'syllabus_types.id as course_id', 'syllabus_types.title as course_title', 'students.Admission_date')
        ->get();

     $month_id = Carbon::createFromFormat('Y-m-d', $student[0]->Admission_date)->format('m');


     $month = DB::table('months')
        ->whereBetween('id', array($month_id, 30))
        ->get();


     $month_1 = DB::table('months')->get();


     foreach ($month as $month_start) {
        $dat[] = $month_start->month;
        $dat[] = $month_start->id;
     }


     foreach ($month_1 as $month_start) {
        $dat[] = $month_start->month;
        $dat[] = $month_start->id;
     }


     $parah = DB::table('student_based_paras')
        ->where('student_based_paras.student_id', '=', $student[0]->id)
        ->join('paras', 'paras.id', '=', 'student_based_paras.para_order')
        ->get();

     $dat = array_chunk($dat, 2);


     $count = DB::table("syllabus_adds")
        ->where('student_id', '=', $student[0]->id)
        ->where('course_id', '=', $student[0]->course_id)
        ->get()->all();

    $num = sizeof($count);

    if($num <= "12" && $num >= "5") {
        
        $value = "a";

    }elseif ($num <= "24"  && $num >= "20"){
        $value = "b";
    }elseif ($num <= "36"  && $num >= "30"){
        $value = "c";
    }elseif ($num <= "48"  && $num >= "40") {
        $value = "d";
    } elseif ($num <= "60"  && $num >= "60"){
        $value = "e";
    } elseif ($num == "72"  && $num >= "70") {
        $value = "f";
    } else {
        $value = "z"; 
    }


    $check = DB::table('syllabus_adds')
        ->where('student_id', '=', $student[0]->id)
        ->where('course_id', '=', $student[0]->course_id)
        ->whereNotNull('target')
        ->where('no_of_parah', 'like', '%Para%')
        ->orderBy('id', 'DESC')
        ->get()->all();

    if (sizeof($check) > 0) {
        $result = explode(", ",  $check[0]->target);
        $clear_result = array_filter($result);
        $answer = end($clear_result);
        session()->put('para1', $answer);
    }

    return view('assign.syllabus', compact('student', 'parah', 'dat', 'value'));
   
   
   
    }

    public function student_based()
    {
        $student = DB::table('students')->get();
        $parah = DB::table('paras')->get();
        $student_base = DB::table('student_based_paras')
            ->join('students', 'students.id', '=', 'student_based_paras.student_id')
            ->join('paras', 'paras.id', '=', 'student_based_paras.para_order')
            ->select('student_based_paras.*', 'students.name', 'paras.para_name as para_order')
            ->get()
            ->groupBy('name');
        return view('student_parah.index', compact('student', 'parah', 'student_base'));
    }

    public function getstudentparah($id)
    {
        $student_base = DB::table('student_based_paras')
            ->join('students', 'students.id', '=', 'student_based_paras.student_id')
            ->join('paras', 'paras.id', '=', 'student_based_paras.para_order')
            ->where('students.name', $id)
            ->select('student_based_paras.*', 'students.name', 'paras.para_name as para_order')
            ->get();
        return view('student_parah.paraorder', compact('student_base'));
    }

    public function getparalist($id)
    {
        $daily_naz = DB::table('structures')->get();
        $student = DB::table('students')->get();
        $parahead = DB::table('student_based_paras')
            ->where('student_based_paras.student_id', '=', $id)
            ->join('paras', 'paras.id', '=', 'student_based_paras.para_order')
            ->select('paras.para_name','paras.id as para_id', 'student_based_paras.student_id', 'student_based_paras.para_order')
            ->orderBy('student_based_paras.id', 'DESC')
            ->get()->take(30);

            // عَمَّ يَتَسَاءَلُونَ
        foreach ($parahead as $data) {
            $stud = $data->student_id;
        }
        if (isset($stud)) {
            return view('paras.structure', compact('parahead', 'daily_naz'));
        } else {
            return redirect()->route('structure')->with('success', "The student list is not Added in student based menu table ");
        }
    }
    public function editparah($id)
    {
        $students = DB::table('students')->get();
        $paras = DB::table('paras')->get();
        $pannel = DB::table('student_based_paras')
            ->where('student_based_paras.id', '=', $id)
            ->join('students', 'students.id', '=', 'student_based_paras.student_id')
            ->join('paras', 'paras.id', '=', 'student_based_paras.para_order')
            ->select('student_based_paras.*', 'students.name as student_id', 'paras.para_name as para_order')
            ->get();
        foreach ($pannel as $para) {
            return view('student_parah.edit', compact('para', 'students', 'paras'));
        }
    }
    public function khatma()
    {
        $naz = DB::table('daily_naz_updates')
            ->join('students', 'students.id', '=', 'daily_naz_updates.student_id')
            ->select('students.name', 'students.id as stud_id')
            ->get()->groupBy('name');

        return view('course.khatma', compact('naz'));

    }

    public function searchkhatma(Request $request)
    {
        $khatma = DB::table('daily_naz_updates')
            ->join('students', 'students.id', '=', 'daily_naz_updates.student_id')
            ->where('daily_naz_updates.e_parah', 1)
            ->select('students.name', 'daily_naz_updates.*', 'students.id as stud_id')
            ->where('students.name', $request->student_id)
            ->get();

        $naz = DB::table('daily_naz_updates')
            ->join('students', 'students.id', '=', 'daily_naz_updates.student_id')
            ->select('students.name', 'students.id as stud_id')
            ->get()->groupBy('name');
        return view('course.khatma', compact('naz', 'khatma'));
    }
    public function cancelnaz(Request $request, $id)
    {
        $khatma = Daily_naz_update::find($id);
        $khatma->overall_para = 0;
        $khatma->save();
        return redirect('khatma');
    }
    public function correctnaz(Request $request, $id)
    {
        $khatma = Daily_naz_update::find($id);
        $khatma->e_parah = 2;
        $khatma->save();
        return redirect('khatma');
    }

   public function getnaz()
  {
    $course = DB::table('syllabus_types')->get();
    
    $daily_naz = DB::table('daily_naz_updates')
             ->join('students', 'students.id', '=', 'daily_naz_updates.student_id')
             ->select('students.name', 'daily_naz_updates.*')
             ->get()
             ->groupBy('name');


    $month = DB::table('daily_naz_updates')->get()
             ->groupBy('month');


    return view('paras.naz', compact('daily_naz', 'month', 'course'));

  }

public function checknaz(Request $request)
{

if(isset($_GET["month_id"])){
   $month = $_GET["month_id"];
}else{
    $month = date('m');
}


$request->session()->put('student_id', $_GET["student_id"]);

    $course = DB::table('syllabus_types')->get();
    $daily_naz = DB::table('daily_naz_updates')
    ->join('students', 'students.id', '=', 'daily_naz_updates.student_id')
    ->select('students.name', 'daily_naz_updates.*')
    ->get()->groupBy('name');
        $month = DB::table('daily_naz_updates')->get()->groupBy('month');

        if(isset($_GET["month_id"])){
      
            $result = DB::table('daily_naz_updates')
            ->join('students', 'students.id', '=', 'daily_naz_updates.student_id')  
            ->where('students.name', '=', $_GET["student_id"])
            ->where('daily_naz_updates.month', '=', $_GET["month_id"])
            ->select('students.id as student_id','daily_naz_updates.*')
            ->get();
      
        }else{

            $result = DB::table('daily_naz_updates')
            ->join('students', 'students.id', '=', 'daily_naz_updates.student_id')
            ->where('students.name', '=', $_GET["student_id"])
            ->orderBy('daily_naz_updates.id','DESC')
            ->select('students.id as student_id','daily_naz_updates.*')
            ->get()->take(30); 
      
        }
  
        $i = 0;


        foreach ($result as $data) {  
          if(!isset($request->year)){
             $condition = true;

          }else{
              $condition = explode("/",$data->arabic_date)[2] ===  $request->year;
          }
        
        if($condition){
            $list['month'] = Carbon::createFromFormat('d/m/Y',  $data->arabic_date)->format('m');
            $list['exam_1'] = $data->exam_1;
            $list['exam_2'] = $data->exam_2;
            $list['exam_3'] = $data->exam_3;
            $list['exam_1a'] = $data->exam_1a;
            $list['exam1_time'] = $data->exam1_time;
            $list['exam2_time'] = $data->exam2_time;
            $list['exam3_time'] = $data->exam3_time;
            $list['student_id'] = $data->student_id;    
            $list['remark'] = $data->remark;    
            $list['exam_2a'] = $data->exam_2a;   
            $list['arabic_date'] = preg_split("#/#", $data->arabic_date)[0];
            $list['exam_3a'] = $data->exam_3a;
            $list['total'] = $data->total;
            $list['id'] = $data->id;
            $list['revision'] = $data->revision;
            $list['n_exam'] = $data->n_exam;
            $list['old_exam'] = $data->old_exam;
            $list['startday'] = Carbon::createFromFormat('d/m/Y',   $data->arabic_date)->startOfMonth()->dayOfWeek;
            $list['date'] = Carbon::createFromFormat('d/m/Y', $data->arabic_date)->format('d');
            $list['year'] = Carbon::createFromFormat('d/m/Y', $data->arabic_date)->format('Y');
            $list['totalday'] = Carbon::createFromFormat('d/m/Y',$data->arabic_date)->daysInMonth;
            $list['end-day'] = Carbon::createFromFormat('d/m/Y', $data->arabic_date)->endOfMonth()->dayOfWeek;
            $array[] = $list;
        
         }

             $date_end = $list['end-date'] = Carbon::createFromFormat('d/m/Y',$data->arabic_date)->endOfMonth()->format('d-m-Y');
             $date_start = $list['start-date'] = Carbon::createFromFormat('d/m/Y',$data->arabic_date)->startOfMonth()->format('d-m-Y'); 
       
         }




            if (sizeof($result) > 0 && isset($array)) { 

            $period = CarbonPeriod::create($date_start, $date_end);

            foreach ($period as $date) {

                $hello['date'] = $date->format('Y-m-d');
                $hel[] = $hello;

            }
            $period = $hel;
            
            return view('paras.naz', compact('daily_naz', 'month', 'array', 'period', 'course'));
            
           }else{
   
             return redirect()->route('naz_update')->with('Success', 'There is No Result Found');
   
        }  
    
    }



    public function updatenaz(){

        DB::table('daily_naz_updates')
        ->where('id',$_GET["naz_id"])
        ->update(
            array(
    "exam_1"=>isset($_GET["exam_1"])?$_GET["exam_1"]:"",
    "exam_1a"=>isset($_GET["exam_1a"])?$_GET["exam_1a"]:"",
    "exam_2"=>isset($_GET["exam_2"])?$_GET["exam_2"]:"",
    "exam_2a"=>isset($_GET["exam_2a"])?$_GET["exam_2a"]:"",
    "exam_3"=>isset($_GET["exam_3"])?$_GET["exam_3"]:"",
     "exam_3a"=>isset($_GET["exam_3a"])?$_GET["exam_3a"]:"",
     )
    );

    return redirect()->back()->with('Success', 'Updated successfully');;
   
    }

    public function gethifz()
    {
        $daily_naz = DB::table('hifz_updates')
            ->join('students', 'students.id', '=', 'hifz_updates.student_id')
            ->select('students.name', 'hifz_updates.*')
            ->get()
            ->groupBy('name');

        $month = DB::table('hifz_updates')->get()->groupBy('month');

        return view('paras.hifz', compact('daily_naz', 'month'));
    }
    public function checkhifa(Request $request)
    {
        if(isset($_GET["month_id"])){
            $month = $_GET["month_id"];
         }else{
             $month = date('m');
         }
         
         
         $request->session()->put('student_id', $_GET["student_id"]);
         
             $course = DB::table('syllabus_types')->get();
             $daily_naz = DB::table('hifz_updates')
             ->join('students', 'students.id', '=', 'hifz_updates.student_id')
             ->select('students.name', 'hifz_updates.*')
             ->get()->groupBy('name');
                 $month = DB::table('hifz_updates')->get()->groupBy('month');
         
                 if(isset($_GET["month_id"])){
               
                     $result = DB::table('hifz_updates')
                     ->join('students', 'students.id', '=', 'hifz_updates.student_id')  
                     ->where('students.name', '=', $_GET["student_id"])
                     ->where('hifz_updates.month', '=', $_GET["month_id"])
                     ->select('students.id as student_id','hifz_updates.*')
                     ->get();
               
                 }else{
         
                     $result = DB::table('hifz_updates')
                     ->join('students', 'students.id', '=', 'hifz_updates.student_id')
                     ->where('students.name', '=', $_GET["student_id"])
                     ->orderBy('hifz_updates.id','DESC')
                     ->select('students.id as student_id','hifz_updates.*')
                     ->get()->take(30); 
               
                 }
           
                 $i = 0;
         
         
                 foreach ($result as $data) {  
                   if(!isset($request->year)){
                      $condition = true;
         
                   }else{
                       $condition = explode("/",$data->arabic_date)[2] ===  $request->year;
                   }
                 
                 if($condition){
                     $list['month'] = Carbon::createFromFormat('d/m/Y',  $data->arabic_date)->format('m');
                     $list['exam_1'] = $data->exam_1;
                     $list['exam_2'] = $data->exam_2;
                     $list['exam_3'] = $data->exam_3;
                     $list['exam_1a'] = $data->exam_1a;
                     $list['exam1_time'] = $data->exam1_time;
                     $list['exam2_time'] = $data->exam2_time;
                     $list['exam3_time'] = $data->exam3_time;
                     $list['student_id'] = $data->student_id;    
                     $list['remark'] = $data->remark;    
                     $list['exam_2a'] = $data->exam_2a;   
                     $list['arabic_date'] = preg_split("#/#", $data->arabic_date)[0];
                     $list['exam_3a'] = $data->exam_3a;
                     $list['total'] = $data->total;
                     $list['id'] = $data->id;
                     $list['revision'] = $data->revision;
                     $list['n_exam'] = $data->n_exam;
                     $list['old_exam'] = $data->old_exam;
                     $list['startday'] = Carbon::createFromFormat('d/m/Y',   $data->arabic_date)->startOfMonth()->dayOfWeek;
                     $list['date'] = Carbon::createFromFormat('d/m/Y', $data->arabic_date)->format('d');
                     $list['year'] = Carbon::createFromFormat('d/m/Y', $data->arabic_date)->format('Y');
                     $list['totalday'] = Carbon::createFromFormat('d/m/Y',$data->arabic_date)->daysInMonth;
                     $list['end-day'] = Carbon::createFromFormat('d/m/Y', $data->arabic_date)->endOfMonth()->dayOfWeek;
                     $array[] = $list;
                 
                  }
         
                      $date_end = $list['end-date'] = Carbon::createFromFormat('d/m/Y',$data->arabic_date)->endOfMonth()->format('d-m-Y');
                      $date_start = $list['start-date'] = Carbon::createFromFormat('d/m/Y',$data->arabic_date)->startOfMonth()->format('d-m-Y'); 
                
                  }
         
         
         
         
                     if (sizeof($result) > 0 && isset($array)) { 
         
                     $period = CarbonPeriod::create($date_start, $date_end);
         
                     foreach ($period as $date) {
         
                         $hello['date'] = $date->format('Y-m-d');
                         $hel[] = $hello;
         
                     }
                     $period = $hel;
            return view('paras.hifz', compact('daily_naz', 'month', 'array', 'period'));
        } else {
            return redirect()->route('hifz_update')->with('Success', 'There is No Result Found');
        }
    }

    public function getdor()
    {

        $daily_naz = DB::table('dor_updates')
        ->join('students', 'students.id', '=', 'dor_updates.student_id')
        ->select('students.name', 'dor_updates.*')
        ->get()
        ->groupBy('name');
       
        $month = DB::table('dor_updates')->get()
        ->groupBy('month');
        
        return view('paras.dor', compact('daily_naz', 'month'));

    }

    public function checkdor(Request $request)
    {
        $daily_naz = DB::table('dor_updates')
            ->join('students', 'students.id', '=', 'dor_updates.student_id')
            ->select('students.name', 'dor_updates.*')
            ->get()
            ->groupBy('name');
        $month = DB::table('dor_updates')->get()->groupBy('month');

            $result = DB::table('dor_updates')
            ->where('students.name', '=', $request->student_id)
            ->where('dor_updates.month', '=', $request->month_id)
            ->join('students', 'students.id', '=', 'dor_updates.student_id')
            ->join('users', 'users.id', '=', 'dor_updates.teacher_id')
            ->select('students.name', 'users.full_name as teacher', 'dor_updates.*')
            ->get();
             $i = 0;


        foreach ($result as $data) {
                  if(explode("/",$data->arabic_date)[2] ===  $request->year){
              
                $list['month'] = Carbon::createFromFormat('d/m/Y',  $data->arabic_date)->format('m');
                $list['exam_1'] = $data->exam_1;
                $list['exam_2'] = $data->exam_2;
                $list['exam_3'] = $data->exam_3;
                $list['exam_1a'] = $data->exam_1a;
                $list['exam_2a'] = $data->exam_2a;
                $list['arabic_date'] = preg_split("#/#", $data->arabic_date)[0];
                $list['exam_3a'] = $data->exam_3a;
                $list['total'] = $data->total;
                $list['id'] = $data->id;
                $list['name'] = $data->name;
                $list['revision'] = $data->revision;
                $list['n_exam'] = $data->n_exam;
                $list['old_exam'] = $data->old_exam;
                $list['startday'] = Carbon::createFromFormat('d/m/Y',   $data->arabic_date)->startOfMonth()->dayOfWeek;
                $list['date'] = Carbon::createFromFormat('d/m/Y', $data->arabic_date)->format('d');
                $list['year'] = Carbon::createFromFormat('d/m/Y', $data->arabic_date)->format('Y');
                $list['totalday'] = Carbon::createFromFormat('d/m/Y',$data->arabic_date)->daysInMonth;
                $list['end-day'] = Carbon::createFromFormat('d/m/Y', $data->arabic_date)->endOfMonth()->dayOfWeek;
                $array[] = $list;
              
                }
    
                 $date_end = $list['end-date'] = Carbon::createFromFormat('d/m/Y',$data->arabic_date)->endOfMonth()->format('d-m-Y');
                 $date_start = $list['start-date'] = Carbon::createFromFormat('d/m/Y',$data->arabic_date)->startOfMonth()->format('d-m-Y');
                  
        }
        if (sizeof($result) > 0) {
            $period = CarbonPeriod::create($date_start, $date_end);
            foreach ($period as $date) {
                $hello['date'] = $date->format('Y-m-d');
                $hel[] = $hello;
            }

            $period = $hel;

            return view('paras.dor', compact('daily_naz', 'month', 'array', 'period'));

        } else {
            return redirect()->route('hifz_update')->with('Success', 'There is No Result Found');
        }
    }

    public function getendpara(Request $request)
    {

        $pre = DB::table('pre_ends')
            ->join('students', 'students.id', '=', 'pre_ends.student_id')
            ->join('syllabus_types', 'syllabus_types.id', '=', 'pre_ends.course_id')
            ->where('pre_ends.status', '=', '0')
            ->select('students.name', "syllabus_types.title as course", 'pre_ends.*')
            ->get();

        return view('month.endpre', compact('pre'));

    }

    public function getpara(Request $request)
    {
        $check = DB::table('student_based_paras')
            ->where('student_based_paras.student_id', '=', $request->student_id)
            ->first();
        
        $id = $check->id;

        $date = DB::table('student_based_paras')
            ->join('paras', 'paras.id', '=', 'student_based_paras.para_order')
            ->where("student_based_paras.student_id", $request->student_id)
            ->whereBetween('student_based_paras.id', array($id, $id + $request->para_id - 1))
            ->pluck("paras.para_name", "student_based_paras.id");
             session()->put('para1', $request->para_id);
              session()->pull('para_id');

        return response()->json($date);
    }

    
    public function getpara_2(Request $request)
    {  
        if (!empty($request->par_id)) {
          
            $student = DB::table('students')
                ->where('students.id', '=', $request->student_id)
                ->first();
                 
            $hello = DB::table('syllabus_adds')
                ->where('student_id', '=', $student->id)
                ->where('course_id', '=', $student->course_id)
                ->whereNotNull('target')
                ->where('no_of_parah', 'like', '%Para%')
                ->get();

            for ($i = 0; $i < sizeof($hello); $i++) {
                $array = explode(",", $hello[$i]->target);
                $date[] = $array;
            }

            $filter = call_user_func_array('array_merge', $date);
            $fil = array_filter($filter);
            $para1 = end($fil);
            $para2 = $request->par_id;

        } elseif (session('para_id') && $request->para_id !== "1/2") {
        
            $para1 = session('para_id');
            $para2 = $request->para_id;
        
        } elseif ($request->para1 == "1/2") {
          
            $para1 = session('para_id') - 1;
            $para2 = $request->para_id;
        
        } elseif (empty($request->para1) || session('para_id')) {
            $para1 = session('para1');
            $para2 = $request->para_id;
        } else {
            $para1 = $request->para1;
            $para2 = $request->para_id;
        }

        if (empty($para1)) {
            if ($request->year != 1) {
                $student = DB::table('students')
                    ->where('students.id', '=', $request->student_id)
                    ->first();
                $hello = DB::table('syllabus_adds')
                    ->where('student_id', '=', $student->id)
                    ->where('course_id', '=', $student->course_id)
                    ->whereNotNull('target')
                    ->where('no_of_parah', 'like', '%Para%')
                    ->get();

                for ($i = 0; $i < sizeof($hello); $i++) {
    
                    $array = explode(",", $hello[$i]->target);
                    $date[] = $array;
               
                }

                $filter = call_user_func_array('array_merge', $date);
                $fil = array_filter($filter);
                $para1 = end($fill);
        
            } 
         

 
            
               if (false){
                   
                $check = DB::table('student_based_paras')
                    ->where('student_based_paras.student_id', '=', $request->student_id)
                    ->get();
                $id = $check[0]->id;
                $date = DB::table('student_based_paras')
                    ->join('paras', 'paras.id', '=', 'student_based_paras.para_order')
                    ->where("student_based_paras.student_id", $request->student_id)
                    ->whereBetween('student_based_paras.id', array($id, $id + $request->para_id - 1))
                    ->pluck("paras.para_name", "student_based_paras.id");
                session()->put('para1', $request->para_id);
                session()->pull('para_id');
                return response()->json($date);

            }
        }


        $data = DB::table('student_based_paras')
            ->join('paras', 'paras.id', '=', 'student_based_paras.para_order')
            ->skip($para1)->take($para2)
            ->pluck("paras.para_name", "student_based_paras.id");

        $lastvalue = DB::table('student_based_paras')
            ->select("student_based_paras.id as id")
            ->skip($para1)
            ->take($para2)
            ->get();


        for ($i = 0; $i < sizeof($lastvalue); $i++) {
            $value1 = $lastvalue[$i]->id;
        }
          
        session()->put('para_id', $value1);
        session()->put('para1', $value1);
        return $data;
    }
}