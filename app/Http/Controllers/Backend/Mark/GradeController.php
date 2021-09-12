<?php

namespace App\Http\Controllers\Backend\Mark;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\MarkGrade;
use Illuminate\Support\Facades\Session;

class GradeController extends Controller
{
    public function view(){
        $data = MarkGrade::all();
        return view('backend.mark.grade-mark-view',compact('data'));
    }

    public function add(){
        return view('backend.mark.grade-mark-add');
    }

    public function store(Request $request){
        $data = new MarkGrade();
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_mark = $request->start_mark;
        $data->end_mark = $request->end_mark;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();
        session::flash('success','Data Saved Successfully Added');
        return redirect()->route('marks.grade.view');

    }
    public function edit($id){
        $data = MarkGrade::findorFail($id);
        return view('backend.mark.grade-mark-edit', compact('data'));
    }

    public function update(Request $request, $id){
        
        $data = MarkGrade::findorFail($id);

        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_mark = $request->start_mark;
        $data->end_mark = $request->end_mark;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();
        Session::flash('success','Data Updated Successfully');
        return redirect()->route('marks.grade.view');
    }
}
