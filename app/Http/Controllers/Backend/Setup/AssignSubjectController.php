<?php

namespace App\Http\Controllers\Backend\Setup;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\Subjecct;
use App\Model\AssignSubject;
use DB;


class AssignSubjectController extends Controller
{
    public function view(){
        $data = AssignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.setup.assign_subject.view-assign-subject', compact('data'));
    }

    public function add(){
        $subject = Subjecct::all();
        $class = StudentClass::all();
        return view('backend.setup.assign_subject.add-assign-subject', compact('subject', 'class'));
    }

    public function store(Request $request){
        $request->validate([
            'full_mark' => 'required',
            'pass_mark' => 'required',
            'get_mark' => 'required',
            'subject_id' => 'required',
            'class_id' => 'required',
            ]);
        
            $countSubject = count($request->subject_id);
            if($countSubject !=NULL){
                for($i=0; $i<$countSubject; $i++){
                    $assign_subject = new AssignSubject();
                    $assign_subject->subject_id = $request->subject_id[$i];
                    $assign_subject->class_id = $request->class_id;
                    $assign_subject->full_mark = $request->full_mark[$i];
                    $assign_subject->pass_mark = $request->pass_mark[$i];
                    $assign_subject->get_mark = $request->get_mark[$i];
                    $assign_subject->save();
                }
            }

            Session::flash('success','Assign Subject Added Successfully');
        return redirect()->route('setups.assign.subject.view');
        
    }

    public function edit($id){
        $data = AssignSubject::where('class_id',$id)->get();
        $subject = Subjecct::all();
        $class = StudentClass::all();
        return view('backend.setup.assign_subject.edit-assign-subject', compact('data','subject', 'class'));
    }

    public function update(Request $request, $id){
        
            if($request->subject_id == NULL){
                Session::flash('error','Sorry! You Dont Select Any Subject!');
                return redirect()->back();
            }else{
                    AssignSubject::whereNotIn('subject_id',$request->subject_id)->where('class_id',$request->class_id)->delete();
                    foreach($request->subject_id as $key => $value){
                        $asign_subject_exist = AssignSubject::where('subject_id',$request->subject_id[$key])->where('class_id',$request->class_id)->first();
                        if($asign_subject_exist){
                            $assignSubject = $asign_subject_exist;
                        }else{
                            $assignSubject = New AssignSubject();
                        }
                        $assignSubject->subject_id = $request->subject_id[$key];
                        $assignSubject->class_id = $request->class_id;
                        $assignSubject->full_mark = $request->full_mark[$key];
                        $assignSubject->pass_mark = $request->pass_mark[$key];
                        $assignSubject->get_mark = $request->get_mark[$key];
                        $assignSubject->save();
                
                    
                    }
                
            }
        

            Session::flash('success','Assign Subject Updated Successfully');
        return redirect()->route('setups.assign.subject.view');
    }

    public function details($id){
        
        $data = AssignSubject::where('class_id',$id)->get();
    
        return view('backend.setup.assign_subject.details-assign-subject', compact('data'));
    }

    public function delete($id){
        $data = AssignSubject::where('class_id',$id)->delete();
        Session::flash('success','Assign Subject Deleted Successfully');
        return redirect()->route('setups.assign.subject.view');
    }
}
