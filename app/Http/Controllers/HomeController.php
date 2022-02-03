<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

        // $role = Role::create(['name' => 'writer']);

        // Permission::create(['name' => 'create']);
        // Permission::create(['name' => 'edit']);
        // Permission::create(['name' => 'delete']);

        // $role = Role::findById(1);

        // $permission1 = Permission::findById(1);
        // $permission2 = Permission::findById(2);
        // $permission3 = Permission::findById(3);

        // $role->givePermissionTo([$permission1, $permission2, $permission3]);


        //----------Permission with  model-----------//
        // $role = Role::create(['name' => 'writer']);

        // $permission = Permission::create(['name' => 'edit post']);

        $role = Role::findById('2');

        $permission = Permission::findById('4');

        $role->givePermissionTo($permission);

        // auth()->user()->givePermissionTo('edit post');

        // auth()->user()->assignRole(['writer']);

        // return auth()->user()->getAllPermissions();

        return view('backend.layouts.home');
    }
}
