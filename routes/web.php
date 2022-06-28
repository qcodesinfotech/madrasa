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
//sick

Route::get('sick',[SickController::class, 'index'])->name('sick');
Route::post('addsickleave',[SickController::class,'addsickleave'])->name('addsickleave');
Route::delete('destroy/{id?}',[SickController::class,'destroy'])->name('destroy');
Route::get('edit/{id?}',[SickController::class,'edit'])->name('edit');
Route::post('update/{id?}',[SickController::class,'update'])->name('update');


Route::get('sickdetail',[SickController::class, 'listsickdetail'])->name('sickdetail');
Route::post('addsickleavedetail',[SickController::class,'addsickdetail'])->name('addsickleavedetail');
Route::delete('destroysickleave/{id?}',[SickController::class,'destroysickdetail'])->name('destroysickleave');
Route::get('editsickleave/{id?}',[SickController::class,'editsickdetail'])->name('editsickleave');
Route::post('updatesickleave/{id?}',[SickController::class,'updatesickdetail'])->name('updatesickleave');

///EDIT
Route::get('precorrect/{id?}',[StudentController::class,'precorrect'])->name('precorrect');
Route::get('precancel/{id?}',[StudentController::class,'precancel'])->name('precancel');
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

Route::post('getparalist',[ParaController::class,'getparalist'])->name('getparalist');
Route::post('add_syllabi/',[StudentController::class,'add_syllabi']);
Route::post('arabicdate/',[Assign_syllabusController::class,'arabicdate'])->name('arabicdate');
Route::post('add_teacher/',[StudentController::class,'add_teacher']);
Route::post('addmonth/',[SyllabusController::class,'addmonth'])->name('addmonth');
Route::post('addassign/',[Assign_syllabusController::class,'addassign'])->name('addassign');
Route::post('add_tsyllabus/',[StudentController::class,'add_tsyllabus']);
Route::post('add_role/',[UserController::class,'add_role'])->name('add_role');
Route::post('studentbase/',[paraController::class,'studentbase'])->name('studentbase');
Route::post('searchkhatma/',[paraController::class,'searchkhatma'])->name('searchkhatma');
Route::post('checknaz/',[paraController::class,'checknaz'])->name('checknaz');
Route::post('checkhifa/',[paraController::class,'checkhifa'])->name('checkhifa');
Route::post('checkdor/',[paraController::class,'checkdor'])->name('checkdor');
Route::post('searchstudent/',[StudentController::class,'searchstudent'])->name('searchstudent');
Route::post('promote',[StudentController::class,'promote'])->name('promote');




Route::delete('deletetsyllabus/{id?}',[StudentController::class,'deletetsyllabus']);
Route::delete('deleteteacher/{id?}',[StudentController::class,'deleteteacher'])->name('deleteteacher');
Route::delete('deletetmonth/{id?}',[SyllabusController::class,'deletetmonth']);
Route::delete('strucdelete/{id?}',[ParaController::class,'strucdelete'])->name('strucdelete');



Route::get('getstud/{id?}',[StudentController::class,'getstud'])->name('getstud');


Route::get('nazdelete/{id?}',[ParaController::class,'nazdelete'])->name('nazdelete');
Route::get('checkdevice/{id?}',[ParaController::class,'checkdevice'])->name('checkdevice');
Route::get('hifzdelete/{id?}',[ParaController::class,'hifzdelete'])->name('hifzdelete');
Route::get('dordelete/{id?}',[ParaController::class,'dordelete'])->name('dordelete');
Route::get('setsyllabus',[ParaController::class,'setsyllabus'])->name('setsyllabus');
Route::get('reload',[ParaController::class,'reload'])->name('reload');
Route::get('studentview/{id?}',[StudentController::class,'studentview'])->name('studentview');
Route::get('studentdetail/{id?}',[StudentController::class,'studentdetail'])->name('studentdetail');
Route::get('studentsyllabus/{id?}',[StudentController::class,'studentsyllabus'])->name('studentsyllabus');
Route::get('studentatt/{id?}',[StudentController::class,'studentatt'])->name('studentatt');
Route::get('studentupdates/{id?}',[StudentController::class,'studentupdates'])->name('studentupdates');



// UPDATE URL

Route::post('syllabusupdate/{id?}',[StudentController::class,'syllabusupdate'])->name('syllabusupdate');
Route::put('courseupdate/{id?}',[StudentController::class,'courseupdate'])->name('courseupdate');
Route::put('monthupdate/{id?}',[SyllabusController::class,'monthupdate'])->name('monthupdate');
Route::put('nazupdate/{id?}',[ParaController::class,'nazupdate'])->name('nazupdate');
Route::put('strucupdate/{id?}',[ParaController::class,'strucupdate'])->name('strucupdate');
Route::put('sparaupdate/{id?}',[ParaController::class,'sparaupdate'])->name('sparaupdate');
///login

});
