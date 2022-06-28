<?php

namespace App\Http\Controllers;

use App\Model\Sick;
use Illuminate\Http\Request;
use  Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class SickController extends Controller
{
    public function index()
    {
        $sick_leave = DB::table('sick_leave')
            ->join('students', 'students.id', 'sick_leave.s_id')
            ->join('users', 'users.id', 'sick_leave.teacher_id')
            ->select('sick_leave.*', 'students.name as student_name', 'users.full_name as teacher_name')
            ->get();
        $students = DB::table('students')->get();
        $users = DB::table('users')->get();
        return view('Sick.index', compact('sick_leave', 'students', 'users'));
    }
    public function edit(Request $request)
    {
        $sickleave = DB::table('sick_leave')
            ->join('students', 'students.id', 'sick_leave.s_id')
            ->join('users', 'users.id', 'sick_leave.teacher_id')
            ->select('sick_leave.*', 'students.name as student_name', 'users.full_name as teacher_name')
            ->where('sick_leave.id', $request->id)
            ->first();
        $students = DB::table('students')
            ->get();
        $users = DB::table('users')
            ->get();
        // print_r($data);
        return view('Sick.edit', compact('sickleave', 'students', 'users'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([]);
        // $sick_leave->update($request->all());
        DB::table("sick_leave")
            ->where('id', $request->id)
            ->update(array(
                "s_id" =>  $request["student_id"],
                "date_time" => $request["date_time"],
                "reason" => $request["reason"],
                "session" => $request["session"],
                "teacher_id" => $request["teacher_id"],
                "description" => $request["description"],
            ));
        return redirect()->route('sick');
        // return redirect()->route('groupteacher')
    }
    public function destroy(Request $request)
    {
        // $sick_leave->delete();
        DB::table('sick_leave')
            ->where('id', $request->id)
            ->delete();
        return redirect()->route('sick');
    }
    public function addsickleave(Request $request)
    {
        DB::table("sick_leave")
            ->insert(array(
                "s_id" =>  $request["student_id"],
                "date_time" => $request["date_time"],
                "reason" => $request["reason"],
                "session" => $request["session"],
                "teacher_id" => $request["teacher_id"],
                "description" => $request["description"],
            ));
        return redirect()->route('sick');
    }

    public function listsickdetail()
    {
        $sick_leave = DB::table('sick_leave_details')
            ->join('sick_leave', 'sick_leave.id', 'sick_leave_details.sick_id')
            ->select('sick_leave_details.*','sick_leave.reason')
            ->get();
        // return $sick_leave;
        $sick = DB::table('sick_leave')->get();
        return view('sickdetail.index', compact('sick_leave', 'sick'));
    }

    public function editsickdetail(Request $request)
    {
        $sickleave = DB::table('sick_leave_details')
            ->where('sick_leave_details.id', $request->id)
            ->join('sick_leave', 'sick_leave.id', 'sick_leave_details.sick_id')
            ->select('sick_leave_details.*','sick_leave.reason')
            ->first();
            $sick = DB::table('sick_leave')->get();

            // return $sickleave;
        return view('sickdetail.edit', compact('sickleave', 'sick',));
    }

    public function updatesickdetail(Request $request, $id)
    {
        DB::table("sick_leave_details")
            ->where('id', $request->id)
            ->update(array(
                "sick_id" =>  $request["sick_id"],
                "medicine" => $request["medicine"],
                "doctor" => $request["doctor"],
                "hospital" => $request["hospital"],
                "date_time" => $request["date_time"],
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
                "sick_id" =>  $request["sick_id"],
                "medicine" => $request["medicine"],
                "doctor" => $request["doctor"],
                "hospital" => $request["hospital"],
                "date_time" => $request["date_time"],
            ));
        return redirect()->route('sickdetail');
    }
}
