<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show the login page
    public function loginPage()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
    
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            // dd($user);
    
            if (strtolower($user->role) === 'admin') {
                return redirect('/category');
                // dd($user->role);
            } else {
                return redirect('/'); 
            }
        } else {
            return back()->withErrors([
                'loginError' => 'Invalid email or password.',
            ])->onlyInput('email');
        }
    }
    

    public function registerPage()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // dd(123);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'nullable|string',
        ]);
        
        // dd($data); 
    
        $data['password'] = Hash::make($data['password']);
    
        // Create the user
        User::create($data);
    
        return redirect()->route('loginPage')->with('success', 'Registration successful! Please log in.');
    }
    


}
