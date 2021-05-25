<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        $login = Auth::attempt($request->only(['email', 'password']));

        if (!$login) {
            return redirect()->back()->withErrors('Login e/ou senha incorreto(s)');
        }

        return redirect()->route('list_series');
    }
}
