<?php

namespace App\Http\Controllers\Backend;
use App\User;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function view(){
        $data = User::where('usertype','Admin')->get();
        return view('backend.user.view-user', compact('data'));
    }

    public function add(){
        return view('backend.user.add-user');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',

            ]);
        
        $code = rand(0000,9999);
        $user = new User();
        $user->usertype = 'Admin';
        $user->role = $request->role;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($code);
        $user->code = $code;
        $user->save();
        Session::flash('success','User Added Successfully');
        return redirect()->route('users.view');
    }

    public function edit($id){
        $user = User::findorFail($id);
        return view('backend.user.edit-user', compact('user'));
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user->role = $request->role;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        Session::flash('success','User Updated Successfully');
        return redirect()->route('users.view');
    }

    public function delete($id){
        $user = User::find($id)->delete();
        Session::flash('success','User Deleted Successfully');
        return redirect()->route('users.view');
    }
}
