<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use function redirect;

class UserController extends BaseController
{
    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
