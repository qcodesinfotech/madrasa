<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assign_syllabus extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id','type_syllabus_id','month','year_id'
    ];
}




