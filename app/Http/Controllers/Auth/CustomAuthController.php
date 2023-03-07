<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use  App\Models\ResetToken;
use  App\Models\User;
use Str;
use Hash;
class CustomAuthController extends Controller
{
    public function logout()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('login');
    }

    public function reset_password()
    {
        return view("auth.reset");   
    }

    public function reset_password_send(Request $request)
    {
        $request->validate([
            "email" => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user) {
            return redirect()->back()->withErrors(["email" => "Email does not exists."]);
        }

        $token = ResetToken::where(["user_id" => $user->id])->firstOrCreate([
            "user_id" => $user->id,
            "token" => Str::random(30)
        ]);

        return redirect()->back()->with('token', $token->token);   
    }

    public function change_password($token)
    {
        $token = ResetToken::where(["token" => $token])->firstOrFail();
        $user = User::find($token->user_id);

        return view("auth.change", ['token' => $token->token]);      
    }

    public function change_password_send(Request $request, $token)
    {
        $token = ResetToken::where(["token" => $token])->firstOrFail();
        $user = User::findOrFail($token->user_id);

        $request->validate([
            'password' => 'required|min:6|max:18|confirmed',
            'password_confirmation' => 'required|min:6|max:18'
        ]);
        
        $user->update([
            'password' => Hash::make($request->input("password"))
        ]);

        $token->delete();

        return redirect()->route("login");
   
    }
}
