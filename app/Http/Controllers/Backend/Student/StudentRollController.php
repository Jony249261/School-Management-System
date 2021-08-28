<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\AssignStudent;
use App\Model\DiscountStudent;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use App\Model\StudentYear;
use App\User;
use DB;
use PDF;
use Illuminate\Support\Facades\Session;


class StudentRollController extends Controller
{
    public function view(){
        
        $class = StudentClass::all();
        $year = StudentYear::orderBy('id','DESC')->get();
        return view('backend.student.roll_generate.view-roll-generate', compact('year','class'));
    }


    public function getStudent(Request $request){
        $allData = AssignStudent::with(['student'])->where('class_id',$request->class_is)->where('year_id',$request->year_id)->get();
        return response()->json($allData);
    }

    public function store(Request $request){

    }
}
