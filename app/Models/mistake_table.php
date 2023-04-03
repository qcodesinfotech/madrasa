<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mistake_table extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','neglectable_mark','course_id',
    ];}
