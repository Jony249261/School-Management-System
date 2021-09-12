<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AssignStudent;
use App\Model\DiscountStudent;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use App\Model\StudentYear;
use App\Model\ExamType;
use App\Model\AssignSubject;
use App\User;
use DB;
use PDF;
use Illuminate\Support\Facades\Session;
use App\Model\StudentMark;


class DefaultController extends Controller
{
    public function getStudent(Request $request){
        $class_id = $request->class_id;
        $year_id = $request->year_id;
        $data = AssignStudent::with(['student'])->where('class_id',$class_id)->where('year_id',$year_id)->get();
        return response()->json($data);
    }

    public function getSubject( Request $request){
        $class_id = $request->class_id;
        $data = AssignSubject::with(['subject'])->where('class_id',$class_id)->get();
        return response()->json($data);
    }
}
