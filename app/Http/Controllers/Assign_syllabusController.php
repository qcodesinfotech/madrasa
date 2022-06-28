<?php

namespace App\Http\Controllers;
use App\Models\Assign_syllabus;
use App\Models\Para;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Carbon\Carbon ;

class Assign_syllabusController extends Controller
{
    public function index()
    {

        $student = DB::table('students')->get();
        $parah = DB::table('paras')->get();
        $month = DB::table('months')->get();
        $syllabus_type = DB::table('syllabus_types')->get();
        return view('assign.index', compact('syllabus_type', 'student', 'month', 'parah'));
        
    }

    public function edit(Request $request, $id)
    {
        $student = DB::table('students')->get();
        $month = DB::table('months')->get();
        $syllabus_type = DB::table('syllabus_types')->get();
        $syllabi = DB::table('assign_syllabi')
            ->where('assign_syllabi.id', '=', $id)
            ->join('students', 'students.id', '=', 'assign_syllabi.student_id')
            ->join('months', 'months.id', '=', 'assign_syllabi.month')
            ->join('syllabus_types', 'syllabus_types.id', '=', 'assign_syllabi.type_syllabus_id')
            ->select('assign_syllabi.*', 'syllabus_types.title as syllabus_type', 'students.name', 'months.month as months')
            ->get();
        foreach ($syllabi as $syllabi) {
            return view('assign.edit', compact('syllabi', 'course', 'syllabus_type', 'student', 'month'));
        }
    }

    public function update(Request $request, $id)
    {
        $question = Assign_syllabus::find($id);
        $question->student_id = $request->get('name');
        $question->type_syllabus_id = $request->get('course');
        $question->month = $request->get('month');
        $question->save();
        return redirect()->route('getassign')
            ->with('success, syllabus updated successfully');
    }
    
    public function destroy($id)
    {
        $assign = Assign_syllabus::find($id);
        $assign->delete();
        return redirect()->route('getassign')->with('success', 'syllabus deleted successfully');
    }
    public function getstudent(Request $request)
    {
        $date = DB::table('students')
            ->where("id", $request->student_id)
            ->pluck("Admission_date", "id");
        return response()->json($date);
    }
    public function getsyllabi(Request $request)
    {
        $month = DB::table('months')
            ->whereBetween('id', array($request['date'], 20))->get();
        $month_1 = DB::table('months')->get();
        foreach ($month as $month_start) {
            $dat[] = $month_start->month;
        }
        foreach ($month_1 as $month_start) {
            $dat[] = $month_start->month;
        }
        
        $data = DB::table('syllabi')
            ->where("syllabi.syllabus_id", $request->course)
            ->join('syllabus_types', 'syllabus_types.id', '=', 'syllabi.syllabus_id')
            ->select('syllabi.*', 'syllabus_types.title as syllabus')
            ->get();
            
        if (sizeof($data) > 0) {
            for ($index = 0; $index < count($data); $index++) {
                $day = array();
                $day['course'] =   $data[$index]->target1;
                $day['month'] = $dat[$index];
                $final[] = $day;
            }
            return $final;
        }
        return array("month" => "0");
    }

    public function getdetail(Request $request, $id)
    {
        $detail = DB::table('syllabus_adds')
            ->join('students', 'students.id', '=', 'syllabus_adds.student_id')
            ->join('syllabus_types', 'syllabus_types.id', '=', 'syllabus_adds.course_id')
            ->join('months', 'months.id', '=', 'syllabus_adds.month')
            ->where('students.name', '=', $id)  
            ->get();

           
        return view('assign.detail', compact('detail'));
    }




    public function getassign()
    {
        $syllabi = DB::table('syllabus_adds')
            ->join('students', 'students.id', '=', 'syllabus_adds.student_id')
            ->select('syllabus_adds.*', 'students.name')
            ->get()
            ->groupBy('name');   
        return view('assign.assign', compact('syllabi'));
    }
 
    public function addassign(Request $request)
    {
        $question = new Assign_syllabus;
        $question->student_id = $request->get('student');
        $question->type_syllabus_id = $request->get('course');
        $question->month = $request->get('month');
        $question->save();
        $value = $question->id;
        $date = DB::table('syllabi')
            ->where("syllabi.syllabus_id", $request->course)
            ->join('syllabus_types', 'syllabus_types.id', '=', 'syllabi.syllabus_id')
            ->select('syllabi.*', 'syllabus_types.title as syllabus')
            ->get();
        foreach ($date as $data) {
            $data = array("assign_id" => $value, "syllabus_id" => $data->id, "created_at" => Carbon::now(), "updated_at" => now());
            DB::table('details')->insert($data);
        }
        return redirect()->route('getassign')
            ->with('success', 'syllabus created successfully.');
    }

public function arabicdate(Request $request){
 
    $date= date('d-m-Y', strtotime($request->value."days"));
    $client = new Client();
    $res = $client->request('GET', 'https://api.aladhan.com/v1/gToH?date='.$date);

    $arabicdate = $res->getBody();
    $date1 = explode(',',$arabicdate);
     $date2=explode(':',$date1[2]);
     $date= date('Y-m-d', strtotime("0 days"));
     $datestore= date('d-m-Y', strtotime("0 days"));

$check = DB::table('moon_dates')
->orderByDesc('created_at')
->whereDate("created_at",$date)
->first();

if(!empty($check)){
 $updated = DB::table('moon_dates')
->where('id', $check->id)
->update([
    'value' => $request->value,
    'english_date' =>$datestore,
    'arabic_date' => $date2[3],
]);

}else{

    $updated=false;

}

if($updated){

    return redirect()->route('student');

}else{

    return redirect()->route('student');
    
}

}




    
}
