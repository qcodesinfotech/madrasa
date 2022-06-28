<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class syllabus extends Model
{
    use HasFactory;
    protected $fillable = [

        'syllabus_id','target1','target2','target3',
        'target4','target5','target6', 'total'
    ];
}
