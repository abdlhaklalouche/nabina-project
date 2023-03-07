<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function get()
    {
        return view('dashboard');
    }

    public function user_account_get()
    {
        return view('user_account')->with("users", User::all());
    }

    public function user_account_new()
    {
        return view('user_account_new');
    }

    public function user_account_store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'first_name' => 'required|min:3|max:12',
            'last_name' => 'required|min:3|max:12',
            'position' => 'required|min:3|max:12',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|integer|in:0,1,2',
            'password' => 'required|min:6|max:18',
        ]);
        
        if($validate->fails()){
            return back()->withErrors($validate->errors())->withInput();
        }

        User::create([
            'first_name' => $request->input("first_name"),
            'last_name' => $request->input("last_name"),
            'position' => $request->input("position"),
            'email' => $request->input("email"),
            'role' => $request->input("role"),
            'password' => Hash::make($request->input("password")),
        ]);

        return redirect()->route('user_account');
    }

    public function employee()
    {
        return view('employee');
    }

    public function hr()
    {
        return view('hr');
    }
}
