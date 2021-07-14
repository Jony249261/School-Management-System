<?php

namespace App\Http\Controllers\Backend\Setup;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\FeeCategory;
use App\Model\StudentClass;
use App\Model\FeeCategoryAmount;
use DB;


class FeeAmountController extends Controller
{
    public function view(){
        $data = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.fee_amount.view-fee-amount', compact('data'));
    }

    public function add(){
        $fee = FeeCategory::all();
        $class = StudentClass::all();
        return view('backend.setup.fee_amount.add-fee-amount', compact('fee', 'class'));
    }

    public function store(Request $request){
        $request->validate([
            'amount' => 'required',
            'fee_category_id' => 'required',
            'class_id' => 'required',
            ]);
        
            $countClass = count($request->class_id);
            if($countClass !=NULL){
                for($i=0; $i<$countClass; $i++){
                    $fee_amount = new FeeCategoryAmount();
                    $fee_amount->fee_category_id = $request->fee_category_id;
                    $fee_amount->class_id = $request->class_id[$i];
                    $fee_amount->amount = $request->amount[$i];
                    $fee_amount->save();
                }
            }

            Session::flash('success','Fee Category Amount Added Successfully');
        return redirect()->route('setups.fee.amount.view');
        
    }

    public function edit($id){
        $data = FeeCategoryAmount::where('fee_category_id',$id)->get();
        $fee = FeeCategory::all();
        $class = StudentClass::all();
        return view('backend.setup.fee_amount.edit-fee-amount', compact('data','fee', 'class'));
    }

    public function update(Request $request, $id){
        
            if($request->class_id == NULL){
                Session::flash('error','Sorry! You Dont Select Any Class!');
                return redirect()->back();
            }else{
                FeeCategoryAmount::where('fee_category_id',$id)->delete();
                $countClass = count($request->class_id);
            
                for($i=0; $i<$countClass; $i++){
                    $fee_amount = new FeeCategoryAmount();
                    $fee_amount->fee_category_id = $request->fee_category_id;
                    $fee_amount->class_id = $request->class_id[$i];
                    $fee_amount->amount = $request->amount[$i];
                    $fee_amount->save();
                }
                
            }
        

            Session::flash('success','Fee Category Amount Updated Successfully');
        return redirect()->route('setups.fee.amount.view');
    }

    public function details($id){
        $data = FeeCategoryAmount::where('fee_category_id',$id)->get();
        
        return view('backend.setup.fee_amount.details-fee-amount', compact('data'));
    }

    public function delete($id){
        $data = FeeCategoryAmount::where('fee_category_id',$id)->delete();
        Session::flash('success','Fee Category Amount Deleted Successfully');
        return redirect()->route('setups.fee.amount.view');
    }
}
