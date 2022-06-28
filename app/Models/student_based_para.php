<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_based_para extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id','para_id','para_order' 
    ];
}
