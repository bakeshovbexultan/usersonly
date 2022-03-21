<?php

namespace App\Http\Controllers;

use App\Services\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CreateUserController extends Controller
{
    private $helper;

    public function __construct() {
        $this->helper = new Helper;
    }

    function create_user() {
        $this->helper->redirectIfNotAdmin();
        $statuses = $this->helper->getAllStatuses();
        return view('create_user', ['statuses' => $statuses]);
    }

    function storeUser(Request $request) {
        $users = $this->helper->getAllUsers();
        $this->helper->redirectEmailAlreadyExists($users, 'create_user');

        $image = $request->file('avatar');
        $filename = $image->store('uploads');

        DB::table('users')->insert([
            'email' => $_POST['email'],
            'username' => $_POST['username'],
            'profession' => $_POST['profession'],
            'phone_number' => $_POST['phone_number'],
            'address' => $_POST['address'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'status_id' => $_POST['status_id'],
            'vkontakte' => $_POST['vkontakte'],
            'telegram' => $_POST['telegram'],
            'instagram' => $_POST['instagram'],
            'avatar' => $filename
        ]);

        return redirect('/users')->with('status', 'Ползователь добавлен');
    }
}
