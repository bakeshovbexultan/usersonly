<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
