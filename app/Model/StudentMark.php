<?php

namespace App\Model;
use App\User;
use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model
{
    public function student(){
        return $this->belongsTo(User::class,'student_id', 'id');
    }

    public function studentClass(){
        return $this->belongsTo(StudentClass::class,'class_id', 'id');
    }

    public function assign_subject(){
        return $this->belongsTo(AssignSubject::class,'assign_subject_id', 'id');
    }
    public function year(){
        return $this->belongsTo(StudentYear::class,'year_id', 'id');
    }
    public function examType(){
        return $this->belongsTo(ExamType::class,'exam_type_id', 'id');
    }
    public function assignStudent(){
        return $this->belongsTo(AssignStudent::class,'student_id', 'student_id');
    }
}
