<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Para extends Model
{
    use HasFactory;
    protected $fillable=[
        "para_name","para_no","rukus"
    ];
}
