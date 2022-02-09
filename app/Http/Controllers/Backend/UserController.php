<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\User;

class UserController extends Controller
{
    public function view(){

        $data['allData'] = User::all();

        return view('backend.user.view-user', $data);
    }

    public function add(){
        $data['roles'] = Role::all();

        return view('backend.user.add-user', $data);
    }

    public function store(Request $request){

        // data validation
        $this->validate($request,[
            // 'date'          => 'required|date',
            'role'          => 'required|exists:roles,name',
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:6',
        ]);

        $data = new User();
        // $data->date = date('Y-m-d', strtotime($request->date));
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        $data->assignRole($request->role);
        return redirect()->route('users.view')->with('success', 'Data inserted successfully');
    }

    public function edit($id){
        $editData = User::find($id);
        $roles = Role::all();

        return view('backend.user.edit-user', compact('editData', 'roles'));
    }

    public function update(Request $request, $id){

        $data = User::findOrFail($id);

        $this->validate($request,[
            'role'       => 'required|exists:roles,name',
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email,'.$data->id,
        ]);

        // $data->date = date('Y-m-d', strtotime($request->date));
        $data->name = $request->name;
        $data->email = $request->email;
        $data->save();
        $data->assignRole($request->role);

        return redirect()->route('users.view')->with('success', 'Data updated successfully');

    }

    public function delete(Request $request){
        $user = User::find($request->id);
        $user->delete();
        $user->removeRole($request->role);

        return redirect()->route('users.view')->with('success', 'Data deleted successfully');
    }

    public function search(Request $request)
    {
        if (empty($request)) {

            $data['allData'] = User::paginate(3);

            return view('backend.user.view-user', $data);
            
        } else {

            $data['allData'] = User::where('date', 'like', '%'.$request->search.'%')->paginate(3);

            return view('backend.user.view-user', $data);
        }
    }
}
