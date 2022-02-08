<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;

class ProfileController extends Controller
{
    public function view(){
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('backend.user.view-profile', compact('user'));
    }

    public function edit(){
        $id = Auth::user()->id;
        $editData = User::find($id);

        return view('backend.user.edit-profile', compact('editData'));
    }

    public function update(Request $request){
        $data = User::find(Auth::user()->id);

        //Data Validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$data->id,
        ]);

        $data->name = $request->name;
        $data->email = $request->email;
        
        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/user_images/'.$data->image));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $fileName);
            $data['image'] = $fileName;

        }
        $data->save();

        return redirect()->route('profiles.view')->with('success', 'Profile updated successfully');

    }

    public function passwordView(){

        return view('backend.user.edit-password');
    }

    public function passwordUpdate(Request $request){
        if(Auth::attempt(['id' => Auth::user()->id, 'password' => $request->current_password])){

            //Data Validation
            $this->validate($request, [
                'current_password' => 'required',
                'new_password' => 'required|min:6'
            ]);
            
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->new_password);
            $user->save();

            return redirect()->route('profiles.view')->with('success', 'Password changed successfully');

        }else{
            return redirect()->back()->with('error', 'Sorry! your current password does not match');
        }
    }
}
