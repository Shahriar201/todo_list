<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function viewPermission() {
        $data['allData'] = Permission::all();

        return view('backend.permission.view-permission', $data);
    }

    public function addPermission() {
        return view('backend.permission.add-permission');
    }

    public function storePermission(Request $request) {
        
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);

        $data = new Permission();
        $data->name = $request->name;
        $data->guard_name = 'web';
        $data->save();

        return redirect()->route('permissions.view')->with('success', 'Data inserted successfully');
    }

    public function editPermission($id){
        $editData = Permission::find($id);

        return view('backend.permission.add-permission', compact('editData'));
    }

    public function updatePermission(Request $request, $id){
        $data = Permission::findOrFail($id);
        
        $this->validate($request,[
            'name' => 'required|unique:permissions,name,'.$data->id,
        ]);

        $data->name = $request->name;
        $data->save();

        return redirect()->route('permissions.view')->with('success', 'Data Updated Successfully');
    }

    public function deletePermission(Request $request){
        $permission = Permission::find($request->id);
        $permission->delete();

        return redirect()->route('permissions.view')->with('success', 'Data deleted successfully');
    }
}
