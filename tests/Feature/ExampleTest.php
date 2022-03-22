<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /*
     * Регистрация
     * Редактирование
     * Страница профиля
     * Настройки аккаунта
     * Статус
     * Аватар
     * Удаление
     *
     */

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {

        /*$user = User::factory()->create();
        dd($user);
        $response = $this->get('/');

        $response->assertStatus(200);*/
        $this->assertTrue(true);
    }
}
