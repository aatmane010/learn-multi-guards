<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function check(Request $request){
        $request->validate([
            'email'=>'bail|required|email|exists:admins,email',
            'password'=>'bail|required|min:8|max:30'
        ], [
            'email.exists'=>'This email doesn\'t exit.'
        ]);

        $login = $request->only('email', 'password');

        if(Auth::guard('admin')->attempt($login)){
            return redirect()->route('admin.home');
        }
        else{
            return redirect()->route('admin.login')->with('fail', 'Incorrect Email or Password!');
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
