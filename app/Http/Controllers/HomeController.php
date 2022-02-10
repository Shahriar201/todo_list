<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Todolist;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //----Create Role------//
        // $role = Role::create(['name' => 'writer']);
        // $role = Role::create(['name' => 'editor']);
        // $role = Role::create(['name' => 'admin']);

        //-----Create Permission-----//
        // Permission::create(['name' => 'create']);
        // Permission::create(['name' => 'edit']);
        // Permission::create(['name' => 'delete']);

        //-----Role has Permissions----//
        // $role = Role::findById(2);

        // $permission1 = Permission::findById(1);
        // $permission2 = Permission::findById(2);
        // $permission3 = Permission::findById(3);

        // $role->givePermissionTo($permission1, $permission2);

        // $role->givePermissionTo([$permission1, $permission2, $permission3]);


        //----------Permission with  model-----------//
        // $role = Role::create(['name' => 'writer']);

        // $permission = Permission::create(['name' => 'edit post']);

        // $role = Role::findById('1');

        // $permission1 = Permission::findById('1');
        // $permission2 = Permission::findById('2');
        // $permission3 = Permission::findById('3');

        // $role->givePermissionTo($permission1, $permission2, $permission3);

        //------Model has Role && Permissions-----//
        // auth()->user()->assignRole(['admin']);
        
        // auth()->user()->givePermissionTo([$permission1, $permission2, $permission3]);

        // auth()->user()->assignRole(['admin']);

        // return auth()->user()->getAllPermissions();

        return view('backend.layouts.home');
    }

    public function view() {
        $data['allData'] = Todolist::where('created_by', Auth::user()->id)->get();

        return view('backend.layouts.home', $data);
    }

    public function add() {
        dd('Ok');
        return view('backend.layouts.home');
    }

    public function store(Request $request) {
        
        $this->validate($request, [
            'name'          => 'required',
            'department'    => 'required',
            'email'         => 'required|email|unique:todolists,email'
        ]);

        $data = new Todolist();
        // $data->date = date('Y-m-d h:i:s', strtotime($request->date));
        $data->name = $request->name;
        $data->department = $request->department;
        $data->email = $request->email;
        $data->created_by = Auth::user()->id;
        $data->save();

        return redirect()->route('home')->with('success', 'Data inserted successfully');
    }

    public function edit($id) {
        $data['editData'] = Todolist::find($id);
        $data['allData'] = Todolist::all();

        return view('backend.layouts.home', $data);
    }

    public function update(Request $request, $id) {
        $data = Todolist::findOrFail($id);

        // Data validation
        $this->validate($request, [
            'name' => 'required',
            'department' => 'required',
            'email' => 'required|email|unique:todolists,email,'.$data->id,
        ]);

        // $data->date = date('Y-m-d h:i:s', strtotime($request->date));
        $data->name = $request->name;
        $data->department = $request->department;
        $data->email = $request->email;
        $data->updated_by = Auth::user()->id;
        $data->save();

        return redirect()->route('home')->with('success', 'Data updated successfully');
    }

    public function delete(Request $request) {
        $todolist = Todolist::find($request->id);
        $todolist->delete();

        return redirect()->route('home')->with('success', 'Data deleted successfully');
    }

    public function search(Request $request)
    {
        if (empty($request)) {

            $data['allData'] = Todolist::where('created_by', Auth::user()->id)->get();

            return view('backend.layouts.home', $data);
            
        } else {

            $data['allData'] = Todolist::where('created_at', 'like', '%'.$request->search.'%')->where('created_by', Auth::user()->id)->paginate(3);

            return view('backend.layouts.home', $data);
        }
    }
}
