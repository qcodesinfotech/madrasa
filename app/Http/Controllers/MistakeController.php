<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MistakeController extends Controller
{
    public function list_mistake()
    {
        $mistake =  DB::table('mistake_table')
            ->join('syllabus_types', 'syllabus_types.id', 'mistake_table.course_id')
            ->select('mistake_table.*', 'syllabus_types.title as course_name')
            ->get();
        $course = DB::table('syllabus_types')
            ->get();
        return (view('mistake.index', compact('mistake', 'course')));
    }


    public function add_mistake_table(Request $request)
    {
        DB::table("mistake_table")
            ->insert(array(
                "title" =>  $request["title"],
                "neglectable_mark" => $request["neglectable_mark"],
                "course_id" => $request["course_id"],

            ));
        return redirect()->route('list_mistake');
    }

    public function edit_mistake_table(Request $request)
    {
        $mistake =  DB::table('mistake_table')
            ->join('syllabus_types', 'syllabus_types.id', 'mistake_table.course_id')
            ->where('mistake_table.id',$request->id)
            ->select('mistake_table.*', 'syllabus_types.title as course', 'syllabus_types.id as course_id')
            ->first();

        $course = DB::table('syllabus_types')
            ->get();
        return (view('mistake.edit', compact('mistake', 'course')));
    }



    public function update_mistake_table(Request $request)
    {
        DB::table("mistake_table")
            ->where('id', $request->id)
            ->update(array(
                "title" =>  $request["title"],
                "neglectable_mark" => $request["neglectable_mark"],
                "course_id" => $request["course_id"],

            ));
        return redirect()->route('list_mistake');
    }


    public function destroy_mistake_table(Request $request)
    {
        DB::table('mistake_table')
            ->where('id', $request->id)
            ->delete();

        return redirect()->route('list_mistake');
    }
}
