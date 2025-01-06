<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    // Handle user login
    public function login(Request $request)
    {
       // dd($request->all()); // Dump and die all request data
        $credentials = $request->only('emis_code', 'password');
        //dd($credentials);
        if (Auth::attempt($credentials)) {

            // Authentication successful
            $user = Auth::user();
            //dd($user); // Dump and die the authenticated user
           
             return redirect()->intended('/dashboard'); // Redirect to dashboard after login
        }

        // Authentication failed
        return redirect()->route('login')->with('error', 'Invalid email or password');
    }

   
    public function logout()
    {
        Auth::logout(); // Log the user out
        return redirect()->route('login'); // Redirect to login page after logout
    }
}
