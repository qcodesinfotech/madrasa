<?php
use Illuminate\Http\Requesapt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;



/////////////////////////////////////Academic Api /////////////////////

Route::post('/addnaz',[ApiController::class,'addnaz']);
Route::post('/add_dor',[ApiController::class,'dorupdate']);
Route::post('/addhifz',[ApiController::class,'hifz']);
Route::post('/addendparah',[ApiController::class,'addendparah']);
Route::post('/naz_data',[ApiController::class,'naz_data']);
Route::post('/dor_data',[ApiController::class,'dor_data']);
Route::post('/hifz_data',[ApiController::class,'hifz_data']);
Route::post('/arabicdate',[ApiController::class,'arabicdate']);

route::post('/listnaz',[ApiController::class,'listnaz']);


Route::post('/naz_exam',[ApiController::class,'naz_exam']);
Route::post('/hifz_exam',[ApiController::class,'hifz_exam']);
Route::post('/dor_exam',[ApiController::class,'dor_exam']);

Route::post('/updatedor',[ApiController::class,'update_dor']);
Route::post('/updatenaz',[ApiController::class,'update_naz']);
Route::post('/updatehifz',[ApiController::class,'update_hifz']);
Route::post('/updatedor',[ApiController::class,'update_dor']);

Route::get('/paralist',[ApiController::class,'paralist']);
Route::post('/attendence',[ApiController::class,'attendence']);
Route::get('/studentlist',[ApiController::class,'studentlist']);
Route::get('/pre_endlist',[ApiController::class,'listpre_end']);
Route::get('/teacherlist',[ApiController::class,'teacherlist']);

Route::post('/dailynazlist',[ApiController::class,'nazlist']);
Route::post('/preend_update',[ApiController::class,'preend_update']);
Route::post('/passupdate',[ApiController::class,'passupdate']);


Route::post('/findstudent',[ApiController::class,'findstudent']);
Route::post('/getattendencelist',[ApiController::class,'getattendencelist']);


Route::post('/stucture',[ApiController::class,'stucture']);
Route::post('/login',[ApiController::class,'login']);




Route::get('/listsickdetail',[ApiController::class,'listsickdetail']);
Route::post('/addsickdetail',[ApiController::class,'addsickdetail']);
Route::post('/updatesickdetail',[ApiController::class,'updatesickdetail']);
Route::post('/deletesickdetail',[ApiController::class,'destroysickdetail']);


////////////////////////////////////////////---------------------------////////////////////////////////////////



