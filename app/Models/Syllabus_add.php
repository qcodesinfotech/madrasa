<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syllabus_add extends Model
{
    use HasFactory;

    protected $fillable=[
        "student_id","month","course_id","target","completion","c_target","remark","status","teacher_id","year","arabic_date","total"
    ];

}

