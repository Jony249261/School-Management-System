<?php

namespace App\Http\Controllers\Backend\Setup;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\FeeCategoryAmount;
use App\Model\AssignSubject;
use DB;
class StudentClassController extends Controller
{
    public function view(){
        $data = StudentClass::all();
        return view('backend.setup.student_class.view-class', compact('data'));
    }

    public function add(){
        return view('backend.setup.student_class.add-class');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:student_classes,name',
            ]);
        $class = new StudentClass();
        $class->name = $request->name;
        $class->save();
        Session::flash('success','Class Added Successfully');
        return redirect()->route('setups.student.class.view');
    }

    public function edit($id){
        $class = StudentClass::findorFail($id);
        return view('backend.setup.student_class.edit-class', compact('class'));
    }

    public function update(Request $request, $id){

        $class = StudentClass::find($id);
        $request->validate([
            'name' => 'required|unique:student_classes,name,'.$class->id
            ]);
        
        $class->name = $request->name;
        $class->save();
        Session::flash('success','Class Updated Successfully');
        return redirect()->route('setups.student.class.view');
    }

    public function delete($id){
        $class = StudentClass::find($id)->delete();
        $amount = FeeCategoryAmount::where('class_id',$id)->delete();
        $assign_subject = AssignSubject::where('class_id',$id)->delete();
        Session::flash('success','Class Deleted Successfully');
        return redirect()->route('setups.student.class.view');
    }
}
