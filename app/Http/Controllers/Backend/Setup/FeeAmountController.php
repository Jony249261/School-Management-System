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
        $fee = FeeCategory::findorFail($id);
        return view('backend.setup.fee_category.edit-fee-category', compact('fee'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            ]);
        $fee = FeeCategory::find($id);
        $fee->name = $request->name;
        $fee->save();
        Session::flash('success','Fee Category Updated Successfully');
        return redirect()->route('setups.fee.category.view');
    }

    public function delete($id){
        $fee = FeeCategory::find($id)->delete();
        Session::flash('success','Fee Category Deleted Successfully');
        return redirect()->route('setups.fee.category.view');
    }
}
