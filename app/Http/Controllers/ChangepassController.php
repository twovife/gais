<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ChangepassController extends Controller
{
    public function show(Request $request)
    {
        return view('chpass.chpass', [
            'treeMenu' => 'chpass',
            'subMenu' => 'Change Password'
        ]);
    }

    public function update(Request $request, User $chpass)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->current_password])) {
            $chpass->update(['password' => Hash::make($request->password)]);
            return back()->with('success', 'Password Anda Telah diubah !');
        }

        throw ValidationException::withMessages([
            'current_password' => 'Password yang anda masukkan salah',
        ]);
    }
}
