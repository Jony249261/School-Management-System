<?php

namespace App\Http\Controllers\Backend\Setup;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentYear;
use DB;

class StudentYearController extends Controller
{
    public function view(){
        $data = StudentYear::all();
        return view('backend.setup.student_year.view-year', compact('data'));
    }

    public function add(){
        return view('backend.setup.student_year.add-year');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|numeric|unique:student_years,name|min:4',
            ]);
        $year = new StudentYear();
        $year->name = $request->name;
        $year->save();
        Session::flash('success','Year Added Successfully');
        return redirect()->route('setups.student.year.view');
    }

    public function edit($id){
        $year = StudentYear::findorFail($id);
        return view('backend.setup.student_year.edit-year', compact('year'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|numeric|min:4',
            ]);
        $year = StudentYear::find($id);
        $year->name = $request->name;
        $year->save();
        Session::flash('success','Year Updated Successfully');
        return redirect()->route('setups.student.year.view');
    }

    public function delete($id){
        $year = StudentYear::find($id)->delete();
        Session::flash('success','Year Deleted Successfully');
        return redirect()->route('setups.student.year.view');
    }
}
