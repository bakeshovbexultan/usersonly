<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;
use App\Http\Controllers\Controller;
use App\Services\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use function redirect;
use function view;

class CreateUserController extends BaseController
{
    function create_user() {
        $this->helper->redirectIfNotAdmin();
        $statuses = $this->helper->getAllStatuses();
        return view('create_user', ['statuses' => $statuses]);
    }

    function storeUser(Request $request) {
        $request->validate([
            'username' => 'string|required',
            'email' => 'required|email',
            'password' => ['required', Rules\Password::defaults()],
            'avatar' => 'file|image',
            'profession' => '',
            'phone_number' => '',
            'address' => '',
            'status_id' => '',
        ]);
        $users = $this->helper->getAllUsers();
        $this->helper->redirectEmailAlreadyExists($users, 'create_user');

        $image = $request->file('avatar');
        if (!empty($image)) {
            $filename = $image->store('uploads');
        } else {
            $filename = NULL;
        }

        DB::table('users')->insert([
            'email' => $request->email,
            'username' => $request->username,
            'profession' => $request->profession,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'status_id' => $request->status_id,
            'vkontakte' => $request->vkontakte,
            'telegram' => $request->telegram,
            'instagram' => $request->instagram,
            'avatar' => $filename
        ]);

        return redirect('/users')->with('status', 'Ползователь добавлен');
    }
}
