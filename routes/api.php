<?php
use Illuminate\Http\Requesapt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;



///////////////////////////-----Academic Api-/////////////////////


Route::post('/addnaz',[ApiController::class,'addnaz']);
Route::post('/add_dor',[ApiController::class,'dorupdate']);
Route::post('/addhifz',[ApiController::class,'hifz']);
Route::post('/addendparah',[ApiController::class,'addendparah']);
Route::post('/naz_data',[ApiController::class,'naz_data']);
Route::post('/dor_data',[ApiController::class,'dor_data']);
Route::post('/hifz_data',[ApiController::class,'hifz_data']);
Route::post('/arabicdate',[ApiController::class,'arabicdate']);
Route::post('/listnaz',[ApiController::class,'listnaz']);
Route::post('/listhifz',[ApiController::class,'listhifz']);
Route::post('/attendenceremark',[ApiController::class,'attendenceremark']);


Route::post('/naz_exam',[ApiController::class,'naz_exam']);
Route::post('/hifz_exam',[ApiController::class,'hifz_exam']);
Route::post('/dor_exam',[ApiController::class,'dor_exam']);


Route::post('/updatedor',[ApiController::class,'update_dor']);
Route::post('/updatenaz',[ApiController::class,'update_naz']);
Route::post('/updatehifz',[ApiController::class,'update_hifz']);
Route::post('/updatedor',[ApiController::class,'update_dor']);


Route::get('/paralist',[ApiController::class,'paralist']);
Route::post('/attendence',[ApiController::class,'attendence']);
Route::post('/studentlist',[ApiController::class,'studentlist']);
Route::get('/pre_endlist',[ApiController::class,'listpre_end']);
Route::get('/teacherlist',[ApiController::class,'teacherlist']);


Route::post('/dailynazlist',[ApiController::class,'nazlist']);
Route::post('/preend_update',[ApiController::class,'preend_update']);
Route::post('/passupdate',[ApiController::class,'passupdate']);
Route::post('/findstudent',[ApiController::class,'findstudent']);
Route::post('/getattendencelist',[ApiController::class,'getattendencelist']);


Route::post('/stucture',[ApiController::class,'stucture']);
Route::post('/login',[ApiController::class,'login']);
Route::post('/remarknaz',[ApiController::class,'remarknaz']);
Route::post('/updateattendance',[ApiController::class,'updateattendance']);

////////////////////////---------------------------//////////////////////////

route::post('/list_daily_update',[ApiController::class,'list_daily_update']);
route::post('/deletenaz',[ApiController::class,'deletenaz']);
route::post('/editnaz',[ApiController::class,'editnaz']);

//////////----Sick------///

Route::post('/listsickdetail',[ApiController::class,'listsickdetail']);
Route::post('/addsickdetail',[ApiController::class,'addsickdetail']);
Route::post('/updatesickdetail',[ApiController::class,'updatesickdetail']);
Route::post('/deletesickdetail',[ApiController::class,'destroysickdetail']);
Route::get('/list',[ApiController::class,'list']);
Route::post('/createsickleave',[ApiController::class,'createsickleave']);
Route::get('/listsickleave',[ApiController::class,'listsickleave']);
Route::post('/deletesickleave',[ApiController::class,'deletesickleave']);
Route::post('/updatesickleave',[ApiController::class,'updatesickleave']);
Route::post('/update_sickleave',[ApiController::class,'update_sickleave']);
//////daily hifz update ////
Route::post('/listhifz_update',[ApiController::class,'listhifz_update']);
Route::post('/addhifz_update',[ApiController::class,'addhifz_update']);
Route::post('/updatehifz_update',[ApiController::class,'updatehifz_update']);
Route::post('/destroyhifz_update',[ApiController::class,'destroyhifz_update']);
/////mistake_details///
Route::post('/destroymistake_detail',[ApiController::class,'destroymistake_detail']);
Route::post('/updatemistake_detail',[ApiController::class,'updatemistake_detail']);
Route::post('/addmistake_detail',[ApiController::class,'addmistake_detail']);
Route::post('/listmistake_detail',[ApiController::class,'listmistake_detail']);
/////mistake_table///
Route::post('/destroymistake',[ApiController::class,'destroymistake']);
Route::post('/updatemistake',[ApiController::class,'updatemistake']);
Route::post('/addmistake',[ApiController::class,'addmistake']);
Route::post('/listmistake',[ApiController::class,'listmistake']);
///failed para list///
Route::post('/failed_para_api',[ApiController::class,'failed_para_api']);
///list hifz ten day record
Route::post('/last_ten_day_record',[ApiController::class,'last_ten_day_record']);
////daily_hifz_update
Route::post('/daily_hifz_update',[ApiController::class,'daily_hifz_update']);
////complete_para
Route::post('/complete_para',[ApiController::class,'complete_para']);
////amuqtha_tyari
Route::post('/amuqtha_tyari',[ApiController::class,'amuqtha_tyari']);
///aapas_para
Route::post('/aapas_para',[ApiController::class,'aapas_para']);
Route::get('/not_assign_students',[ApiController::class,'not_assign_students']);
Route::get('/deletedata',[ApiController::class,'deletedata']);



Route::post('/Productupload',[ApiController::class,'Productupload']);
Route::post('/AdminDotnet',[ApiController::class,'AdminDotnet']);
Route::post('/fruitapp',[ApiController::class,'fruitapp']);
Route::post('/resume',[ApiController::class,'resume']);
