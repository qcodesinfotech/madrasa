<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'admission_no','name','father_name','father_occupation','date_of_birth','aadhar_no','mobile_no','whatsapp_no',
        'address','monthly_donation','proof1','proof2','proof3','proof4','proof5','proof6','student_pic',
        'admission_date',
        'previous_school',
        'course_id',
        'arabic_date',
        'year_id',
        'blood_group' 
    ];
    
}
