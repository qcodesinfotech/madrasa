<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hifz_update extends Model
{
    use HasFactory;
    protected $fillable = [
        'arabic_date','day','old_exam','exam_1','exam_2','exam_3','total','revision','n_exam','total_sub_week','ruku','nisf','overall_para','read_status','read_status1','read_status2','teacher_id','student_id','month'
    ];
}
