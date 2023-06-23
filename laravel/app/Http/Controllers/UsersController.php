<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users;

class UsersController extends Controller
{
    //
    public function index()
    {
        $users=users::all();
        return response()->json(['users'=>$users],200);
    }
    public function adduser(Request $request)
    {
        $users=new users();
        $users->name=$request->name;
        $users->email=$request->email;
        $users->phone_no=$request->phone_no;
        $users->password=$request->password;
        $users->save();
        return response()->json(['res'=>'User Created Successfully']);
    }
    public function getusers()
    {
        $users=users::all();
        return response()->json(['users'=>$users]);
    }
    public function getuserData($id){
        $users=users::where('id',$id)->get();
        return view('edit-users',['users'=>$users]);
    }
    public function updateuser(Request $request)
    {
       // print_r($request);die;
        $users=users::find($request->id);
       // print_r($users);die;
        $users->name=$request->name;
        $users->email=$request->email;
        $users->phone_no=$request->phone_no;
        $users->password=$request->password;
        $users->save();
        
        return response()->json(['res'=>'User Updated Successfully']);
    }
}
