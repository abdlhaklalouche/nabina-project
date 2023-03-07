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

    public function employee()
    {
        return view('employee');
    }

    public function hr()
    {
        return view('hr');
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
            'position' => 'required|min:3|max:18',
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

    public function user_account_view($id)
    {
        $user = User::findOrFail($id);

        return view("update", ["user" => $user]);
    }

    public function user_account_update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validate = Validator::make($request->all(), [
            'first_name' => 'required|min:3|max:12',
            'last_name' => 'required|min:3|max:12',
            'position' => 'required|min:3|max:18',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|integer|in:0,1,2',
            'password' => 'nullable|min:6|max:18',
        ]);
        
        if($validate->fails()){
            return back()->withErrors($validate->errors())->withInput();
        }

        $updateData = [
            'first_name' => $request->input("first_name"),
            'last_name' => $request->input("last_name"),
            'position' => $request->input("position"),
            'email' => $request->input("email"),
            'role' => $request->input("role")
        ];

        if($request->filled("password")) {
            $updateData['password'] = Hash::make($request->input("password"));
        }


        $user->update($updateData);

        return redirect()->route('user_account_update', ["id" => $user->id])->with("message" , "updated successfly");
    }

    public function user_account_delete($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('user_account');
    }
}
