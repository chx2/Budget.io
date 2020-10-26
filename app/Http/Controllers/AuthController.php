<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AuthController extends Controller
{
    /**
     * Login page, redirect if logged in
     *
     * @return \Illuminate\Http\RedirectResponse|\Inertia\Response
     */
    public function index()
    {
        if (Auth::check()) {
            return Redirect::route('budgets.index');
        }
        else {
            return Inertia::render('Auth/Login', [
                'auth_url' => 'login'
            ]);
        }
    }

    /**
     * Attempt to login a user
     *
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'max:50', 'email'],
            'password' => ['required', 'max:50'],
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return Redirect::route('budgets.index');
        }
        else {
            return Inertia::render('Auth/Login', [
                'auth_url' => 'login',
                'error'    => 'Incorrect username or password'
            ]);
        }
    }

    /**
     * Logout user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return Redirect::route('login');
    }
}
