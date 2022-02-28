<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use DB;

class RoleController extends Controller
{
    public function viewRole() {
        $data['allData'] = Role::all();

        return view('backend.role.view-role', $data);
    }

    public function addRole() {
        $data['permissions'] = Permission::all();
        $data['editData'] = null;
        return view('backend.role.add-role', $data);
    }

    public function storeRole(Request $request) {
        DB::beginTransaction();

        try{
            $this->validate($request, [
                'name' => 'required|unique:roles,name',
                'permission' => 'required|exists:permissions,name'
            ]);
    
            $data = new Role();
            $data->name = $request->name;
            $data->guard_name = 'web';
            $data->save();

            $data->givePermissionTo($request->permission);

            DB::commit();

        } catch(Exception $e) {
            DB::rollback();
        }

        return redirect()->route('roles.view')->with('success', 'Data inserted successfully');
    }

    public function editRole($id) {
        $permissions = Permission::all();

        $editData = Role::find($id);
        
        $get_all_permission_name = $editData->permissions()->pluck('name')->toArray();
        //$temp = implode(', ', ($get_all_permission_name));
        $temp = "'" . implode ( "', '", $get_all_permission_name ) . "'";
        
        return view('backend.role.add-role', compact('editData', 'permissions', 'get_all_permission_name','temp'));
    }

    public function updateRole(Request $request, $id) {
        DB::beginTransaction();

        try{
            $data = Role::findOrFail($id);

            $this->validate($request, [
                'name' => 'required|unique:roles,name,'.$data->id,
                'permission' => 'required|exists:permissions,name'
            ]);

            $data->name = $request->name;
            $data->guard_name = 'web';
            $data->save();

            $data->syncPermissions($request->permission);

            DB::commit();

        } catch(Exception $e) {
            DB::rollback();
        }
        

        return redirect()->route('roles.view')->with('success', 'Data Updated Successfully');
    }

    public function deleteRole(Request $request) {
        $role = Role::find($request->id);
        $role->delete();

        return redirect()->route('permissions.view')->with('success', 'Data deleted successfully');
    }
}
