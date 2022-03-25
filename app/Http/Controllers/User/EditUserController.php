<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;
use App\Http\Controllers\Controller;
use App\Services\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use function redirect;

class EditUserController extends BaseController
{
    function updateAvatar(Request $request, $id)
    {
        $request->validate([
            'avatar' => 'file|image|required'
        ]);
        $user = $this->helper->getUserById($id);
        if (!empty($user->avatar)) {
            Storage::delete($user->avatar);
        }
        $filename = $request->avatar->store('uploads');
        $data = ['avatar' => $filename];
        $this->helper->updateInDB($data, $id);
        return redirect('/page_profile' . $user->id)->with('status', 'Профиль успешно обновлен');
    }

    function delete($id)
    {
        $this->helper->userAdminOrSelfprofile($id);
        $editUser = $this->helper->getUserById($id);
        $this->helper->deleteUser($editUser);
        $this->helper->logoutAndRedirectIfDeleteYourself($id);
        return redirect('/users')->with('status', 'Пользователь удален');
    }

    function editUserData($id)
    {
        $data = [
            'username' => $_POST['username'],
            'profession' => $_POST['profession'],
            'phone_number' => $_POST['phone_number'],
            'address' => $_POST['address']
        ];
        $this->helper->updateInDB($data, $id);

        return redirect('/page_profile' . $id)->with('status', 'Профиль успешно обновлен');
    }

    function editUserSecurity($id, Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', Rules\Password::defaults()],
        ]);
        $users = $this->helper->getAllUsers();
        $this->helper->redirectEmailAlreadyExists($users, 'security' . Auth::id());
        $data = [
            'email' => $request->email,
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ];
        $this->helper->updateInDB($data, $id);

        return redirect('/page_profile' . $id)->with('status', 'Профиль успешно обновлен');
    }

    public function editUserStatus($id)
    {
        $data = [
            'status_id' => $_POST['status']
        ];
        $this->helper->updateInDB($data, $id);
        return redirect('page_profile' . $id)->with('status-success', 'Профиль успешно обновлен');
    }
}
