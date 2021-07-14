<?php

namespace App\Http\Controllers\Backend\Setup;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Subjecct;
use DB;


class SubjectController extends Controller
{
    public function view(){
        $data = Subjecct::all();
        return view('backend.setup.subject.view-subject', compact('data'));
    }

    public function add(){
        return view('backend.setup.subject.add-subject');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:subjeccts,name',
            ]);
        $subject = new Subjecct();
        $subject->name = $request->name;
        $subject->save();
        Session::flash('success','Subject Added Successfully');
        return redirect()->route('setups.subject.view');
    }

    public function edit($id){
        $subject = Subjecct::findorFail($id);
        return view('backend.setup.subject.edit-subject', compact('subject'));
    }

    public function update(Request $request, $id){
        
        $subject = Subjecct::find($id);
        $request->validate([
            'name' => 'required|unique:subjeccts,name,'.$subject->id
            ]);
        $subject->name = $request->name;
        $subject->save();
        Session::flash('success','Subject Updated Successfully');
        return redirect()->route('setups.subject.view');
    }

    public function delete($id){
        $subject = Subjecct::find($id)->delete();
        Session::flash('success','Subject Deleted Successfully');
        return redirect()->route('setups.subject.view');
    }
}
