<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pre_end extends Model
{
    use HasFactory;
    protected $fillable=[
        'student_id','teacher_id','date','target','course_id','year_id','remark','status'
    ];
    
}
