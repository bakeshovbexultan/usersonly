<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Redirector;
use Symfony\Component\Console\Input\Input;

class Helper {

    public function redirectIfNotAdmin() {
        if (!Auth::user()->role == 'admin') {
            return redirect('login');
        }
    }

    public function getAllUsers() {
        $users = DB::table('users')->select('*')->get();
        $users = $users->all();
        return $users;
    }

    public function redirectEmailAlreadyExists($users, $path) {
        foreach ($users as $user) {
            if ($user->email == $_POST['email']) {
                return redirect($path)->with('status', 'Пользователь с таким email уже существует');
            }
        }
    }

    public function getUserById($id) {
        return DB::table('users')->select('*')->where('id', $id)->first();
    }

    public function userAdminOrSelfprofile($id) {
        if (!(Auth::user()->role == 'admin')) {
            if (!(Auth::id() == $id)) {
                redirect('/users')->send()->with('status-danger', 'Можно редактировать только свой профиль');
            }
        }
    }

    public function logoutAndRedirectIfDeleteYourself($id) {
        if (Auth::id() == $id) {
            Auth::logout();
            return redirect('register');
        }
    }

    public function deleteUser($editUser) {
        if (!empty($editUser->avatar)) {
            Storage::delete($editUser->avatar);
        }
        DB::table('users')->where('id', $editUser->id)->delete();
    }

    public function updateInDB($data, $id) {
        DB::table('users')
            ->where('id', $id)
            ->update($data);
    }

    public function getAllStatuses() {
        $statuses = DB::table('statuses')->select('*')->get();
        return $statuses->all();
    }
}
