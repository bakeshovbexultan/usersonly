<?php

namespace App\Http\Controllers;

use App\Services\Helper;
use App\Models\User;

class PageController extends Controller
{
    private $helper;

    public function __construct() {
        $this->helper = new Helper;
    }

    public function index() {
        $users = User::paginate(9);

        return view('users', ['users' => $users]);
    }

    public function edit($id) {
        $this->helper->userAdminOrSelfprofile($id);

        $editUser = $this->helper->getUserById($id);
        return view('edit', ['editUser' => $editUser]);
    }

    public function page_profile($id) {
        $user = $this->helper->getUserById($id);
        return view('page_profile', ['user' => $user]);
    }

    function media($id) {
        $this->helper->userAdminOrSelfprofile($id);

        $user = $this->helper->getUserById($id);
        return view('media', ['user' => $user]);
    }

    function status($id) {
        $this->helper->userAdminOrSelfprofile($id);

        $statuses = $this->helper->getAllStatuses();
        $user = $this->helper->getUserById($id);
        return view('status', ['statuses' => $statuses, 'user' => $user]);
    }

    function security($id) {
        $this->helper->userAdminOrSelfprofile($id);

        $editUser = $this->helper->getUserById($id);
        return view('security', ['editUser' => $editUser]);
    }
}
