<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AccountOtherCost;
use Illuminate\Support\Facades\Session;

class OtherCostController extends Controller
{
    public function view(){
        $data = AccountOtherCost::orderBy('id','DESC')->get();
        return view('backend.account.othercost.cost-view',compact('data'));
    }

    public function add(){
        return view('backend.account.othercost.cost-add');
    }

    public function store(Request $request){

        $data = new AccountOtherCost();
        $data->date = date('Y-m-d',strtotime($request->date));
        $data->amount = $request->amount;
        $data->description = $request->description;

        if($request->file('image')) {
            $file = $request->file('image');
            $filename = date('Ymdhi').$file->getClientOriginalName();
            $file->move(public_path('upload/cost_images'), $filename);
            $data['image'] = $filename;

        }

        $data->save();
        Session::flash('success','Cost Added Successfully');
        return redirect()->route('accounts.cost.view');
    }

    public function edit($id){
        $data = AccountOtherCost::findOrFail($id);
        return view('backend.account.othercost.cost-edit', compact('data'));
    }

    public function update(Request $request,$id){
        $data = AccountOtherCost::findOrFail($id)->first();

        $data->date = date('Y-m-d',strtotime($request->date));
        $data->amount = $request->amount;
        $data->description = $request->description;
        if($request->file('image')) {
            @unlink(public_path('upload/cost_images/'.$data->image));
            $file = $request->file('image');
            $filename = date('Ymdhi').$file->getClientOriginalName();
            $file->move(public_path('upload/cost_images'), $filename);
            $data['image'] = $filename;
        
        }
        $data->save();
        Session::flash('success','Cost Updated Successfully');
        return redirect()->route('accounts.cost.view');
    }

    public function delete($id){
        $data = AccountOtherCost::findOrFail($id)->delete();
        Session::flash('success','Cost Deleted Successfully');
        return redirect()->route('accounts.cost.view');
    }

    

}
