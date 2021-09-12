<?php

namespace App\Model;
use App\User;
use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model
{
    public function student(){
        return $this->belongsTo(User::class,'student_id', 'id');
    }
    public function rollSt(){
        return $this->hasOne(AssignStudent::class,'student_id', 'student_id');
    }
}
