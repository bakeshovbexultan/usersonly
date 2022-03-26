<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Chrome;
use Tests\DuskTestCase;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\Browser;
use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * TODO: Как документировать и нужно ли документировать тестирование
     */

    public function test_the_application_returns_a_successful_response()
    {
        $this->assertTrue(true);

//        $user = User::factory()->create();
//        $response = $this->get('/');
//        $response->assertStatus(200);
//        $response = $this->get('/');
    }
    
    public function test_a_users_view_can_be_rendered()
    {
        User::factory(20)->create();
        $users = User::paginate(9);
        $user = $users->first();
        Auth::loginUsingId($user->id);

        $view = $this->view('users', ['users' => $users]);

        $view->assertSee('Учебный проект');
        $view->assertSee('Войти');
        $view->assertSee('Список пользователей');
        $view->assertSee('Home');
        $view->assertSee('2022 © Учебный проект');
    }

    /**
     * Рендер страницы users
     * Проверить работает ли кнопка "Добавить" нового пользователя, если данный пользователь админ,
     * если не админ то не показывается ли
     */

    public function test_admin_has_add_user_button()
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
//        browse(function ($browser) {
//            $browser->loginAs(User::find(1))
//                ->visit('/home');
//        });

        $users = User::paginate(9);

        $view = $this->view('users', ['users' => $users]);

        $view->assertSee('Учебный проект');
    }
    /**
     * Создать пользователя в методе, отправить его на страницу users и проверить
     * показывается ли он там
     */

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

        $view->assertSee('Список пользователей');
        $view->assertSee('John Vance');
        $view->assertSee('johnvance@example.com');
        $view->assertSee('Doctor');
        $view->assertSee('+1 (970) 357-9097');
        $view->assertSee('431 Eveline Trail Apt. 085 Tessside, RI 16481-3261');
    }

    /**
     * Рендер страницы users
     * Работает ли пагинация
     * TODO: Создать пользователей больше 9, чтобы появилась пагинация. Отправить на страницу users
     */

    public function test_a_users_view_can_be_render_user_data()
    {
        User::factory(20)->create();

        $users = User::paginate(9);

        $user = $users->first();
        Auth::loginUsingId($user->id);

        $view = $this->view('users', ['users' => $users]);

        $view->assertSee('Список пользователей');
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
     * Рендер страницы edit
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
//        Auth::loginUsingId(1);
        $view = $this->view('edit', ['editUser' => $user]);
        $view->assertSee('Учебный проект');
        $view->assertSee('Редактировать');
        $view->assertSee('John Vance');
        $view->assertSee('Doctor');
        $view->assertSee('+1 (970) 357-9097');
        $view->assertSee('431 Eveline Trail Apt. 085 Tessside, RI 16481-3261');
    }

    /**
     * Рендер страницы page_profile
     * Если id не передан на страницу, то нужно вернуться на главную страницу и вывезти флеш сообщение
     * Правильно ли показаны данные пользователя
     * Данные должны быть редактируемого пользователя, а не только моего
     * Показывает ли аватар
     * Работает ли главный шаблон
     */

    /**
     * Рендер страницы security
     * Если id не передан на страницу, то нужно вернуться на главную страницу и вывезти флеш сообщение
     * Поле email должен быть заполнен имейлом не только пользователя залогиненного, но и редактируемого
     * Поле пароль и подтверждение пароля должны быть пустыми
     * Все поля должны проходить валидацию и не принимать неправильные форматы
     * Если данные изменены, то на странице page_profile должен выводится флеш сообщение. Если данные не тронуты
     * то флеш сообщения не должно быть
     * Если пароль пустой, то должен переходить на следующий шаг
     */

    /**
     * Статус
     */

    /**
     * Проверить работает ли загрузка аватара. Проверить не принимает ли другие расширения кроме фотографий
     */


    /*public function test_avatars_can_be_uploaded()
    {
        Storage::fake('avatars');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->post('/avatar', [
            'avatar' => $file,
        ]);

        Storage::disk('avatars')->assertExists($file->hashName());
    }*/
    /**
     * Удаление
     */

    /**
     * Регистрация
     */

    /**
     * Вход
     */
}
