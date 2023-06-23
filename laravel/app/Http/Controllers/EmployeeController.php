<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;

class EmployeeController extends Controller
{
    //
    public function index()
    {
        $employee=employee::all();
        //$emptree=employee::tree();
        //$employee = employee::query()->parentsOnly()->with('child')->get();
        //print_r($employee);die;s
        //print '<pre>';print_r(response()->json($emptree));die;
        return response()->json($employee);
    }
    public function store(Request $request)
    {
        $employees = new employee([
            'Name' => $request->input('name'),
            'parentid' => $request->input('parentname')
       ]);
        $employees->save();
        return response()->json('Employee created!');
    }
    public function show($id)
    {
        $contact = employee::find($id);
        return response()->json($contact);
    }
    public function update(Request $request, $id)
    {
       $employees = employee::find($id);
       $employees->update($request->all());
       return response()->json('Employee updated');
    }
    public function destroy($id)
    {
        $employees = employee::find($id);
        $employees->delete();
        return response()->json(' deleted!');
    }
}
