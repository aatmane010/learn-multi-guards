<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'name'=>'bail|required|max:50',
            'email'=>'bail|required|email|unique:doctors,email',
            'phone'=>'bail|required',
            'hospital'=>'bail|required|max:50',
            'password'=>'bail|required|min:8|max:30',
            'cpassword'=>'bail|required|min:8|max:30|same:password'
        ]);

        $doctor = new Doctor();

        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->phone = $request->phone;
        $doctor->hospital = $request->hospital;
        $doctor->password = Hash::make($request->password);

        $save = $doctor->save();

        if($save){
            return redirect()->back()->with('success', 'You are registered successfully!');
        }
        else{
            return redirect()->back()->with('fail', 'Something wrong. Please try to register again!');
        }
    }

    public function check(Request $request){
        $request->validate([
            'email'=>'bail|required|email|exists:doctors,email',
            'password'=>'bail|required|min:8|max:30'
        ],[
            'email.exists'=>'This email doesn\'t exit.'
        ]);

        $login = $request->only('email', 'password');

        if(Auth::guard('doctor')->attempt($login)){
            return redirect()->route('doctor.home');
        }
        else{
            return redirect()->route('doctor.login')->with('fail', 'Incorrect Email or Password!');
        }
    }

    public function logout(){
        Auth::guard('doctor')->logout();
        return redirect('/');
    }
}
