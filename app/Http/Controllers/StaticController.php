<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class StaticController extends Controller
{
    /**
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Welcome', [
            'auth_url' => (Auth::check()) ? 'logout' : 'login'
        ]);
    }
}
