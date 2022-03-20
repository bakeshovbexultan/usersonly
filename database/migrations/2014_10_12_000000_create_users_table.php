<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('user');
            $table->rememberToken();
            $table->timestamps();
            $table->integer('status_id')->nullable()->default(1);
            $table->string('profession', 255)->nullable();
            $table->string('phone_number', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('avatar', 255)->nullable();
            $table->string('telegram', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('vkontakte', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
