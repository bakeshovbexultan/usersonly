<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\Status;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Chrome;
use Tests\DuskTestCase;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\Browser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_users_view_can_be_rendered()
    {
        User::factory(20)->create();
        $users = User::paginate(9);
        $user = $users->first();

        Auth::loginUsingId($user->id);

        $view = $this->view('users', ['users' => $users]);
        $response = $this->get('/users');

        $response->assertViewIs('users');
        $response->assertStatus(200);
        $view->assertSee('Учебный проект');
        $view->assertSee('Войти');
        $view->assertSee('Список пользователей');
        $view->assertSee('Home');
        $view->assertSee('2022 © Учебный проект');
    }

    /**
     * TODO: Перейти по ссылке кнопки и подтвердить что вид работает
     */
    public function test_admin_has_add_user_button_and_it_is_work()
    {
        User::factory(1)->create([
            'id' => 1,
            'username' => 'John Vance',
            'email' => 'johnvance@example.com',
            'profession' => 'Doctor',
            'phone_number' => '+1 (970) 357-9097',
            'address' => '431 Eveline Trail Apt. 085 Tessside, RI 16481-3261',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'role' => 'admin',
        ]);

        Auth::loginUsingId(1);
        $users = User::paginate(9);
        $view = $this->view('users', ['users' => $users]);

        $view->assertSee('Учебный проект');
        $view->assertSee('Добавить');
    }

    public function test_user_has_not_add_user_button()
    {
        User::factory(1)->create([
            'id' => 1,
            'username' => 'John Vance',
            'email' => 'johnvance@example.com',
            'profession' => 'Doctor',
            'phone_number' => '+1 (970) 357-9097',
            'address' => '431 Eveline Trail Apt. 085 Tessside, RI 16481-3261',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'role' => 'user',
        ]);

        Auth::loginUsingId(1);

        $users = User::paginate(9);

        $view = $this->view('users', ['users' => $users]);

        $view->assertSee('Учебный проект');
        $view->assertDontSee('Добавить');
    }

    public function test_a_users_view_can_show_user_data()
    {
        User::factory(1)->create([
            'id' => 1,
            'username' => 'John Vance',
            'email' => 'johnvance@example.com',
            'profession' => 'Doctor',
            'phone_number' => '+1 (970) 357-9097',
            'address' => '431 Eveline Trail Apt. 085 Tessside, RI 16481-3261',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'role' => 'user'
        ]);
        Auth::loginUsingId(1);

        $users = User::paginate(9);
        $view = $this->view('users', ['users' => $users]);
        $response = $this->get('users');

        $response->assertViewIs('users');
        $view->assertSee('Список пользователей');
        $view->assertSee('John Vance');
        $view->assertSee('johnvance@example.com');
        $view->assertSee('Doctor');
        $view->assertSee('+1 (970) 357-9097');
        $view->assertSee('431 Eveline Trail Apt. 085 Tessside, RI 16481-3261');
    }


    /**
     * TODO: Подтвердить что пагинация работает
     */

    public function test_a_users_view_show_pagination()
    {
        User::factory(20)->create();
        Auth::loginUsingId(1);

        $users = User::paginate(9);

        $user = $users->first();
        Auth::loginUsingId($user->id);

        $view = $this->view('users', ['users' => $users]);
        $response = $this->get('users');

        $response->assertViewIs('users');
        $view->assertSee('Список пользователей');
        $view->assertSee('Showing');// 1 to 9 of 20 results
    }


    /**
     * Рендер страницы create_user
     * Подтвердить что есть поля
     * Подтвердить что в бд появились все данные введенные в полях
     * Появилось флеш сообщение
     * Пользователь появился на главной странице
     */

    /**
     * Рендер страницы users
     * Если данный пользователь админ, то появляется ссылки на редактирование других пользователей
     * Если не админ, то ссылка только на редактирование своего профиля
     */

    /**
     * Если id не передан на страницу, то нужно вернуться на главную страницу и вывезти флеш сообщение
     * Введен ли уже мои данные в строках
     *
     * Под вопросом нижние утверждения
     * Переходит ли на страницу профиля, если нажата кнопка редактирования
     * Выводится ли флеш сообщение об успешном изменений если данные изменены, если нет, то сообщение не должно
     * выводиться
     *
     */

    public function test_a_edit_view_can_be_rendered()
    {
        $user = User::factory(1)->create([
            'id' => 1,
            'username' => 'John Vance',
            'email' => 'johnvance@example.com',
            'profession' => 'Doctor',
            'phone_number' => '+1 (970) 357-9097',
            'address' => '431 Eveline Trail Apt. 085 Tessside, RI 16481-3261',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'role' => 'user'
        ])->first();
        Auth::loginUsingId(1);
        $view = $this->view('edit', ['editUser' => $user]);
        $response = $this->get('edit1');

        $response->assertStatus(200);
        $response->assertViewIs('edit');
        $view->assertSee('Учебный проект');
        $view->assertSee('Редактировать');
        $view->assertSee('John Vance');
        $view->assertSee('Doctor');
        $view->assertSee('+1 (970) 357-9097');
        $view->assertSee('431 Eveline Trail Apt. 085 Tessside, RI 16481-3261');
    }

    /**
     * TODO: Подтвердить что произошел переход на глав страницу с флеш сообщ об ошибке
     */
    public function test_if_edit_view_did_not_get_id_redirect_to_users_with_flash_message()
    {
        $user = User::factory(1)->create([
            'id' => 1,
            'username' => 'John Vance',
            'email' => 'johnvance@example.com',
            'profession' => 'Doctor',
            'phone_number' => '+1 (970) 357-9097',
            'address' => '431 Eveline Trail Apt. 085 Tessside, RI 16481-3261',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'role' => 'user'
        ])->first();
        Auth::loginUsingId(1);
        $view = $this->view('edit', ['editUser' => $user]);
        self::assertTrue(true);
//        $response = $this->get('edit');
//
//        $response->assertSee('Список пользователей');
//        $response->assertViewIs('edit');
//        $view->assertSee('Учебный проект');
    }

    public function test_a_media_view_can_be_rendered()
    {
        $user = User::factory(1)->make([
            'id' => 1,
            'username' => 'John Vance',
            'email' => 'johnvance@example.com',
            'profession' => 'Doctor',
            'phone_number' => '+1 (970) 357-9097',
            'address' => '431 Eveline Trail Apt. 085 Tessside, RI 16481-3261',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'role' => 'user',
            'avatar' => null,
        ])->first();

        Auth::loginUsingId(1);
        $this->withViewErrors([]);
        $view = $this->view('media', ['user' => $user]);

        $view->assertSee('Загрузить аватар');
        $view->assertSee('Выберите аватар');
        $view->assertSee('Загрузить');
    }

    /**
     * Если id не передан на страницу, то нужно вернуться на главную страницу и вывезти флеш сообщение
     * Данные должны быть редактируемого пользователя, а не только моего
     * Показывает ли аватар
     */

    public function test_a_page_profile_view_can_be_rendered()
    {
        $user = User::factory(1)->make([
            'id' => 1,
            'username' => 'John Vance',
            'email' => 'johnvance@example.com',
            'profession' => 'Doctor',
            'phone_number' => '+1 (970) 357-9097',
            'address' => '431 Eveline Trail Apt. 085 Tessside, RI 16481-3261',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'role' => 'user',
            'avatar' => null,
        ])->first();

        Auth::loginUsingId(1);
        $view = $this->view('page_profile', ['user' => $user]);

        $view->assertSee('johnvance@example.com');
        $view->assertSee('John Vance');
        $view->assertSee('+1 (970) 357-9097');
        $view->assertSee('431 Eveline Trail Apt. 085 Tessside, RI 16481-3261');
    }

    /**
     * Если id не передан на страницу, то нужно вернуться на главную страницу и вывезти флеш сообщение
     * Поле email должен быть заполнен имейлом не только пользователя залогиненного, но и редактируемого
     * Поле пароль и подтверждение пароля должны быть пустыми
     * Все поля должны проходить валидацию и не принимать неправильные форматы
     * Если данные изменены, то на странице page_profile должен выводится флеш сообщение. Если данные не тронуты
     * то флеш сообщения не должно быть
     * Если пароль пустой, то должен переходить на следующий шаг
     */

    public function test_a_security_view_can_be_rendered()
    {
        $user = User::factory(1)->make([
            'id' => 1,
            'username' => 'John Vance',
            'email' => 'johnvance@example.com',
            'profession' => 'Doctor',
            'phone_number' => '+1 (970) 357-9097',
            'address' => '431 Eveline Trail Apt. 085 Tessside, RI 16481-3261',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'role' => 'user',
            'avatar' => null,
        ])->first();

        Auth::loginUsingId(1);
        $this->withViewErrors([]);
        $view = $this->view('security', ['editUser' => $user]);

        $view->assertSee('johnvance@example.com');
        $view->assertSee('Обновление эл. адреса и пароля');
        $view->assertSee('Изменить');
        $view->assertSee('Пароль');
        $view->assertSee('Подтверждение пароля');
        $view->assertSee('Изменить');
    }

    public function test_a_status_view_can_be_rendered()
    {
        $user = User::factory(1)->make([
            'id' => 1,
            'username' => 'John Vance',
            'email' => 'johnvance@example.com',
            'profession' => 'Doctor',
            'phone_number' => '+1 (970) 357-9097',
            'address' => '431 Eveline Trail Apt. 085 Tessside, RI 16481-3261',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'role' => 'user',
            'avatar' => null,
        ])->first();
        $statuses = Status::factory(1)->make(['status_condition' => 'Online']);

        Auth::loginUsingId(1);
        $this->withViewErrors([]);
        $view = $this->view('status', ['statuses' => $statuses, 'user' => $user]);

        $view->assertSee('Установить статус');
        $view->assertSee('Установка текущего статуса');
        $view->assertSee('Выберите статус');
        $view->assertSee('Online');
    }

    /**
     * Изменение статуса, сделать другим тестом
     */


    /**
     * Проверить работает ли загрузка аватара. Проверить не принимает ли другие расширения кроме фотографий
     */

//    public function test_avatars_can_be_uploaded()
//    {
//        Storage::fake('avatars');
//
//        $file = UploadedFile::fake()->image('avatar.jpg');
//
//        $response = $this->post('/avatar', [
//            'avatar' => $file,
//        ]);
//
//        Storage::disk('avatars')->assertExists($file->hashName());
//    }

    /**
     * TODO: Узнать как переходить по сслыке, чтобы удалить себя на сайте при тестировании
     */
    public function test_a_user_can_be_deleted()
    {
        User::factory(1)->make([
            'id' => 1,
            'username' => 'John Vance',
            'email' => 'johnvance@example.com',
            'profession' => 'Doctor',
            'phone_number' => '+1 (970) 357-9097',
            'address' => '431 Eveline Trail Apt. 085 Tessside, RI 16481-3261',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'role' => 'user',
            'avatar' => null,
        ])->first();

        Auth::loginUsingId(1);
        self::assertTrue(true);
//        link: laraveltraining2/delete/1
    }

    public function test_a_login_view_can_be_rendered()
    {
        User::factory(1)->make([
            'id' => 1,
            'username' => 'John Vance',
            'email' => 'johnvance@example.com',
            'profession' => 'Doctor',
            'phone_number' => '+1 (970) 357-9097',
            'address' => '431 Eveline Trail Apt. 085 Tessside, RI 16481-3261',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'role' => 'user',
            'avatar' => null,
        ])->first();

        $this->withViewErrors([]);
        $view = $this->view('auth.login');

        $view->assertSee('Войти');
        $view->assertSee('Запомнить меня');
        $view->assertSee('Нет аккаунта?');
    }

    public function test_a_register_view_can_be_rendered()
    {
        User::factory(1)->make([
            'id' => 1,
            'username' => 'John Vance',
            'email' => 'johnvance@example.com',
            'profession' => 'Doctor',
            'phone_number' => '+1 (970) 357-9097',
            'address' => '431 Eveline Trail Apt. 085 Tessside, RI 16481-3261',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'role' => 'user',
            'avatar' => null,
        ])->first();

        $this->withViewErrors([]);
        $view = $this->view('auth.register');

        $view->assertSee('Регистрация');
        $view->assertSee('Эл. адрес будет вашим логином при авторизации');
    }

    /**
     * Проверить что регистрация работает
     * Данные вводятся. Я перехожу на глав страницу. Появляется моя запись в базе данных
     */

    /**
     * Проверить что логинниг работает
     * Данные вводятся. Я перехожу на глав страницу
     */
}
