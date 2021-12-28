<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('auth.registration', [
            'treeMenu' => 'auth',
            'subMenu' => 'Registrasi',
            'users' => User::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'unique:users', 'alpha_num', 'min:3', 'max:25'],
            'password' => ['required', 'min:4'],
            'role' => ['required', 'numeric'],
            'name' => ['required'],
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => 'generalaffair@kdr.co.id',
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
        return redirect('/users')->with('success', 'User Berhasil Ditambahkan');
    }
}
