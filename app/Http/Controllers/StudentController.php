<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Syllabus_type;
use App\Models\Structure;
use App\Models\Course;
use App\Models\Pre_end;
use App\Models\Syllabus_add;
use App\Models\Teacher;
use App\Models\student_based_para;
use Illuminate\Http\Request;
use  Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $course = DB::table('syllabus_types')->get();
        $student =  DB::table('students')
            ->join('syllabus_types', 'syllabus_types.id', 'students.course_id')
            ->select('students.*', 'syllabus_types.title as course')
            ->get();

        return view('student.index', compact('student', 'course'));
    }

    public function teachersdel($id)
    {

        $data = DB::table("teachers")
            ->where("teachers.student_id", $id)
            ->delete();

        return redirect()->back();
    }

    public function searchstudent(Request $request)
    {
        $course = DB::table('syllabus_types')->get();
        $student1 =  DB::table('students')
            ->where(DB::raw('lower(students.name)'), 'like', '%' . strtolower($request->student) . '%')
            ->join('syllabus_types', 'syllabus_types.id', 'students.course_id')
            ->select('students.*', 'syllabus_types.title as course')
            ->get();
        if (sizeof($student1) > 0) {
            return view('student.index', compact('student1', 'course'));
        } else {
            return redirect()->route('student.index')
                ->with('success', '0 result  found');
        }
    }


    public function viewstudent($id)
    {

        $data = DB::table('teachers')
            ->join('users', 'users.id', '=', 'teachers.teacher_id')
            ->join('students', 'students.id', 'teachers.student_id')
            ->where('users.full_name', $id)
            ->select('students.name', 'students.id')
            ->get();

        return view('course.studentdetail', compact('data'));
    }

   
    public function leave(){

        $course = DB::table('syllabus_types')
        ->get();

    return view('course.leave', compact('course'));

    }


    public function leavepost(Request $request){
        
        
        $student=DB::table('students')
        ->where('course_id',$request->course_id)
        ->select('id')
        ->get();
        
        $period = CarbonPeriod::create($request->from_date, $request->to_date);
        foreach ($period as $date) {
            foreach($student as $stud){
                DB::table("daily_naz_updates")
                ->where('course_id',$request->course_id)
                  ->insert(
                      array(
                          "student_id"=>$stud->id,
                          "arabic_date" =>  $date->format('d/m/Y'),
                          "month" =>  $date->format('m'),
                          "remark" => $request["remark"],
                          "course_id" => $request["course_id"],
                      )
                  );
            }
        }

        return redirect('leave')
        ->with('success, holiday updated successfully');;
     

    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:students,name',
        ]);

        $dist = $request['district'];
        $state = $request['state'];
        $pincode = $request['pincode'];
        $city = $request['city'];
        $address = $dist . "," . $state . "," . $city . "," . $pincode;

        $question = new Student;
        $question->name = $request->get('name');
        $question->admission_no = $request->get('admission_no');
        $question->father_name = $request->get('father_name');
        $question->father_occupation = $request->get('father_occupation');
        $question->date_of_birth = $request->get('date_of_birth');
        $question->address = $address;
        $question->aadhar_no = $request->get('aadhar_no');
        $question->course_id = $request->get('course');
        $question->mobile_no = $request->get('mobile_no');
        $question->whatsapp_no = $request->get('whatsapp_no');
        $question->monthly_donation = $request->get('monthly_donation');
        $question->blood_group = $request->get('blood_group');
        $question->admission_date = $request->get('admission_date');
        $question->previous_school = $request->get('previous_school');

        if ($request->file('proof1')) {
            $file = $request->file('proof1');
            $destinationPath = 'students_photo/';
            $profileImage1 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage1);
            $question['proof1'] = $profileImage1;
        }
        if ($request->file('proof2')) {

            $file = $request->file('proof2');
            $destinationPath = 'students_photo/';
            $profileImage1 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage1);
            $question['proof2'] = $profileImage1;
        }
        if ($request->file('proof3')) {

            $file = $request->file('proof3');
            $destinationPath = 'students_photo/';
            $profileImage2 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage2);
            $question['proof3'] = $profileImage2;
        }
        if ($request->file('proof4')) {

            $file = $request->file('proof4');
            $destinationPath = 'students_photo/';
            $profileImage3 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage3);
            $question['proof4'] = $profileImage3;
        }

        if ($request->file('proof5')) {
            $file = $request->file('proof5');
            $destinationPath = 'students_photo/';
            $profileImage4 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage4);
            $question['proof5'] = $profileImage4;
        }

        if ($request->file('proof6')) {
            $file = $request->file('proof6');
            $destinationPath = 'students_photo/';
            $profileImage5 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage5);
            $question['proof6'] = $profileImage5;
        }

        if ($request->file('student_pic')) {

            $file = $request->file('student_pic');
            $destinationPath = 'students_photo/';
            $profileImage6 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage6);
            $question['student_pic'] = $profileImage6;

        }

        $question->save();

     
             /////////////////----    check naz hifz Redirect    ---///////////////////////////////


        $para_order = array("30", "29", "28", "27", "26", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25");


        $student = DB::table('students')
            ->where('students.id', '=', $question->id)
            ->first();

        $course =  DB::table('syllabus_types')
            ->where('id', $student->course_id)
            ->first();

        $naz = 'naz';
        $hifz = 'hifz';

        if (preg_match("/{$naz}/i", $course->title)) {
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

            $request->session()->put('student_id', $student->id);

            if (preg_match("/{$naz}/i", $course->title)) {

                return redirect('nazview');
            } else if (preg_match("/{$hifz}/i", $course->title)) {

                return redirect('hifzview');
            } else {

                return redirect('assign');
            }
        } else {


            $i = 1;
            $student_id = $question->id;

            foreach ($para_order as $save_exam) {
                $i++;
                $question = new student_based_para;
                $question->para_order = $save_exam;
                $question->student_id = $student_id;
                $question->para_id = $i;
                $question->save();
            }

            $request->session()->put('student_id', $student_id);

            if (preg_match("/{$naz}/i", $course->title)) {

                return redirect('nazview');
            } else if (preg_match("/{$hifz}/i", $course->title)) {

                return redirect('hifzview');
            } else {

                return redirect('assign');
            }
        }


        //////////////////////////   -----------  End check naz hifz Redirect ----------  ///////////////////////////////

        return redirect('assign');
    }


    public function edit(Student $student)
    {
        $course = DB::table('syllabus_types')->get();
        $students =  DB::table('students')
            ->where('students.id', '=', $student->id)
            ->join('syllabus_types', 'syllabus_types.id', 'students.course_id')
            ->select('students.*', 'syllabus_types.title as course')
            ->get();
        foreach ($students as $student) {
            return view('student.edit', compact('student', 'course'));
        }
    }
    public function update(Request $request, $id)
    {

        $question = Student::find($id);
        $question->name = $request->get('name');
        $question->admission_no = $request->get('admission_no');
        $question->father_name = $request->get('father_name');
        $question->father_occupation = $request->get('father_occupation');
        $question->date_of_birth = $request->get('date_of_birth');
        $question->aadhar_no = $request->get('aadhar_no');
        $question->course_id = $request->get('course');
        $question->mobile_no = $request->get('mobile_no');
        $question->address =  $request->get('address');
        $question->whatsapp_no = $request->get('whatsapp_no');
        $question->monthly_donation = $request->get('monthly_donation');
        $question->admission_date = $request->get('admission_date');
        $question->blood_group = $request->get('blood_group');
        $question->previous_school = $request->get('previous_school');

        if ($request->file('proof1')) {
            $file = $request->file('proof1');
            $destinationPath = 'students_photo/';
            $profileImage1 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage1);
            $question['proof1'] = $profileImage1;
        }

        if ($request->file('proof2')) {

            $file = $request->file('proof2');
            $destinationPath = 'students_photo/';
            $profileImage1 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage1);
            $question['proof2'] = $profileImage1;
        }

        if ($request->file('proof3')) {

            $file = $request->file('proof3');
            $destinationPath = 'students_photo/';
            $profileImage2 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage2);
            $question['proof3'] = $profileImage2;
        }

        if ($request->file('proof4')) {

            $file = $request->file('proof4');
            $destinationPath = 'students_photo/';
            $profileImage3 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage3);
            $question['proof4'] = $profileImage3;
        }

        if ($request->file('proof5')) {
            $file = $request->file('proof5');
            $destinationPath = 'students_photo/';
            $profileImage4 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage4);
            $question['proof5'] = $profileImage4;
        }

        if ($request->file('proof6')) {
            $file = $request->file('proof6');
            $destinationPath = 'students_photo/';
            $profileImage5 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage5);
            $question['proof6'] = $profileImage5;
        }



        if ($request->file('student_pic')) {

            $file = $request->file('student_pic');
            $destinationPath = 'students_photo/';
            $profileImage6 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage6);
            $question['student_pic'] = $profileImage6;
        }
        $question->save();

        return redirect()->route('student.index')
            ->with('success, Question updated successfully');
    }

    public function syllabusupdate(Request $request, $id)
    {
        $question = Syllabus_type::find($id);
        $question->title = $request->get('title');
        $question->year = $request->get('year');
        $question->save();

        return redirect()->route('syllabus_types')
            ->with('success, syllabus_types updated successfully');
    }




    public function supdate(Request $request, $id)
    {
        $question = Syllabus_type::find($id);
        $question->title = $request->get('title');
        $question->save();
        return redirect()->route('syllabus_types')
            ->with('success, syllabus_types updated successfully');
    }
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('student.index')
            ->with('success', 'student deleted successfull');
    }
    public function syllabus_types()
    {

        $syllabus = DB::table('syllabus_types')->get();
        return view('tsyllabus.index', compact('syllabus'));
    }
    public function add_tsyllabus(Request $request)
    {
        $data = array("title" => $request['title'], "year" => $request['year'], "created_at" => Carbon::now(), "updated_at" => now());
        DB::table('syllabus_types')->insert($data);
        return redirect()->route('syllabus_types')
            ->with('success', 'syllabus successfull');
    }
    public function deletetsyllabus($id)
    {
        $syllabus = Syllabus_type::find($id);
        $syllabus->delete();
        return redirect()->route('syllabus_types')
            ->with('success', 'syllabus deleted successfull');
    }
    public function deleteteacher($id)
    {


        $l = DB::table("users")->where('full_name', '=', $id)->first();

        DB::table("teachers")
            ->where('teacher_id', $l->id)
            ->delete();

        return redirect()->route('groupteacher')
            ->with('success', 'teacher deleted successfull');
    }

    public function editsyllabus(Request $request, $id)
    {
        $pannel = DB::table('syllabus_types')
            ->where('syllabus_types.id', '=', $id)
            ->get();
        foreach ($pannel as $syllabus) {
            return view('tsyllabus.edit', compact('syllabus'));
        }
    }
    public function editmonth(Request $request, $id)
    {
        $pannel = DB::table('months')
            ->where('months.id', '=', $id)
            ->get();
        foreach ($pannel as $month) {
            return view('month.edit', compact('month'));
        }
    }

    public function groupteacher()
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
            ->whereNotIn('id', $arr)
            ->get();

        $teacher = DB::table("users")->get();
        $groupteacher = DB::table('teachers')
            ->join('students', 'students.id', '=', 'teachers.student_id')
            ->join('users', 'users.id', '=', 'teachers.teacher_id')
            ->select('users.full_name', 'students.name', 'teachers.id', 'teachers.created_at')
            ->get()->groupBy('full_name');


        return view('course.index', compact('groupteacher', 'student', 'teacher'));
    }

    public function add_teacher(Request $request)
    {

        $request->validate([
            'student_id' => 'required',
            'teacher_id' => 'required',
        ]);

        $day1 = $request['student_id'];
        $teacher_id = $request['teacher_id'];


        foreach ($day1 as $save_exam) {

            $question = new Teacher;
            $question->student_id = $save_exam;
            $question->teacher_id = $teacher_id;
            $question->save();
        }

        return redirect()->route('groupteacher')->with('success', 'Teacher Added successfully.');
    }




    public function  courseupdate(Request $request, $id)
    {


        $question = Course::find($id);
        $question->title = $request->get('title');
        $question->save();
        return redirect()->route('course')
            ->with('success, Course updated successfully');
    }

    public function precorrect(Request $request, $id)
    {

        $pre = DB::table('pre_ends')
        ->where('pre_ends.id', '=', $id)
        ->first();
     
        $value1= explode("-",$pre->target)[0];
        $value2=explode("-",$pre->target)[1];

     
        if($value1 == 0){
      
            $con = false;
     
        }else{
       
            $con = true;
       
        }



if($value2 == 7){
    $con1 = true;
}else{
    $con1= false;
}




        if($con && $con1){

        $add_stur = new Structure();
        $add_stur->para_id = $value1 ;
        $add_stur->teacher_id = $pre->teacher_id;
        $add_stur->student_id = $pre->student_id;
        $add_stur->arabic_date = $pre->date;
        $add_stur->course_id = $pre->course_id;
        $add_stur->save();

        }

        $num = Carbon::createFromFormat('d/m/Y',$pre->date)->format('m');
        $num = ltrim($num, '0');

        $assign = DB::table("syllabus_adds")
            ->where("syllabus_adds.student_id", $pre->student_id)
            ->where("syllabus_adds.month", $num)
            ->where('syllabus_adds.course_id', $pre->course_id)
            ->first();

        if(empty($assign)){

            return redirect()->route('getendpara')
            ->with(
                'success', 
                 'Your status not updated target course or student is invalid.'
                 );
      
        }else{

            $question = Pre_end::find($pre->id);
            $question->status = 1;
            $question->save();

            if (empty($assign->c_target)) {
        
                $data = "";
        
            }else{
        $data = $assign->c_target . ",";
        }
           
         
            if($value1 == 0 || $value2 == 7){
        
               $add = DB::table("syllabus_adds")
                ->where('id', $assign->id)
                ->update([
                    'c_target' => $data . "" . explode('-', $pre->target)[1]
                ]);
           
            }
           }

        return redirect()->route('getendpara')
            ->with('success', 'Your status updated .');
    }

    public function precancel(Request $request, $id)
    {
        $pre = DB::table('pre_ends')
            ->where('pre_ends.id', '=', $id)
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
            return redirect()->route('getendpara')
                ->with('success', 'Your status updated.');
        }
        return redirect()->route('getendpara')
            ->with('success', 'Your status updated .');
    }


    public function add_hifz(Request $request)
    {


        $select1 = $request->select1;

        $select2 = $request->select2;

        $select3 = $request->select3;

        $select4 = $request->select4;

        $select = $request->select1;
        $para[] = $request->para_id1;
        $para[] = $request->para_id2;
        $para[] = $request->para_id3;
        $para[] = $request->para_id4;
        $para[] = $request->para_id5;
        $para[] = $request->para_id6;
        $para[] = $request->para_id7;
        $para[] = $request->para_id8;
        $para[] = $request->para_id9;
        $para[] = $request->para_id10;
        $para[] = $request->para_id11;
        $para[] = $request->para_id12;


        // year2

        $para[] = $request->para_id13;
        $para[] = $request->para_id14;
        $para[] = $request->para_id15;
        $para[] = $request->para_id16;
        $para[] = $request->para_id17;
        $para[] = $request->para_id18;
        $para[] = $request->para_id19;
        $para[] = $request->para_id20;
        $para[] = $request->para_id21;
        $para[] = $request->para_id22;
        $para[] = $request->para_id23;
        $para[] = $request->para_id24;


        //   year 3  
        $para[] = $request->para_id25;
        $para[] = $request->para_id26;
        $para[] = $request->para_id27;
        $para[] = $request->para_id28;
        $para[] = $request->para_id29;
        $para[] = $request->para_id30;
        $para[] = $request->para_id31;
        $para[] = $request->para_id32;
        $para[] = $request->para_id33;
        $para[] = $request->para_id34;
        $para[] = $request->para_id35;
        $para[] = $request->para_id36;

        // year 4    

        $para[] = $request->para_id37;
        $para[] = $request->para_id38;
        $para[] = $request->para_id39;
        $para[] = $request->para_id40;
        $para[] = $request->para_id41;
        $para[] = $request->para_id42;
        $para[] = $request->para_id43;
        $para[] = $request->para_id44;
        $para[] = $request->para_id45;
        $para[] = $request->para_id46;
        $para[] = $request->para_id47;
        $para[] = $request->para_id48;


        $target = $request->para_number;
        $student = $request->student_id;
        $month = $request->month;
        $course_id  = $request->course_id;
        $year  = $request->year;


        $a = 0;

        for ($i = 0; $i <= 11; $i++) {

            $question = new Syllabus_add;
            $question->year = $year;
            $question->student_id = $student;
            $question->month =  $month[$a];
            $question->course_id = $course_id;
            $question->no_of_parah = $select1[$a] . $target[$i];
            $question->target = implode(",", (array)$para[$i]);;
            $question->save();
            $a++;
        }
        $a = 0;
        for ($i = 12; $i <= 23; $i++) {

            $question = new Syllabus_add;
            $question->year = $year;
            $question->student_id = $student;
            $question->month =  $month[$a];
            $question->course_id = $course_id;
            $question->no_of_parah = $select2[$a] . $target[$i];
            $question->target = implode(",", (array)$para[$i]);;
            $question->save();
            $a++;
        }
        $a = 0;
        for ($i = 24; $i <= 35; $i++) {

            $question = new Syllabus_add;
            $question->year = $year;
            $question->student_id = $student;
            $question->month =  $month[$a];
            $question->course_id = $course_id;
            $question->no_of_parah = $select3[$a] . $target[$i];
            $question->target = implode(",", (array)$para[$i]);;
            $question->save();
            $a++;
        }
        $a = 0;
        for ($i = 36; $i <= 47; $i++) {
            $question = new Syllabus_add;
            $question->year = $year;
            $question->student_id = $student;
            $question->month =  $month[$a];
            $question->course_id = $course_id;
            $question->no_of_parah = $select4[$a] . $target[$i];
            $question->target = implode(",", (array)$para[$i]);;
            $question->save();
            $a++;
        }


        return redirect('getassign');
    }



    public function add_syllabi(Request $request)
    {


        $select = $request->select;
        $para[] = $request->para_id1;
        $para[] = $request->para_id2;
        $para[] = $request->para_id3;
        $para[] = $request->para_id4;
        $para[] = $request->para_id5;
        $para[] = $request->para_id6;
        $para[] = $request->para_id7;
        $para[] = $request->para_id8;
        $para[] = $request->para_id9;
        $para[] = $request->para_id10;
        $para[] = $request->para_id11;
        $para[] = $request->para_id12;
        $target = $request->para_number;
        $student = $request->student_id;
        $month = $request->month;
        $course_id  = $request->course_id;
        $year  = $request->year;

        for ($i = 0; $i < 12; $i++) {

            $question = new Syllabus_add;
            $question->year = $year;
            $question->student_id = $student;
            $question->month =  $month[$i];
            $question->course_id = $course_id;
            $question->no_of_parah = $select[$i] . $target[$i];
            $question->target = implode(",", (array)$para[$i]);
            $question->save();
        }


        if ($request->nazcheck) {

            return redirect('getassign');
        } else {

            return redirect('setsyllabus');
        }
    }
    public function studentview(Request $request, $id)
    {
        $student =  DB::table('students')
            ->where('students.id', '=', $id)
            ->join('syllabus_types', 'syllabus_types.id', 'students.course_id')
            ->select('students.*', 'syllabus_types.title as course')
            ->first();
        return view('student.view', compact('student'));
    }

    public function studentdetail(Request $request, $id)
    {

        $student =  DB::table('students')
            ->where('students.id', '=', $id)
            ->join('syllabus_types', 'syllabus_types.id', 'students.course_id')
            ->select('students.*', 'syllabus_types.title as course')
            ->first();

        return view('student.detail', compact('student'));
    }



    public function studentsyllabus(Request $request, $id)
    {

        $syllabi = DB::table('syllabus_adds')
            ->where('syllabus_adds.student_id', '=', $id)
            ->join('students', 'students.id', '=', 'syllabus_adds.student_id')
            ->select('syllabus_adds.*', 'students.name')
            ->get()
            ->groupBy('name');

        return view('student.assign', compact('syllabi'));
    }


    public function studentatt(Request $request, $id)
    {

        $student = DB::table("students")
            ->where('id', '=', $id)
            ->first();
        $attendance = Attendance::where('student_id', $id)->get()->groupBy('date');

        return view('student.attendance', compact('attendance', 'student'));
    }



    public function studentgetdetail(Request $request, $id)
    {

        $detail = DB::table('syllabus_adds')
            ->join('students', 'students.id', '=', 'syllabus_adds.student_id')
            ->join('syllabus_types', 'syllabus_types.id', '=', 'syllabus_adds.course_id')
            ->join('months', 'months.id', '=', 'syllabus_adds.month')
            ->where('students.name', '=', $id)
            ->get();
        return view('assign.detail', compact('detail'));
    }

    public function studentupdates(Request $request, $id)
    {

        $daily_naz = DB::table('daily_naz_updates')
            ->join('students', 'students.id', '=', 'daily_naz_updates.student_id')
            ->where('students.id', '=', $id)
            ->select('students.name', 'daily_naz_updates.*')
            ->get()
            ->groupBy('name');

        $month_naz = DB::table('daily_naz_updates')->get()
            ->groupBy('month');

        $daily_hifz = DB::table('hifz_updates')
            ->join('students', 'students.id', '=', 'hifz_updates.student_id')
            ->select('students.name', 'hifz_updates.*')
            ->where('students.id', '=', $id)
            ->get()
            ->groupBy('name');

        $month_hifz = DB::table('hifz_updates')->get()->groupBy('month');

        $daily_dor = DB::table('dor_updates')
            ->join('students', 'students.id', '=', 'dor_updates.student_id')
            ->select('students.name', 'dor_updates.*')
            ->where('students.id', '=', $id)
            ->get()
            ->groupBy('name');

        $month_dor =  DB::table('dor_updates')->get()
            ->groupBy('month');

        return view('student.update', compact('daily_naz', 'month_naz', 'daily_hifz', 'month_hifz', 'daily_dor', 'month_dor'));
    }

    public function promote(Request $request)
    {

        if ($request->get('demo') == 1) {
            $result = DB::table('students')
                ->where('name', $request->get('student'))
                ->where('course_id', $request->get('course1'))
                ->update([
                    'course_id' => $request->get('course2'),
                    'Admission_date' => $request->get('date')
                ]);
        } else {
            $result = DB::table('students')
                ->where('course_id', $request->get('course1'))
                ->update([
                    'course_id' => $request->get('course2')
                ]);
        }
        if ($result) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function getstud(Request $request)
    {
        $date = DB::table('students')
            ->where('name', $request['student_id'])
            ->join('syllabus_types', 'syllabus_types.id', '=', 'students.course_id')
            ->pluck("syllabus_types.title", "syllabus_types.id");

        return response()->json($date);
    }
}
 