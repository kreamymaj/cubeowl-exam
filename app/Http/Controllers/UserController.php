<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function count(){
        $totalUsers = User::count();
        return response()->json($totalUsers);
    }

    public function index(Request $request){
        $query = User::query();    
        $users = $query->orderBy('id', 'desc')->paginate(5);
     
        return view('users.index', compact('users'));
    }

    public function edit($id){
        $user = User::find($id);
        return view('users.update', compact('user'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'password' => 'required|string|max:255|min:8',
            'email' => "required|string|email|max:255|unique:users,email,$request->id,id",
            'userType' => 'required|string|max:255',
            'accountStatus' => 'required|string|max:255',

           
        ]);

        $user = User::find($id);
        if (!$user) {
            // Handle the case when the patient is not found
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        // $user->password = $request->input('password');
        $user->password = bcrypt($request->input('password'));
        $user->email = $request->input('email');
        $user->userType = $request->input('userType');
        $user->accountStatus = $request->input('accountStatus');
        $user->save();
        return response()->json(['message' => 'User Record Updated Successfully'], 200);
    }
    
    public function deleteUser($id){
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User Record not found');
        }   
        $user->delete();
        return redirect()->back()->with('success', 'User Record deleted successfully');
    }

    public function permissions(){
        return view('users.permissions');
    }
}



