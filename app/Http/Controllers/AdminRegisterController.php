<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminRegisterController extends Controller
{
    public function showForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => true, // Important: Set is_admin to true
        ]);

        return redirect('/login')->with('success', 'Admin account created! You can now log in.');
    }
}

