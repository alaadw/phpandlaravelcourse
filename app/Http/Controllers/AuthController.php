<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function showLogin()
    {
        // Logic to show the login form
        return view('auth.login');
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $credentials = $request->only('email', 'password');
        if( Auth::guard('article')->attempt($credentials)){
            return redirect()->route('articles.index')->with('success', 'Login successful!');
        }
        //if( auth()->attempt($credentials)){
        //    return redirect()->route('articles.index')->with('success', 'Login successful!');
        //}
        return redirect()->back()->with('error', 'Invalid credentials');
    }
    public function logout()
    {
        // Logic to log out the user
        Auth::guard('article')->logout();
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
    public function showRegister()
    {
        // Logic to show the registration form
        return view('auth.register');
    }
    public function register(Request $request)
    {
        // Logic to register a new user
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

    
        auth()->login($user);
        return redirect()->route('articles.index')->with('success', 'Registration successful!');
    }
}
