<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function store()
    {
        $data = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(! auth()->attempt($data))
        {
            throw ValidationException::withMessages([
                'email' => 'email not be verified',
                'password' => 'password not be verified',
            ]);
        }

        session()->regenerate();
        return redirect('/admin/index');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/');
    }
}
