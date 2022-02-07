<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    public function viewRole() {
        $data['allData'] = Role::all();

        return view('backend.role.view-role', $data);
    }

    public function addRole() {
        return view('backend.role.add-role');
    }

    public function storeRole(Request $request) {

        $this->validate($request, [
            'name' => 'required|unique:roles,name'
        ]);

        $data = new Role();
        $data->name = $request->name;
        $data->guard_name = 'web';
        $data->save();

        return redirect()->route('roles.view')->with('success', 'Data inserted successfully');
    }

    public function editRole($id) {
        $editData = Role::find($id);

        return view('backend.role.add-role', compact('editData'));
    }

    public function updateRole(Request $request, $id) {
        $data = Role::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|unique:roles,name,'.$data->id,
        ]);

        $data->name = $request->name;
        $data->save();

        return redirect()->route('roles.view')->with('success', 'Data Updated Successfully');
    }

    public function deleteRole(Request $request) {
        $role = Role::find($request->id);
        $role->delete();

        return redirect()->route('permissions.view')->with('success', 'Data deleted successfully');
    }
}
