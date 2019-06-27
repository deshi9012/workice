<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('name')->nullable();
            $table->string('password')->default('secret');
            $table->tinyInteger('banned')->default(0);
            $table->string('ban_reason')->nullable();
            $table->string('last_ip', 40)->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('slack_webhook_url')->nullable();
            $table->string('calendar_token', 60)->unique();
            $table->text('access_token')->nullable();
            $table->text('email_preferences')->nullable();
            $table->string('locale', 10)->default('en');
            $table->dateTime('unsubscribed_at')->nullable();
            $table->tinyInteger('google2fa_enable')->default(0);
            $table->text('google2fa_secret')->nullable();
            $table->tinyInteger('on_holiday')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
}
