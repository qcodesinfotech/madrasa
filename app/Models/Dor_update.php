<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dor_update extends Model
{
    use HasFactory;
    protected $fillable = [
        'arabic_date','day','old_exam','exam_1','exam_2','exam_3','total','revision','n_exam','total_sub_week','nisf','read_status','read_status1','read_status2','overall_para','teacher_id','student_id','month'
    ];
}
