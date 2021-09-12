<?php

namespace App\Model;
use App\User;
use Illuminate\Database\Eloquent\Model;

class AssignStudent extends Model
{
    public function student(){
        return $this->belongsTo(User::class,'student_id', 'id');
    }

    public function studentClass(){
        return $this->belongsTo(StudentClass::class,'class_id', 'id');
    }

    public function studentYear(){
        return $this->belongsTo(StudentYear::class,'year_id', 'id');
    }
    public function studentShift(){
        return $this->belongsTo(StudentShift::class,'shift_id', 'id');
    }
    public function group(){
        return $this->belongsTo(StudentGroup::class,'group_id', 'id');
    }

    public function discount(){
        return $this->belongsTo(DiscountStudent::class,'id', 'assign_student_id');
    }
    public function mark(){
        return $this->belongsTo(StudentMark::class,'student_id', 'student_id');
    }


}
