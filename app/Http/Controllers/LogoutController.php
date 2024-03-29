<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class LogoutController extends Controller
{

    public function __invoke(Request $request)
    {
        Auth::logout();

        return redirect(RouteServiceProvider::HOME);
    }
}
