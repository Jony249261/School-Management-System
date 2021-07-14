<?php

namespace App\Http\Controllers\Backend\Setup;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ExamType;
use DB;


class ExamTypeController extends Controller
{
    public function view(){
        $data = ExamType::all();
        return view('backend.setup.exam_type.view-exam-type', compact('data'));
    }

    public function add(){
        return view('backend.setup.exam_type.add-exam-type');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:exam_types,name',
            ]);
        $exam_type = new ExamType();
        $exam_type->name = $request->name;
        $exam_type->save();
        Session::flash('success','Exam Type Added Successfully');
        return redirect()->route('setups.exam.type.view');
    }

    public function edit($id){
        $exam = ExamType::findorFail($id);
        return view('backend.setup.exam_type.edit-exam-type', compact('exam'));
    }

    public function update(Request $request, $id){
        
        $exam = ExamType::find($id);
        $request->validate([
            'name' => 'required|unique:exam_types,name,'.$exam->id
            ]);
        $exam->name = $request->name;
        $exam->save();
        Session::flash('success','Exam Type Updated Successfully');
        return redirect()->route('setups.exam.type.view');
    }

    public function delete($id){
        $exam_type = ExamType::find($id)->delete();
        Session::flash('success','Exam Type Deleted Successfully');
        return redirect()->route('setups.student.group.view');
    }
}
