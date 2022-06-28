<?php

namespace App\Http\Controllers;

use App\Models\syllabus;
use App\Models\Course;
use App\Models\Syllabus_type;
use App\Models\month;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SyllabusController extends Controller
{
    public function index()
    {
        $syllabus_types = DB::table('syllabus_types')->pluck("title", "id");
        $syllabus = DB::table('syllabus_types')->get();
        $syllabi = DB::table('syllabi')
        ->join('syllabus_types', 'syllabus_types.id', '=', 'syllabi.syllabus_id')
        ->select('syllabi.*', 'syllabus_types.title as syllabus_type')
        ->get();
        
        return view('syllabus.index', compact( 'syllabus', 'syllabi'));

    }

    public function edit(Request $request,$id)
    {
        $syllabi = DB::table('syllabi')
        ->where('syllabi.id','=',$id)
        ->join('syllabus_types', 'syllabus_types.id', '=', 'syllabi.syllabus_id')

        ->select('syllabi.*', 'syllabus_types.title as syllabus_type')
        ->get();
        $syllabus = DB::table('syllabus_types')->get();

        foreach($syllabi as $syllabi){
         return view('syllabus.edit', compact('syllabi','syllabus',));
        }
    }
    public function update(Request $request,$id)
    {
        $question = Syllabus::find($id);
        $question->syllabus_id = $request->get('syllabus_id');
        $question->total = $request->get('total');
        $question->target1 = $request->get('target1');
        $question->target2 = $request->get('target2');
        $question->target3 = $request->get('target3');
        $question->target4 = $request->get('target4');
        $question->target5 = $request->get('target5');
        $question->target6 = $request->get('target6');
        $question->save();
        return redirect()->route('syllabus.index')
       ->with('success, syllabus updated successfully');
    }

    public function store(Request $request)
    {

        $request->validate([

            'syllabus_id' => 'required',
            'total' => 'required',
            'target1' => 'required',
            'target2' => 'required',
            'target3' => 'required',
            'target4' => 'required',
            'target5' => 'required',
            'target6' => 'required'

        ]);
        
        syllabus::create($request->all());
        return redirect()->route('syllabus.index')
            ->with('success', 'syllabus created successfully.');

    }




    public function destroy(syllabus $syllabus, $id)
    {
        $syllabus = syllabus::find($id);
        $syllabus->delete();
        return redirect()->route('syllabus.index')->with('success', 'syllabus deleted successfully');

    }


    public function getmonth()
    {
        $month = DB::table('months')->get();
        return view('month.index', compact('month'));
    }


    public function addmonth(Request $request)
    {
        $request->validate([
            'month' => 'required',
        ]);
        month::create($request->all());
        return redirect()->route('getmonth')->with('success', 'date Added successfully.');
    }

    public function deletetmonth($id)
    {

        $syllabus = month::find($id);
        $syllabus->delete();
        return redirect()->route('getmonth')
            ->with('success', 'month deleted successfully');
    }


    public function  monthupdate(Request $request,$id)
    {
        $question = month::find($id);
        $question->month= $request->get('title');
        $question->save();
          return redirect()->route('getmonth')
        ->with('success, Month updated successfully');
    }


    ///

    public function report(){
     
        $teacher =  DB::table('users')
       ->get();

        return  view('course.report', compact("teacher"));

    }


    public function reportit(){

        $date1 = strtotime($_GET['date1']);
        $date2 = strtotime($_GET['date2']);



        $t_id = $_GET['teacher_id'];
        $teacher =  DB::table('users')
        ->get();
         
        
        $student = DB::table('daily_naz_updates')
            //  ->whereBetween('daily_naz_updates.arabic_date',array($date1,$date2))
             ->where('daily_naz_updates.teacher_id',$t_id)
             ->join('syllabus_types','syllabus_types.id','daily_naz_updates.course_id')
             ->join('students','students.id','daily_naz_updates.student_id')
             ->select(
              'students.name as student_name',
              'syllabus_types.title as course',
              'daily_naz_updates.arabic_date',
              'daily_naz_updates.exam_1',
              'daily_naz_updates.exam_1a',
              'daily_naz_updates.exam_2',
              'daily_naz_updates.exam_2a',
              'daily_naz_updates.exam_3',
              'daily_naz_updates.exam_3a',
              'daily_naz_updates.exam1_time',
              'daily_naz_updates.exam2_time',
              'daily_naz_updates.exam3_time',
              'daily_naz_updates.teacher_id',
             )
             ->orderBy('daily_naz_updates.id','asc')
             ->get();
    




             $date1 = date('d/m/Y', $date1);
             $date2 = date('d/m/Y', $date2);
     

             $exp_date_1 = explode("/", $date1);
             $req_date_1= $exp_date_1[2] . $exp_date_1[1] . $exp_date_1[0];

             $exp_date2 = explode("/", $date2);
             $req_date2= $exp_date2[2] . $exp_date2[1] . $exp_date2[0];

       
                foreach ($student as $key) {
                
                     $exp_date1 = explode("/", $key->arabic_date == null ? "" : $key->arabic_date);
                     $req_date1 = $exp_date1[2] . $exp_date1[1] . $exp_date1[0];
                
                  if ((int)$req_date1 > (int)$req_date_1 && (int)$req_date1 < (int)$req_date2  ) {
                   
                     $logArray = array();

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
                     $logArray['teacher_id'] = $key->teacher_id == null ? "" : $key->teacher_id;
                     $logArray['course'] = $key->course == null ? "" : $key->course;
                     $logArray['student_name'] = $key->student_name == null ? "" : $key->student_name;
      
                     $student1[] = $logArray;

                }

             }


 if(!isset($student1)){
     $student1=array();
 }

 $student = $student1;

             
 return  view('course.report', compact("teacher","student"));

    }

    public function onedayreport($id){

$check1 = explode('--',$id)[0];
$check2 = explode('--',$id)[1];

$da = str_replace('-', '/', $check2);


$student = DB::table('daily_naz_updates')
->where('daily_naz_updates.arabic_date',$da )
->where('daily_naz_updates.teacher_id',$check1)
->join('syllabus_types','syllabus_types.id','daily_naz_updates.course_id')
->join('students','students.id','daily_naz_updates.student_id')
->join('users','users.id','daily_naz_updates.teacher_id')
->select(
 'students.name as student_name',
 'syllabus_types.title as course',
 'daily_naz_updates.arabic_date',
 'daily_naz_updates.exam_1',
 'daily_naz_updates.exam_1a',
 'daily_naz_updates.exam_2',
 'daily_naz_updates.exam_2a',
 'daily_naz_updates.exam_3',
 'daily_naz_updates.exam_3a',
 'daily_naz_updates.exam1_time',
 'daily_naz_updates.exam2_time',
 'daily_naz_updates.exam3_time',
 'daily_naz_updates.teacher_id',
 'users.full_name as teacher_name',
)
->orderBy('daily_naz_updates.id','asc')
->get();


   return  view('course.onedayreport', compact("student"));

    }

}
