<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //Register
    public function create(Request $request){
        // Data Validation
        $request->validate([
            'name'=>'bail|required|max:50',
            'email'=>'bail|required|email|unique:users,email', // Unique in Users table and email column
            'password'=>'bail|required|min:8|max:30',
            'cpassword'=>'bail|required|min:8|max:30|same:password'
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $save = $user->save();

        if($save){
            return redirect()->back()->with('success', 'You are registered successfully!');
        }
        else{
            return redirect()->back()->with('fail', 'Something wrong. Please try to register again!');
        }
    }

    // Login
    public function check(Request $request){
        // Inputs Validation
        $request->validate([
            'email'=>'bail|required|email|exists:users,email',
            'password'=>'bail|required|min:8|max:30'
        ], [
            'email.exists'=>'This email doesn\'t exit.' // change error message when email user doesn't exist on the table
        ]);

        $creds = $request->only('email', 'password'); // creds = credentials

        if(Auth::guard('web')->attempt($creds)){
            return redirect()->route('user.home');
        }
        else{
            return redirect()->route('user.login')->with('fail', 'Incorrect Email or Password!');
        }
    }

    // Logout
    public function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
