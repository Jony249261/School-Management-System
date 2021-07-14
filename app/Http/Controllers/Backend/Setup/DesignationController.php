<?php

namespace App\Http\Controllers\Backend\Setup;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Designation;
use DB;


class DesignationController extends Controller
{
    public function view(){
        $data = Designation::all();
        return view('backend.setup.designation.view-designation', compact('data'));
    }

    public function add(){
        return view('backend.setup.designation.add-designation');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:designations,name',
            ]);
        $designation = new Designation();
        $designation->name = $request->name;
        $designation->save();
        Session::flash('success','Designation Added Successfully');
        return redirect()->route('setups.designation.view');
    }

    public function edit($id){
        $designation = Designation::findorFail($id);
        return view('backend.setup.designation.edit-designation', compact('designation'));
    }

    public function update(Request $request, $id){
        
        $designation = Designation::find($id);
        $request->validate([
            'name' => 'required|unique:designations,name,'.$designation->id
            ]);
        $designation->name = $request->name;
        $designation->save();
        Session::flash('success','Designation Updated Successfully');
        return redirect()->route('setups.designation.view');
    }

    public function delete($id){
        $designation = Designation::find($id)->delete();
        Session::flash('success','Designation Deleted Successfully');
        return redirect()->route('setups.designation.view');
    }
}
