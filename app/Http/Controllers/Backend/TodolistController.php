<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Todolist;
use Auth;

class TodolistController extends Controller
{
    public function view() {
        $data['allData'] = Todolist::all();

        return view('backend.layouts.home', $data);
    }

    public function add() {
        
        return view('backend.layouts.home');
    }

    public function store(Request $request) {
        
        $this->validate($request, [
            'date'          => 'required|date',
            'name'          => 'required',
            'department'    => 'required',
            'email'         => 'required|email|unique:todolists,email'
        ]);

        $data = new Todolist();
        $data->date = date('Y-m-d h:i:s', strtotime($request->date));
        $data->name = $request->name;
        $data->department = $request->department;
        $data->email = $request->email;
        $data->created_by = Auth::user()->id;
        $data->save();

        return redirect()->route('todolists.view')->with('success', 'Data inserted successfully');
    }

    public function edit($id) {
        $data['editData'] = Todolist::find($id);
        $data['allData'] = Todolist::all();

        return view('backend.todolist.view-todolist', $data);
    }

    public function update(Request $request, $id) {
        $data = Todolist::findOrFail($id);

        // Data validation
        $this->validate($request, [
            'date' => 'required|date',
            'name' => 'required',
            'department' => 'required',
            'email' => 'required|email|unique:todolists,email,'.$data->id,
        ]);

        $data->date = date('Y-m-d h:i:s', strtotime($request->date));
        $data->name = $request->name;
        $data->department = $request->department;
        $data->email = $request->email;
        $data->updated_by = Auth::user()->id;
        $data->save();

        return redirect()->route('todolists.view')->with('success', 'Data updated successfully');
    }

    public function delete(Request $request) {
        $todolist = Todolist::find($request->id);
        $todolist->delete();

        return redirect()->route('todolists.view')->with('success', 'Data deleted successfully');
    }

    public function search(Request $request)
    {
        if (empty($request)) {

            $data['allData'] = Todolist::paginate(3);

            return view('backend.layouts.home', $data);
            
        } else {

            $data['allData'] = Todolist::where('date', 'like', '%'.$request->search.'%')->paginate(3);

            return view('backend.layouts.home', $data);
        }
    }
}
