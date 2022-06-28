<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily_naz_update extends Model
{
    use HasFactory;

    protected $fillable = [
        'arabic_date','day','old_exam',
        'exam_1',
        'exam_1a',
        'exam_2',
        'exam_2a',
        'exam_3',
        'exam_3a',
        'remark_1',
        'remark_2',
        'remark_3',
        'exam1_time',
        'exam2_time',
        'exam3_time',
        'total','revision','n_exam',
        'total_sub_week','ruku','nisf','overall_para','read_status','read_status1','read_status2',
        'teacher_id','student_id','month'
    ];

}
