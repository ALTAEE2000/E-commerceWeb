<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    function loginAdmin()
    {
        return view('Dashboard\authLogin');
    }
    function check(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:5|max:30'
        ];
        $messages = [
            'email.exists' => 'This email is not exists in admins table',
            'email.required' => 'This email is required',
            'email.email' => 'This email should be email',
            'password.required' => 'This password is required',
            'password.required' => 'This password is required',
        ];

        //Validate Inputs
        $remember_me = $request->has('remember_me') ? true : false;
        $validator =  Validator::make($request->only('email', 'password'), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }


        $creds = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($creds)) {
            return redirect()->route('admin.');
        } else {
            return redirect()->route('admin.login')->with('fail', 'Incorrect credentials');
        }
    }

    function logout()
    {
        Auth::guard('admin')->logout();
        return 'success';
    }

    function dashboard()
    {
        return view('Dashboard.dashboard');
    }
}
