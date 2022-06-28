<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id','date','remark',
        'status_1',
        'status_2',
        'status_3',
        'session_1',
        'session_2',
        'session_3',
    ];
}
