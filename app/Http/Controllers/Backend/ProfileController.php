<?php

namespace App\Http\Controllers\Backend;
use Auth;
use App\User;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function view(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend.profile.view-profile', compact('user'));
    }

    public function edit(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend.profile.edit-profile', compact('user'));
    }

    public function update(Request $request){
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->gender = $request->gender;
        if($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/user_images/'.$user->image));
            $filename = date('Ymdhi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $user['image'] = $filename;
        
        }
        $user->save();
        Session::flash('success','Profile Updated Successfully');
        return redirect()->route('profiles.view');
    }

    public function passwordView(){
        return view('backend.profile.edit-password');
    }

    public function passwordUpdate(Request $request){
        if(Auth::attempt(['id'=>Auth::user()->id, 'password'=>$request->current_password])){
            $id = Auth::user()->id;
            $user = User::find($id);
            $user->password = bcrypt($request->new_password);
            $user->save();
        Session::flash('success','Password Updated Successfully');
        return redirect()->route('profiles.view');

        }else{
           session::flash('error','Sorry! Your Current Password Does Not Match');
        return redirect()->back();
        }
    }
}
