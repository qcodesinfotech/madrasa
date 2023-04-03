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
        $students_course = DB::table('syllabus_types')
            ->join('students', 'students.course_id', 'syllabus_types.id')
            ->select('students.course_id as students_course_id', 'syllabus_types.*')
            ->get();
        $student =  DB::table('students')
            ->leftjoin('syllabus_types', 'syllabus_types.id', 'students.course_id')
            // ->where('status',0)
            ->select('students.*', 'syllabus_types.title as course')
            ->orderBy('students.admission_no', 'asc')
            ->get();


        $active_student =  DB::table('students')
            ->where('students.status', 0)
            ->leftjoin('syllabus_types', 'syllabus_types.id', 'students.course_id')
            ->select('students.*', 'syllabus_types.title as course')
            ->orderBy('students.admission_no', 'asc')
            ->get();

        $std = DB::table('students')
            ->where('students.status', 0)
            ->orderBy('students.admission_no', 'asc')
            ->get();

        $discontiune_student =  DB::table('students')
            ->where('students.status', 1)
            ->leftjoin('syllabus_types', 'syllabus_types.id', 'students.course_id')
            ->select('students.*', 'syllabus_types.title as course')
            ->orderBy('students.admission_no', 'asc')
            ->get();

        return view('student.index', compact('student', 'course', 'active_student', 'discontiune_student', 'students_course', 'std'));
    }

    public function studentfound(Request $request)
    {
        $students_course = DB::table('syllabus_types')
            ->join('students', 'students.course_id', 'syllabus_types.id')
            ->where('students.id', $request->student_id)
            ->select('students.course_id', 'syllabus_types.title')

            ->pluck("course_id", "title");
        return response()->json($students_course);
    }


    public function discontinue_students(Request $request)
    {
        $status = DB::table("students")
            ->where('students.id', $request->id)
            ->first();
        // return  $status;

        if ($status->status == 0) {
            $status = DB::table("students")
                ->where('students.id', $request->id)
                ->update(array(
                    "status" =>  1,
                    "remark" => $request["remark"]
                ));
        }
        return back()->with('Student  Discontiuned');
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
        $students_course = DB::table('syllabus_types')
            ->join('students', 'students.course_id', 'syllabus_types.id')
            ->select('students.course_id as students_course_id', 'syllabus_types.*')
            ->get();
        $student1 =  DB::table('students')
            ->where(DB::raw('lower(students.name)'), 'like', '%' . strtolower($request->student) . '%')
            // ->where(DB::raw('lower(students.admission_no)'), 'like', '%' . strtolower($request->admission_no) . '%')
            ->join('syllabus_types', 'syllabus_types.id', 'students.course_id')
            ->select('students.*', 'syllabus_types.title as course')
            ->get();


            $isThereNumber = false;
            $string =$request->student;
            for ($i = 0; $i < strlen($string); $i++) {
                if ( ctype_digit($string[$i]) ) {
                    $isThereNumber = true;
                    break;
                }
            }




            if($isThereNumber){
                $student1 =  DB::table('students')
                // ->where(DB::raw('lower(students.name)'), 'like', '%' . strtolower($request->student) . '%')
                ->where(DB::raw('lower(students.admission_no)'), 'like', '%' . strtolower($request->student) . '%')
                ->join('syllabus_types', 'syllabus_types.id', 'students.course_id')
                ->select('students.*', 'syllabus_types.title as course')
                ->get();
            }elseif(!($isThereNumber)){
                $student1 =  DB::table('students')
                ->where(DB::raw('lower(students.name)'), 'like', '%' . strtolower($request->student) . '%')
                ->orwhere(DB::raw('lower(students.address)'), 'like', '%' . strtolower($request->student) . '%')
                ->join('syllabus_types', 'syllabus_types.id', 'students.course_id')
                ->select('students.*', 'syllabus_types.title as course')
                ->get();
            }
        $active_student =  DB::table('students')
            ->where('students.status', 0)
            ->leftjoin('syllabus_types', 'syllabus_types.id', 'students.course_id')
            ->select('students.*', 'syllabus_types.title as course')
            ->orderBy('students.admission_no', 'asc')
            ->get();

        $std = DB::table('students')
            ->where('students.status', 0)
            ->orderBy('students.admission_no', 'asc')
            ->get();

        $discontiune_student =  DB::table('students')
            ->where('students.status', 1)
            ->leftjoin('syllabus_types', 'syllabus_types.id', 'students.course_id')
            ->select('students.*', 'syllabus_types.title as course')
            ->orderBy('students.admission_no', 'asc')
            ->get();



        if (sizeof($student1) > 0) {
            return view('student.index', compact('student1', 'course', 'students_course', 'active_student', 'discontiune_student', 'std'));
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
            ->select('students.name', 'students.address', 'students.admission_no', 'students.id', 'teachers.teacher_id')
            ->get();
        // return $data;
        return view('course.studentdetail', compact('data'));
    }







    public function leave()
    {

        $course = DB::table('syllabus_types')
            ->get();

        return view('course.leave', compact('course'));
    }


    public function leavepost(Request $request)
    {


        $student = DB::table('students')
            ->where('course_id', $request->course_id)
            ->select('id')
            ->get();

        $period = CarbonPeriod::create($request->from_date, $request->to_date);
        foreach ($period as $date) {
            foreach ($student as $stud) {
                DB::table("daily_naz_updates")
                    ->where('course_id', $request->course_id)
                    ->insert(
                        array(
                            "student_id" => $stud->id,
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
            'admission_no' => 'required|unique:students,admission_no',
        ]);

        $admission =  DB::table('students')

            ->orderBy('students.admission_no', 'desc')
            ->first();
        if (!empty($admission)) {

            $numcount =  $request->get('admission_no') - $admission->admission_no;

            for ($i = 1; $i < $numcount; ++$i) {
                DB::table('students')
                    ->insert(
                        array(
                            "admission_no" => $admission->admission_no + $i
                        )
                    );
            }
        }
        // return array($admission->admission_no,$request->get('admission_no'));
        $date = $request->get('arabic_date');
        $change_date = str_replace("-", "/", $date);
        $dist = $request['district'];
        $state = $request['state'];
        $pincode = $request['pincode'];
        $city = $request['city'];
        $address = $city . "," . $pincode . $state . "," . $dist . ",";

        $std = new Student;
        $std->name = $request->get('name');
        $std->admission_no = $request->get('admission_no');
        $std->arabic_date = $change_date;
        $std->father_name = $request->get('father_name');
        $std->father_occupation = $request->get('father_occupation');
        $std->date_of_birth = $request->get('date_of_birth');
        $std->address = $address;
        $std->aadhar_no = $request->get('aadhar_no');
        $std->course_id = $request->get('course');
        $std->mobile_no = $request->get('mobile_no');
        $std->whatsapp_no = $request->get('whatsapp_no');
        $std->monthly_donation = $request->get('monthly_donation');
        $std->blood_group = $request->get('blood_group');
        $std->admission_date = $request->get('admission_date');
        $std->previous_school = $request->get('previous_school');

        if ($request->file('proof1')) {
            $file = $request->file('proof1');
            $destinationPath = 'students_photo/';
            $profileImage7 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage7);
            $std['proof1'] = $profileImage7;
        }
        if ($request->file('proof2')) {

            $file = $request->file('proof2');
            $destinationPath = 'students_photo/';
            $profileImage1 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage1);
            $std['proof2'] = $profileImage1;
        }
        if ($request->file('proof3')) {

            $file = $request->file('proof3');
            $destinationPath = 'students_photo/';
            $profileImage2 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage2);
            $std['proof3'] = $profileImage2;
        }
        if ($request->file('proof4')) {

            $file = $request->file('proof4');
            $destinationPath = 'students_photo/';
            $profileImage3 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage3);
            $std['proof4'] = $profileImage3;
        }

        if ($request->file('proof5')) {
            $file = $request->file('proof5');
            $destinationPath = 'students_photo/';
            $profileImage4 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage4);
            $std['proof5'] = $profileImage4;
        }

        if ($request->file('proof6')) {
            $file = $request->file('proof6');
            $destinationPath = 'students_photo/';
            $profileImage5 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage5);
            $std['proof6'] = $profileImage5;
        }

        if ($request->file('student_pic')) {

            $file = $request->file('student_pic');
            $destinationPath = 'students_photo/';
            $profileImage6 = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage6);
            $std['student_pic'] = $profileImage6;
        }

        $std->save();


        /////////////////----    check naz hifz Redirect    ---///////////////////////////////


        $para_order = array("30", "29", "28", "27", "26", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25");


        $student = DB::table('students')
            ->where('students.id', '=', $std->id)
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
            $student_id = $std->id;

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


    public function assigncourse(Request $request, $id)
    {



        $para_order = array("30", "29", "28", "27", "26", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25");


        $student = DB::table('students')
            ->where('students.id', '=', $id)
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
            $request->session()->put('student_id', $student->id);
            if (sizeof(array_filter($filter)) >= 30) {
                return redirect('assign');
            }



            if (preg_match("/{$naz}/i", $course->title)) {

                return redirect('nazview');
            } else if (preg_match("/{$hifz}/i", $course->title)) {

                return redirect('hifzview');
            } else {

                return redirect('assign');
            }
        } else {


            $i = 1;
            $student_id = $id;

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
            ->leftjoin('syllabus_types', 'syllabus_types.id', 'students.course_id')
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
        $question->arabic_date = $request->get('arabic_date');
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
    public function destroy(Student $student,Request $request)
    {

        $student->delete();
         DB::table('amuqtha')
        ->where('student_id',$student->id)
        ->delete();

         DB::table('amuqtha')
        ->where('student_id',$student->id)
        ->delete();
         DB::table('assign_syllabi')
        ->where('student_id',$student->id)
        ->delete();
         DB::table('attendances')
        ->where('student_id',$student->id)
        ->delete();
         DB::table('daily_naz_updates')
        ->where('student_id',$student->id)
        ->delete();
         DB::table('dor_updates')
        ->where('student_id',$student->id)
        ->delete();
         DB::table('hifz_daily_update')
        ->where('student_id',$student->id)
        ->delete();
         DB::table('hifz_updates')
        ->where('student_id',$student->id)
        ->delete();
         DB::table('mistake_details')
        ->where('student_id',$student->id)
        ->delete();
         DB::table('patients_list')
        ->where('student_id',$student->id)
        ->delete();
         DB::table('pre_ends')
        ->where('student_id',$student->id)
        ->delete();
         DB::table('structures')
        ->where('student_id',$student->id)
        ->delete();
         DB::table('student_based_paras')
        ->where('student_id',$student->id)
        ->delete();
         DB::table('syllabus_adds')
        ->where('student_id',$student->id)
        ->delete();
         DB::table('teachers')
        ->where('student_id',$student->id)
        ->delete();


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

        $value1 = explode("-", $pre->target)[0];
        $value2 = explode("-", $pre->target)[1];
if ($value1 == 0){
    $add_stur = new Structure();
            $add_stur->para_id = $value1;
            $add_stur->teacher_id = $pre->teacher_id;
            $add_stur->student_id = $pre->student_id;
            $add_stur->arabic_date = $pre->date;
            $add_stur->course_id = $pre->course_id;
            $add_stur->save();
}

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

            return redirect()->route('getendpara')
                ->with(
                    'success',
                    'Your status not updated target course or student is invalid.'
                );
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
                        'c_target' => $data . "" . explode('-', $pre->target)[0]
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
    public function mansooq (Request $request, $id)
    {
        $pre = DB::table('pre_ends')
            ->where('pre_ends.id', '=', $id)
            ->first();
            DB::table('pre_ends')
                ->where('id', $pre->id)
                ->update([
                    'status' => 3,
                    'remark' => $request->get('remark')
                ]);
            DB::table('structures')
            ->where('student_id',$pre->student_id)
            ->delete();
            DB::table('syllabus_adds')
            ->where('student_id', $pre->student_id)
                ->update([

                    'c_target' => ""
                ]);

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

    public function mistake_table($id)
    {
        $mistakes = DB::table('mistake_details')
            ->join('users', 'users.id', '=', 'mistake_details.teacher_id')
            ->join('syllabus_types', 'syllabus_types.id', 'mistake_details.course_id')
            ->join('students', 'students.id', 'mistake_details.student_id')
            ->join('mistake_table', 'mistake_table.id', 'mistake_details.mistake_id')
            ->join('hifz_daily_update', 'hifz_daily_update.id', 'mistake_details.hifz_id')
            ->where('students.id', '=', $id)
            ->select(
                'mistake_details.*',
                'users.full_name as teacher_name',
                'students.name as students_name',
                'syllabus_types.title as course_name',
                'mistake_table.title as mistake_title',
                'hifz_daily_update.f_remark as fail_remark'
            )
            ->get();




        $students = DB::table('students')
            ->where('students.id', '=', $id)
            ->select('*')
            ->first();

        // return $mistakes;
        return view('student.mistake', compact('mistakes', 'students'));
    }


    public function studentsyllabus(Request $request, $id)
    {

        $syllabi = DB::table('syllabus_adds')
            ->where('syllabus_adds.student_id', '=', $id)
            ->join('students', 'students.id', '=', 'syllabus_adds.student_id')
            ->select('syllabus_adds.*', 'students.name', 'students.admission_no', 'students.address')
            ->get()
            ->groupBy('name');

        $student_id = $id;
        return view('student.assign', compact('syllabi', 'student_id'));
    }


    // public function studentatt(Request $request, $id)
    // {

    //     $student = DB::table("students")
    //         ->where('id', '=', $id)
    //         ->first();
    //     $attendance = Attendance::where('student_id', $id)->get()->groupBy('date');

    //     return view('student.attendance', compact('attendance', 'student'));
    // }

    public function studentatt(Request $request, $id)
    {
        if (isset($_GET['month_id'])) {

            $current_month = $_GET['month_id'];
            $current_year = $_GET['year_id'];
        } else {
            $current_month = date('m');
            $current_year = date('Y');
        }
        $student = DB::table("students")
            ->where('id', '=', $id)
            ->first();

        $attendance = Attendance::where('student_id', $id)
            ->get();

        $list = [];
        foreach ($attendance as $key) {

            $from = $key->date;

            $month =  explode("/", $from)[1];
            $year =  explode("/", $from)[2];





            // if(explode("/",$key->date)[1]  == $month && explode("/",$key->date)[2]  == $year ){
            if ($current_month  == $month &&  $current_year == $year) {
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

                $list =  $materialsArray;
            }
        }
        return view('student.attendance', compact('attendance', 'student', 'list'));
    }



    public function studentgetdetail(Request $request, $id)
    {

        $detail = DB::table('syllabus_adds')
            ->join('students', 'students.id', '=', 'syllabus_adds.student_id')
            ->join('syllabus_types', 'syllabus_types.id', '=', 'syllabus_adds.course_id')
            ->join('months', 'months.id', '=', 'syllabus_adds.month')
            ->where('students.name', '=', $id)
            ->select('syllabus_adds.*','students.course_id as std_course_id','students.admission_no','students.address',
            'students.name','months.month as students_months')
            ->get();


        return view('assign.detail', compact('detail',));
    }
    public function studentgetdetail_hifz(Request $request, $id)
    {

        $detail = DB::table('syllabus_adds')
            ->join('students', 'students.id', '=', 'syllabus_adds.student_id')
            ->join('syllabus_types', 'syllabus_types.id', '=', 'syllabus_adds.course_id')
            ->join('months', 'months.id', '=', 'syllabus_adds.month')
            ->where('students.name', '=', $id)
            ->select('syllabus_adds.*','students.course_id as std_course_id','students.admission_no','students.address',
            'students.name','months.month as students_months')
            ->get();


        return view('assign.hifz_detail', compact('detail',));
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
                ->update([
                    'course_id' => $request->get('course2'),
                    'Admission_date' => $request->get('date')
                ]);


            $student = DB::table('students')
                ->where('name', $request->get('student'))
                ->first();
        } else {
            $result = DB::table('students')
                ->where('course_id', $request->get('course1'))
                ->update([
                    'course_id' => $request->get('course2')
                ]);
            return redirect()->back();
        }




        // return $_GET;
        $para_order = array("30", "29", "28", "27", "26", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25");




        $course =  DB::table('syllabus_types')
            ->where('id', $student->course_id)
            // ->where('name', $student)
            ->first();
        $naz = 'naz';
        $hifz = 'hifz';

        // if (preg_match("/{$naz}/i", $course->title)) {
        //     echo 'true';
        // }


        $request->session()->put('student_id', $student->id);
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

            $student_id = $student->id;

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


        return redirect()->back();
    }

    public function getstud(Request $request)
    {
        $date = DB::table('students')
            ->where('name', $request['student_id'])
            ->join('syllabus_types', 'syllabus_types.id', '=', 'students.course_id')
            ->pluck("syllabus_types.title", "syllabus_types.id");

        return response()->json($date);
    }

    public function hifz_details($id)
    {
        $hifz_update = DB::table('hifz_daily_update')

            ->join('students', 'students.id', 'hifz_daily_update.student_id')
            ->join('users', 'users.id', 'hifz_daily_update.teacher_id')
            ->where('students.id', '=', $id)
            ->where('students.course_id', 2)
            ->select('hifz_daily_update.*', 'students.name as student_name', 'users.full_name as teacher_names',)
            ->get();




        $students = DB::table('students')
            ->where('students.id', '=', $id)
            ->select('*')
            ->first();
        // if (!empty($hifz_update->teacher)){
        $teacher  = DB::table('hifz_daily_update')
            ->join('students', 'students.id', 'hifz_daily_update.student_id')
            ->join('users', 'users.id', 'hifz_daily_update.teacher_id')
            ->where('students.id', '=', $id)
            ->select('users.full_name as teacher_name',)
            ->first();
        return view('student.hifz', compact('hifz_update', 'students', 'teacher',));
    }

    public function amuqta($id)
    {
        $hifz_update = DB::table('hifz_daily_update')

            ->join('students', 'students.id', 'hifz_daily_update.student_id')
            ->join('users', 'users.id', 'hifz_daily_update.teacher_id')
            ->where('students.id', '=', $id)
            ->where('students.course_id', 2)
            ->select('hifz_daily_update.*', 'students.name as student_name', 'users.full_name as teacher_names',)
            ->get();




        $students = DB::table('students')
            ->where('students.id', '=', $id)
            ->select('*')
            ->first();
        // if (!empty($hifz_update->teacher)){
        $teacher  = DB::table('hifz_daily_update')
            ->join('students', 'students.id', 'hifz_daily_update.student_id')
            ->join('users', 'users.id', 'hifz_daily_update.teacher_id')
            ->where('students.id', '=', $id)
            ->select('users.full_name as teacher_name',)
            ->first();
        return view('student.amuqta', compact('hifz_update', 'students', 'teacher',));
    }

    public function precorrect_hifz(Request $request, $id)
    {
        $pre = DB::table('pre_ends')
            ->where('pre_ends.id', '=', $id)
            ->first();


        $add_stur = new Structure();
        $add_stur->para_id = $pre->target;
        $add_stur->teacher_id = $pre->teacher_id;
        $add_stur->student_id = $pre->student_id;
        $add_stur->arabic_date = $pre->date;
        $add_stur->course_id = $pre->course_id;
        $add_stur->save();


        $num = Carbon::createFromFormat('d/m/Y', $pre->date)->format('m');
        $num = ltrim($num, '0');

        $assign = DB::table("syllabus_adds")
            ->where("syllabus_adds.student_id", $pre->student_id)
            ->where("syllabus_adds.month", $num)
            ->where('syllabus_adds.course_id', $pre->course_id)
            ->first();

        if (empty($assign)) {

            return redirect()->route('getendpara')
                ->with(
                    'success',
                    'Your status not updated target course or student is invalid.'
                );
        } else {

            $question = Pre_end::find($pre->id);
            $question->status = 1;
            $question->save();

            if (empty($assign->c_target)) {

                $data = "";
            } else {
                $data = $assign->c_target . ",";
            }



            if($pre->type == 0){
                $add = DB::table("syllabus_adds")
                ->where('id', $assign->id)
                ->update([
                    'c_target' => $data . "" . explode('-', $pre->target)[0]
                ]);
            }
        }

        return redirect()->route('getendpara')
            ->with('success', 'Your status updated .');
    }

    public function precancel_hifz(Request $request, $id)
    {
        $pre_end = DB::table('pre_ends')
            ->where('pre_ends.id', '=', $request["std_id"])
            ->first();
        if (!empty($request->get('remark'))) {
            $updated =  DB::table('pre_ends')
                ->where('id', $pre_end->id)
                ->update([
                    'status' => 2,
                    'remark' => $request->get('remark')
                ]);

            $students = DB::table('hifz_daily_update')
                ->where('id', $id)
                ->select('*')
                ->first();

            $update =    DB::table('hifz_daily_update')
                ->insert(array(
                    "failed_parah" =>   $pre_end->target,
                    "failed_parah_ustad" => $pre_end->teacher_id,
                    "f_remark" => $pre_end->remark,
                    "f_status" => 2,
                    "student_id" => $pre_end->student_id,
                    "date" => $pre_end->date,
                    "arabic_date" => $students->arabic_date,
                    "teacher_id" => $students->teacher_id,
                ));
        } elseif (empty($request->get('remark'))) {
            $updated = DB::table('pre_ends')
                ->where('id', $pre_end->id)
                ->update([
                    'status' => 2
                ]);
            $students = DB::table('hifz_daily_update')
                ->where('id', $id)
                ->select('*')
                ->first();
            $update = DB::table('hifz_daily_update')
                ->insert(array(
                    "failed_parah" =>   $pre_end->target,
                    "failed_parah_ustad" => $pre_end->teacher_id,
                    "f_remark" => $pre_end->remark,
                    "f_status" => 2,
                    "student_id" => $pre_end->student_id,
                    "date" => $pre_end->date,
                    "arabic_date" => $students->arabic_date,
                    "teacher_id" => $students->teacher_id,
                ));
        } else {
            return redirect()->route('getendpara')
                ->with('success', 'Your status updated.');
        }
        return redirect()->route('getendpara')
            ->with('success', 'Your status updated .');
    }

    public function student_pic(Request $request)
    {
        DB::table('students')
            ->where('id', $request->id)
            ->update(array(
                'student_pic' => "",
            ));
        return back()->with('Students Pic is Deleted');
    }
    public function proof1(Request $request)
    {



        DB::table('students')
            ->where('id', $request->id)
            ->update(array(
                'proof1' => "",
            ));
        return back()->with('Students Pic is Deleted');
    }
    public function proof2(Request $request)
    {



        DB::table('students')
            ->where('id', $request->id)
            ->update(array(
                'proof2' => "",
            ));
        return back()->with('Students Pic is Deleted');
    }
    public function proof3(Request $request)
    {



        DB::table('students')
            ->where('id', $request->id)
            ->update(array(
                'proof3' => "",
            ));
        return back()->with('Students Pic is Deleted');
    }
    public function proof4(Request $request)
    {



        DB::table('students')
            ->where('id', $request->id)
            ->update(array(
                'proof4' => "",
            ));
        return back()->with('Students Pic is Deleted');
    }
    public function proof5(Request $request)
    {



        DB::table('students')
            ->where('id', $request->id)
            ->update(array(
                'proof5' => "",
            ));
        return back()->with('Students Pic is Deleted');
    }
    public function proof6(Request $request)
    {



        DB::table('students')
            ->where('id', $request->id)
            ->update(array(
                'proof6' => "",
            ));
        return back()->with('Students Pic is Deleted');
    }


    public function search_by_students(Request $request)
    {


        $tec = $_GET['teacher_id'];
        $get_teacher = DB::table("users")
            ->where('users.id', $tec)
            ->first();


        $checkid = DB::table('teachers')
            ->select('student_id')
            ->get()->toarray();

        foreach ($checkid as $qdata) {
            $arr[] = $qdata->student_id;
        }


        if (!isset($arr)) {
            $arr = array();
        }
        // $student = DB::table("students")
        //     ->whereNotIn('id', $arr)
        //     ->get();

        $teacher = DB::table("users")->get();


        $isThereNumber = false;
        $string =$request->student;
        for ($i = 0; $i < strlen($string); $i++) {
            if ( ctype_digit($string[$i]) ) {
                $isThereNumber = true;
                break;
            }
        }




        if($isThereNumber){
            $student =  DB::table('students')
            ->whereNotIn('students.id', $arr)
            // ->where(DB::raw('lower(students.name)'), 'like', '%' . strtolower($request->student) . '%')
            ->where(DB::raw('lower(students.admission_no)'), 'like', '%' . strtolower($request->student) . '%')
            ->join('syllabus_types', 'syllabus_types.id', 'students.course_id')
            ->select('students.*', 'syllabus_types.title as course')
            ->get();
        }elseif(!($isThereNumber)){
            $student =  DB::table('students')
            ->whereNotIn('students.id', $arr)
            ->where(DB::raw('lower(students.name)'), 'like', '%' . strtolower($request->student) . '%')
            ->orwhere(DB::raw('lower(students.address)'), 'like', '%' . strtolower($request->student) . '%')
            ->join('syllabus_types', 'syllabus_types.id', 'students.course_id')
            ->select('students.*', 'syllabus_types.title as course')
            ->get();
        }



        if (sizeof($student) > 0)  {
                return view('course.checkstudent', compact('student', 'teacher', 'get_teacher',));
        } else {
            return back()
                ->with('success', '0 result  found');
        }
    }



    public function copy_hifz(Request $request){
        DB::table('syllabus_adds')
            ->where('student_id', $request->id)
            ->update(array(
                'c_target' => "",
            ));
        DB::table('structures')
            ->where('student_id', $request->id)
            ->delete();

            DB::table('pre_ends')
            ->where('student_id', $request->id)
            ->delete();
            return back() ;
    }

public function amuqta_sabaq_view(Request $request){

    $view = DB::table('students')
    ->where('students.id',$request->id)
    ->get();
    return view('student.hifz_view',compact('view'));

}


}
