<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CustomAuthController extends Controller
{
    public function dashboard()
    {
        if(Auth::check()){
            return view('admin.index');
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function index()
    {
        return view('login');
    }

    public function customLogin()
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

        if(auth()->user()->hasRole('visitor'))
        {
            return redirect('/');
        }else{
            if(session()->has('url'))
            {
                $value = session()->get('url');
                session()->forget('url');
                // dd($value);
               return redirect($value['intended']);
            }
            else
            {
            return redirect('/admin/index');
            }
        }

    }

    public function registration()
    {
        return view('register');
    }

    public function store()
    {

        $attributes = request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:5',
            'cpass' => 'required|same:password',
        ]);

        $user = User::create($attributes);
        $user->assignRole('visitor');
        auth()->login($user);
        return redirect('/');
    }

    public function signOut() {

        Auth::logout();
        return Redirect('/');
    }
}
