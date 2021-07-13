<?php

namespace App\Http\Controllers\Backend\Setup;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\FeeCategory;
use DB;

class FeeCategoryController extends Controller
{
    public function view(){
        $data = FeeCategory::all();
        return view('backend.setup.fee_category.view-fee-category', compact('data'));
    }

    public function add(){
        return view('backend.setup.fee_category.add-fee-category');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:feecategories,name',
            ]);
        $fee = new FeeCategory();
        $fee->name = $request->name;
        $fee->save();
        Session::flash('success','Fee Category Added Successfully');
        return redirect()->route('setups.fee.category.view');
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
