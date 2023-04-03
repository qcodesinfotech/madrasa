<?php

namespace App\Http\Controllers;

use App\Model\Sick;
use Illuminate\Http\Request;
use  Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class MarkController extends Controller
{
    public function list_mark()
    {
        $mark =  DB::table('mark_table')
            ->join('syllabus_types', 'syllabus_types.id', 'mark_table.course_id')
            ->select('mark_table.*', 'syllabus_types.title as course_name')
            ->get();
        $course = DB::table('syllabus_types')
            ->get();
        return (view('mark.index', compact('mark', 'course')));
    }

    public function addmark()
    {
        $course = DB::table('syllabus_types')
            ->get();
        return view('mark.add', compact('course'));
    }

    public function add_mark(Request $request)
    {
        DB::table("mark_table")
            ->insert(array(
                "title" =>  $request["title"],
                "pass_mark" => $request["pass_mark"],
                "course_id" => $request["course_id"],
                // "type	" => $request["type	"],

            ));
        return redirect()->route('list_mark');
    }

    public function edit_mark(Request $request)
    {
        $mark =  DB::table('mark_table')
            ->join('syllabus_types', 'syllabus_types.id', 'mark_table.course_id')
            ->where('mark_table.id',$request->id)
            ->select('mark_table.*', 'syllabus_types.title as course', 'syllabus_types.id as course_id')
            ->first();

        $course = DB::table('syllabus_types')
            ->get();
        return (view('mark.edit', compact('mark', 'course')));
    }



    public function update_mark(Request $request)
    {
        DB::table("mark_table")
            ->where('id', $request->id)
            ->update(array(
                "title" =>  $request["title"],
                "pass_mark" => $request["pass_mark"],
                "course_id" => $request["course_id"],
                // "type	" => $request["type	"],


            ));
        return redirect()->route('list_mark');
    }


    public function destroy_mark(Request $request)
    {
        DB::table('mark_table')
            ->where('id', $request->id)
            ->delete();

        return redirect()->route('list_mark');
    }
}
