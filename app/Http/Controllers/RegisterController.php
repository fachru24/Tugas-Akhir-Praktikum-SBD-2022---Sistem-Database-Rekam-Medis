<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('register.index', [
            'tittle' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request) {
        $ValidatedData = $request->validate([
            'name' => 'required',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'email' => 'required|email:dns',
            'password' => 'required', 'min:3', 'max:255',
            
        ]);
        
        $ValidatedData['password'] = Hash::make($ValidatedData['password']);
        Users::create($ValidatedData);
        return redirect()->route('login.index')->with('success', 'Sign in berhasil, silahkan login');
    }
}
