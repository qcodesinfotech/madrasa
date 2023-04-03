<?php

namespace App\Http\Controllers;

use App\Model\Sick;
use Illuminate\Http\Request;
use  Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class SickController extends Controller
{

public function listsickdetail()
    {
        $sick_leave = DB::table('sick_leave_details')
            ->join('students', 'students.id', 'sick_leave_details.student_id')
            ->select('sick_leave_details.*','students.name as student_name')
           ->get()->groupBy('student_name');



            //->get();
            $students = DB::table('students')->get();

            // return ($sick_leave);

        return view('sickdetail.index', compact('sick_leave','students'));
    }

    public function editsickdetail(Request $request)
    {
        $sickleave = DB::table('sick_leave_details')
            ->where('sick_leave_details.id', $request->id)
            ->join('students', 'students.id', 'sick_leave_details.student_id')
            ->select('sick_leave_details.*','students.name as student_name')
            ->first();
            $students = DB::table('students')->get();

            // return $sickleave;
        return view('sickdetail.edit', compact('sickleave', 'students',));
    }

    public function updatesickdetail(Request $request, $id)
    {
        DB::table("sick_leave_details")
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
        return redirect()->route('sickdetail');
    }

    public function destroysickdetail(Request $request)
    {
        DB::table('sick_leave_details')
            ->where('id', $request->id)
            ->delete();
     
            return redirect()->route('sickdetail');
    }

    public function addsickdetail(Request $request)
    {
        DB::table("sick_leave_details")
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
        return redirect()->route('sickdetail');
    }


    public function detailsview(Request $request, $id)
    {
        $sick_leave = DB::table('sick_leave_details')
            ->join('students', 'students.id', 'sick_leave_details.student_id')
            ->select('sick_leave_details.*','students.name as student_name')
            ->where('students.name', $request->id)
            ->get();



            //->get();
            $students = DB::table('students')->get();

            // return ($sick_leave);

        return view('sickdetail.details', compact('sick_leave','students'));
    }


public function sick_detail(){
     $sick = DB::table('patients_list')
    //  ->where('patients_list.status',0)
     ->join('students','students.id','patients_list.student_id')
     ->join('syllabus_types', 'syllabus_types.id', 'students.course_id')
     ->select('patients_list.*','students.name as student_name',
     'students.admission_no as student_admission_no',
     'students.address as student_address','students.course_id as student_course_id',
     'syllabus_types.title as student_course')
     ->orderBy('patients_list.id', 'desc')
     ->get()
     ->groupBy('student_name');
    //  return $sick;
     return view('sickdetail.sick_student', compact('sick'));
}


public function sick_detail_view(Request $request){
    $sick_view = DB::table('sick_leave_details')
    ->join('patients_list','patients_list.id','sick_leave_details.patient_id')
    ->join('students','students.id','patients_list.student_id')
    ->join('users','users.id','sick_leave_details.teacher_id')
    ->where('students.id',$request->id)
    ->select('sick_leave_details.*','students.name as student_name','students.admission_no as  admission_no','students.address as address','users.full_name as teacher_name')
    ->get();
    // ->groupBy('student_name');
    // return $sick_view;
    return view('sickdetail.view', compact('sick_view'));
}



}

