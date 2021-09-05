<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AssignStudent;
use App\Model\DiscountStudent;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use App\Model\StudentYear;
use App\User;
use DB;
use PDF;
use Illuminate\Support\Facades\Session;


class EmployeeRegController extends Controller
{
    public function view(){
        
        $class = StudentClass::all();
        $year = StudentYear::orderBy('id','DESC')->get();
        $year_id = StudentYear::orderBy('id','DESC')->first()->id;
        $class_id = StudentClass::orderBy('id','ASC')->first()->id;
        $data = AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->get();
        return view('backend.student.student_reg.view-student', compact('data','year','class','year_id','class_id'));
    }


    public function searchStudent(Request $request){
        $class = StudentClass::all();
        $year = StudentYear::orderBy('id','DESC')->get();
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $data = AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->get();
        return view('backend.student.student_reg.view-student', compact('data','year','class','year_id','class_id'));
    }


    public function add(){
        $class = StudentClass::all();
        $shift = StudentShift::all();
        $year = StudentYear::orderBy('id','DESC')->get();
        $group = StudentGroup::all();
        return view('backend.student.student_reg.add-student', compact('class','group','year','shift'));
    }

    public function store(Request $request){
        DB::transaction(function() use($request){
            $checkYear = StudentYear::find($request->year_id)->name;
            $student = User::where('usertype', 'student')->orderBy('id', 'DESC')->first();
            if($student == null){
                $firstreg = 0;
                $studentId = $firstreg+1;
                if($studentId < 10){
                    $id_no = '000'.$studentId;
                }elseif($studentId < 100){
                    $id_no = '00'.$studentId;
                }elseif($studentId < 1000){
                    $id_no = '0'.$studentId;
                }
                
            }else{
                $student = User::where('usertype', 'student')->orderBy('id', 'DESC')->first()->id;
                $studentId = $student+1;

                if($studentId < 10){
                    $id_no = '000'.$studentId;
                }elseif($studentId < 100){
                    $id_no = '00'.$studentId;
                }elseif($studentId < 1000){
                    $id_no = '0'.$studentId;
                }
            }

            $final_id_no = $checkYear.$id_no;

            $user = new User();  //User table data insert
            $user->id_no = $final_id_no;
            $user->usertype = 'student';
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            $code = rand(0000,9999);
            $user->password = bcrypt($code);
            $user->code = $code;
            if($request->file('image')) {
            $file = $request->file('image');
            $filename = date('Ymdhi').$file->getClientOriginalName();
            $file->move(public_path('upload/student_images'), $filename);
            $user['image'] = $filename;
        
        }

            $user->save();

            $assign_student = new AssignStudent();
            $assign_student->student_id = $user->id;
            $assign_student->year_id = $request->year_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();


            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->discount = $request->discount;
            $discount_student->fee_category_id = '3';
            $discount_student->save();
            

            

        });
        Session::flash('success','Student Registration Successfully');
        return redirect()->route('students.registration.view');
    }


    public function edit($student_id){
        $class = StudentClass::all();
        $shift = StudentShift::all();
        $year = StudentYear::orderBy('id','DESC')->get();
        $group = StudentGroup::all();
        $data = AssignStudent::where('student_id',$student_id)->first();
        return view('backend.student.student_reg.edit-student', compact('data','class','shift','year','group'));
     }


     public function update(Request $request, $student_id){
         
            
            $user = User::where('id',$student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            if($request->file('image')) {
            @unlink(public_path('upload/student_images/'.$user->image));
            $file = $request->file('image');
            $filename = date('Ymdhi').$file->getClientOriginalName();
            $file->move(public_path('upload/student_images'), $filename);
            $user['image'] = $filename;
        
        }

            $user->save();


            $assign_student = AssignStudent::where('id',$request->id)->where('student_id',$student_id)->first();
            $assign_student->year_id = $request->year_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();


            $discount_student = DiscountStudent::where('assign_student_id',$request->id)->first();
            $discount_student->discount = $request->discount;
            $discount_student->save();
            

            

        
        Session::flash('success','Student Registration Updated Successfully');
        return redirect()->route('students.registration.view');
     }


     public function promotion($student_id){
         $class = StudentClass::all();
        $shift = StudentShift::all();
        $year = StudentYear::orderBy('id','DESC')->get();
        $group = StudentGroup::all();
        $data = AssignStudent::where('student_id',$student_id)->first();
        return view('backend.student.student_reg.promotion-student', compact('data','class','shift','year','group'));
     }


          public function promotionStore(Request $request, $student_id){
         
            
            $user = User::where('id',$student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            if($request->file('image')) {
            @unlink(public_path('upload/student_images/'.$user->image));
            $file = $request->file('image');
            $filename = date('Ymdhi').$file->getClientOriginalName();
            $file->move(public_path('upload/student_images'), $filename);
            $user['image'] = $filename;
        
        }

            $user->save();


            $assign_student = new AssignStudent();
            $assign_student->student_id = $student_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();


            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->discount = $request->discount;
            $discount_student->fee_category_id = '3';
            $discount_student->save();
            

            

        
        Session::flash('success','Student Promotion Successfully');
        return redirect()->route('students.registration.view');
     }


     public function studentDetails($student_id){

        $data = AssignStudent::where('student_id',$student_id)->first();
        $pdf = PDF::loadView('backend.student.student_reg.student_details', compact('data'));
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
     }
}
