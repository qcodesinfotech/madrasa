<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mistake_Details extends Model
{
    use HasFactory;
    protected $fillable = [
        'arabic_date','day','student_id','teacher_id','hifz_id','mistake_on','mistake_id','mark','mark_detected','course_id','remark',
    ];
}
