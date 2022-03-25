<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Chrome;
use Tests\DuskTestCase;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\Browser;

class ExampleTest extends TestCase
{
    /**
     * TODO: Как документировать и нужно ли документировать тестирование
     */

    public function test_the_application_returns_a_successful_response()
    {

        /*$user = User::factory()->create();
        dd($user);
        $response = $this->get('/');

        $response->assertStatus(200);*/
        $this->assertTrue(true);
        $response = $this->get('/');

//        $response->ddHeaders();

//        $response->ddSession();

//        $response->dd();
    }

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
     * Работает ли рендер страницы users
     * TODO: Сделать чтобы пользователь логинился, чтобы проходить проверку
     * @return void
     */
    public function test_a_users_view_can_be_rendered()
    {
//        $this->get('/login');
//        $this->browse(function ($browser) {
//            $browser->loginAs(User::find(6))->visit('/users');
//        });

        $users = User::paginate(9);

        $view = $this->view('users', ['users' => $users]);

        $view->assertSee('Список пользователей');
        $view->assertSee('Home');
        $view->assertSee('About');
        $view->assertSee('2022 © Учебный проект');
        $view->assertSee('Выйти');
    }

    /**
     * Создать пользователя в методе, отправить его на страницу users и проверить показывается ли он там
     * TODO: Создать пользователя с конкретными данными, и эти самые данные подтвердить
     * @return void
     */

    public function test_a_users_view_can_be_render_user_data()
    {
        $users = '';

        $view = $this->view('users', ['users' => $users]);

        $view->assertSee('Список пользователей');
    }

    /**
     * Рендер страницы users
     * Работает ли пагинация
     * TODO: Создать пользователей больше 9, чтобы появилась пагинация. Отправить на страницу users
     */


    /**
     * Рендер страницы users
     * Проверить работает ли кнопка "Добавить" нового пользователя, если данный пользователь админ,
     * если не админ то не показывается ли
     */

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
     * Переходит ли на страницу профиля, если нажата кнопка редактирования
     * Выводится ли флеш сообщение об успешном изменений если данные изменены, если нет, то сообщение не должно
     * выводиться
     *
     */

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
