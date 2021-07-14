<?php

namespace App\Http\Controllers\Backend\Setup;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentGroup;
use DB;
class StudentGroupController extends Controller
{
    public function view(){
        $data = StudentGroup::all();
        return view('backend.setup.student_group.view-group', compact('data'));
    }

    public function add(){
        return view('backend.setup.student_group.add-group');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:student_groups,name',
            ]);
        $group = new StudentGroup();
        $group->name = $request->name;
        $group->save();
        Session::flash('success','Group Added Successfully');
        return redirect()->route('setups.student.group.view');
    }

    public function edit($id){
        $group = StudentGroup::findorFail($id);
        return view('backend.setup.student_group.edit-group', compact('group'));
    }

    public function update(Request $request, $id){
        
        $group = StudentGroup::find($id);
        $request->validate([
            'name' => 'required|unique:student_groups,name,'.$group->id
            ]);
        $group->name = $request->name;
        $group->save();
        Session::flash('success','Group Updated Successfully');
        return redirect()->route('setups.student.group.view');
    }

    public function delete($id){
        $group = StudentGroup::find($id)->delete();
        Session::flash('success','Group Deleted Successfully');
        return redirect()->route('setups.student.group.view');
    }
}
