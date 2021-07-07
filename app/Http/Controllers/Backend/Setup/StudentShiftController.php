<?php

namespace App\Http\Controllers\Backend\Setup;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentShift;
use DB;
class StudentShiftController extends Controller
{
    public function view(){
        $data = StudentShift::all();
        return view('backend.setup.student_shift.view-shift', compact('data'));
    }

    public function add(){
        return view('backend.setup.student_shift.add-shift');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:student_groups,name',
            ]);
        $shift = new StudentShift();
        $shift->name = $request->name;
        $shift->save();
        Session::flash('success','Shift Added Successfully');
        return redirect()->route('setups.student.shift.view');
    }

    public function edit($id){
        $shift = StudentShift::findorFail($id);
        return view('backend.setup.student_shift.edit-shift', compact('shift'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            ]);
        $shift = StudentShift::find($id);
        $shift->name = $request->name;
        $shift->save();
        Session::flash('success','Shift Updated Successfully');
        return redirect()->route('setups.student.shift.view');
    }

    public function delete($id){
        $Shift = StudentShift::find($id)->delete();
        Session::flash('success','Shift Deleted Successfully');
        return redirect()->route('setups.student.shift.view');
    }
}
