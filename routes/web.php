<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SyllabusController;
use App\Http\Controllers\Assign_syllabusController;
use App\Http\Controllers\ParaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SickController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\MistakeController;

Auth::routes();
Route::post('/auth/check', [MainController::class, 'check'])->name('auth.check');
Route::get('/auth/logout', [MainController::class, 'logout'])->name('auth.logout');
Route::get('/auth/login', [MainController::class, 'login'])->name('auth.login');


Route::group(['middleware' => ['AuthCheck']], function () {
    Route::get('/', function () {
        return view('home');
    });

    Route::get('home/', function () {
        return view('home');
    })->name('home');

///  GET NavBar URL

Route::get('index',[StudentController::class, 'index']);
Route::get('groupteacher/',[StudentController::class, 'groupteacher'])->name('groupteacher');
Route::get('naz_update/',[ParaController::class, 'getnaz'])->name('naz_update');
Route::get('hifz_update/',[ParaController::class, 'gethifz'])->name('hifz_update');
Route::get('dor_update/',[ParaController::class, 'getdor'])->name('dor_update');
Route::get('structure/',[ParaController::class, 'structure'])->name('structure');
Route::get('syllabus_types/',[StudentController::class, 'syllabus_types'])->name('syllabus_types');
Route::get('getmonth/',[SyllabusController::class, 'getmonth'])->name('getmonth');
Route::get('getstudent/{id?}',[Assign_syllabusController::class,'getstudent']);
Route::get('getassign',[Assign_syllabusController::class,'getassign'])->name('getassign');
Route::get('getsyllabi/{course?}{course_year?}',[Assign_syllabusController::class,'getsyllabi'])->name('getsyllabi');
Route::get('getdetail/{id}',[Assign_syllabusController::class,'getdetail'])->name('getdetail');
Route::get('studentgetdetail/{id}',[StudentController::class,'studentgetdetail'])->name('studentgetdetail');
Route::get('role',[UserController::class,'getrole'])->name('role');
Route::get('student_based',[ParaController::class,'student_based'])->name('student_based');
Route::get('getendpara',[ParaController::class,'getendpara'])->name('getendpara');
Route::get('khatma',[ParaController::class,'khatma'])->name('khatma');

//RESOURCE
Route::resource('student',StudentController::class);
Route::resource('syllabus',SyllabusController::class);
Route::resource('assign',Assign_syllabusController::class);
Route::resource('para',ParaController::class);
Route::resource('user',UserController::class);




// sick

Route::get('sickdetail',[SickController::class, 'listsickdetail'])->name('sickdetail');
Route::get('sick_detail',[SickController::class, 'sick_detail'])->name('sick_detail');
Route::post('addsickleavedetail',[SickController::class,'addsickdetail'])->name('addsickleavedetail');
Route::get('sick_detail_view/{id?}',[SickController::class,'sick_detail_view'])->name('sick_detail_view');
Route::delete('destroysickleave/{id?}',[SickController::class,'destroysickdetail'])->name('destroysickleave');
Route::get('editsickleave/{id?}',[SickController::class,'editsickdetail'])->name('editsickleave');
Route::post('updatesickleave/{id?}',[SickController::class,'updatesickdetail'])->name('updatesickleave');
Route::get('details/{id?}',[SickController::class,'detailsview'])->name('detailsview');

Route::get('studentfound', [StudentController::class, 'studentfound'])->name('studentfound'); //use find student

///mark//
Route::post('add_mark',[MarkController::class,'add_mark'])->name('add_mark');
Route::get('list_mark',[MarkController::class,'list_mark'])->name('list_mark');
Route::delete('destroy_mark/{id?}',[MarkController::class,'destroy_mark'])->name('destroy_mark');
Route::get('edit_mark/{id?}',[MarkController::class,'edit_mark'])->name('edit_mark');
Route::post('update_mark/{id?}',[MarkController::class,'update_mark'])->name('update_mark');
///mistake//
Route::post('add_mistake_table',[MistakeController::class,'add_mistake_table'])->name('add_mistake_table');
Route::get('list_mistake',[MistakeController::class,'list_mistake'])->name('list_mistake');
Route::delete('destroy_mistake_table/{id?}',[MistakeController::class,'destroy_mistake_table'])->name('destroy_mistake_table');
Route::get('edit_mistake_table/{id?}',[MistakeController::class,'edit_mistake_table'])->name('edit_mistake_table');
Route::post('update_mistake_table/{id?}',[MistakeController::class,'update_mistake_table'])->name('update_mistake_table');


///EDIT
Route::get('precorrect/{id?}',[StudentController::class,'precorrect'])->name('precorrect');
Route::get('precorrect_hifz/{id?}',[StudentController::class,'precorrect_hifz'])->name('precorrect_hifz');
Route::get('precancel/{id?}',[StudentController::class,'precancel'])->name('precancel');
Route::get('mansooq/{id?}',[StudentController::class,'mansooq'])->name('mansooq');
Route::get('precancel_hifz/{id?}',[StudentController::class,'precancel_hifz'])->name('precancel_hifz');
Route::get('editsyllabus/{id?}',[StudentController::class,'editsyllabus']);
Route::get('editcourse/{id?}',[StudentController::class,'editcourse']);
Route::get('editmonth/{id?}',[StudentController::class,'editmonth']);
Route::get('nazedit/{id?}',[ParaController::class,'nazedit'])->name('nazedit');
Route::get('strucedit/{id?}',[ParaController::class,'strucedit'])->name('strucedit');
Route::get('cancelnaz/{id?}',[ParaController::class,'cancelnaz'])->name('cancelnaze');
Route::get('correctnaz/{id?}',[ParaController::class,'correctnaz'])->name('correctnaz');
Route::get('editparah/{id?}',[ParaController::class,'editparah'])->name('editparah');
Route::get('getstudentparah/{id?}',[ParaController::class,'getstudentparah'])->name('getstudentparah');
Route::get('getpara/{id?}',[ParaController::class,'getpara'])->name('getpara');
Route::get('getpara_1/{id?}',[ParaController::class,'getpara_1'])->name('getpara_1');
Route::get('getpara_2/{id?}',[ParaController::class,'getpara_2'])->name('getpara_2');
Route::get('checkpara/{id?}',[ParaController::class,'checkpara'])->name('checkpara');

Route::get('getparalist/{id?}',[ParaController::class,'getparalist'])->name('getparalist');
Route::get('hifz_details/{id?}',[StudentController::class,'hifz_details'])->name('hifz_details');
Route::get('amuqta/{id?}',[StudentController::class,'amuqta'])->name('amuqta');


Route::post('add_hifz/',[StudentController::class,'add_hifz']);
Route::get('assigncourse/{id?}',[StudentController::class,'assigncourse'])->name('assigncourse');
Route::post('add_syllabi/',[StudentController::class,'add_syllabi']);
Route::post('arabicdate/',[Assign_syllabusController::class,'arabicdate'])->name('arabicdate');
Route::post('add_teacher/',[StudentController::class,'add_teacher']);
Route::post('addmonth/',[SyllabusController::class,'addmonth'])->name('addmonth');


Route::get('report',[SyllabusController::class,'report'])->name('report');
Route::get('reportit',[syllabusController::class,'reportit'])->name('reportit');
Route::get('onedayreport/{id?}',[syllabusController::class,'onedayreport'])->name('onedayreport');

Route::post('addassign/',[Assign_syllabusController::class,'addassign'])->name('addassign');
Route::post('add_tsyllabus/',[StudentController::class,'add_tsyllabus']);
Route::post('add_role/',[UserController::class,'add_role'])->name('add_role');
Route::post('studentbase/',[paraController::class,'studentbase'])->name('studentbase');
Route::post('searchkhatma/',[paraController::class,'searchkhatma'])->name('searchkhatma');
Route::get('checknaz/',[paraController::class,'checknaz'])->name('checknaz');
Route::post('checkhifa/',[paraController::class,'checkhifa'])->name('checkhifa');
Route::post('checkdor/',[paraController::class,'checkdor'])->name('checkdor');
Route::post('searchstudent/',[StudentController::class,'searchstudent'])->name('searchstudent');
Route::get('search_by_students/{id?}',[StudentController::class,'search_by_students'])->name('search_by_students');
Route::get('promote',[StudentController::class,'promote'])->name('promote');
Route::get('discontinue_students/{id?}',[StudentController::class,'discontinue_students'])->name('discontinue_students');


Route::delete('deletetsyllabus/{id?}',[StudentController::class,'deletetsyllabus']);
Route::delete('deleteteacher/{id?}',[StudentController::class,'deleteteacher'])->name('deleteteacher');
Route::delete('deletetmonth/{id?}',[SyllabusController::class,'deletetmonth']);
Route::delete('strucdelete/{id?}',[ParaController::class,'strucdelete'])->name('strucdelete');

Route::get('getstud/{id?}',[StudentController::class,'getstud'])->name('getstud');
Route::get('viewstudent/{id?}',[StudentController::class,'viewstudent'])->name('viewstudent');
Route::get('teachersdel/{id?}',[StudentController::class,'teachersdel'])->name('teachersdel');

Route::get('nazdelete/{id?}',[ParaController::class,'nazdelete'])->name('nazdelete');
Route::get('checkdevice/{id?}',[ParaController::class,'checkdevice'])->name('checkdevice');
Route::get('hifzdelete/{id?}',[ParaController::class,'hifzdelete'])->name('hifzdelete');
Route::get('dordelete/{id?}',[ParaController::class,'dordelete'])->name('dordelete');
Route::get('setsyllabus',[ParaController::class,'setsyllabus'])->name('setsyllabus');



Route::get('nazview',[ParaController::class,'nazview'])->name('nazview');
Route::get('hifzview',[ParaController::class,'hifzview'])->name('hifzview');
Route::get('updatenaz',[ParaController::class,'updatenaz'])->name('updatenaz');
Route::get('checkstudent/{id?}',[ParaController::class,'checkstudent'])->name('checkstudent');
Route::get('reload',[ParaController::class,'reload'])->name('reload');



Route::get('studentview/{id?}',[StudentController::class,'studentview'])->name('studentview');
Route::get('studentdetail/{id?}',[StudentController::class,'studentdetail'])->name('studentdetail');
Route::get('mistake_table/{id?}',[StudentController::class,'mistake_table'])->name('mistake_table');
Route::get('studentsyllabus/{id?}',[StudentController::class,'studentsyllabus'])->name('studentsyllabus');
Route::get('studentatt/{id?}',[StudentController::class,'studentatt'])->name('studentatt');
Route::get('studentupdates/{id?}',[StudentController::class,'studentupdates'])->name('studentupdates');
Route::get('leave',[StudentController::class,'leave'])->name('leave');
Route::post('leavepost',[StudentController::class,'leavepost'])->name('leavepost');
Route::post('student_pic/{id?}',[StudentController::class,'student_pic'])->name('student_pic');
Route::post('proof1/{id?}',[StudentController::class,'proof1'])->name('proof1');
Route::post('proof2/{id?}',[StudentController::class,'proof2'])->name('proof2');
Route::post('proof3/{id?}',[StudentController::class,'proof3'])->name('proof3');
Route::post('proof4/{id?}',[StudentController::class,'proof4'])->name('proof4');
Route::post('proof5/{id?}',[StudentController::class,'proof5'])->name('proof5');
Route::post('proof6/{id?}',[StudentController::class,'proof6'])->name('proof6');

// UPDATE URL

Route::post('syllabusupdate/{id?}',[StudentController::class,'syllabusupdate'])->name('syllabusupdate');
Route::put('courseupdate/{id?}',[StudentController::class,'courseupdate'])->name('courseupdate');
Route::put('monthupdate/{id?}',[SyllabusController::class,'monthupdate'])->name('monthupdate');
Route::put('nazupdate/{id?}',[ParaController::class,'nazupdate'])->name('nazupdate');
Route::put('strucupdate/{id?}',[ParaController::class,'strucupdate'])->name('strucupdate');
Route::put('sparaupdate/{id?}',[ParaController::class,'sparaupdate'])->name('sparaupdate');
///login







Route::get('copy_hifz/{id?}',[StudentController::class,'copy_hifz'])->name('copy_hifz');
Route::get('amuqta_sabaq_view/{id?}',[StudentController::class,'amuqta_sabaq_view'])->name('amuqta_sabaq_view');

});
