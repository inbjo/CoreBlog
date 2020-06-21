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
            $table->id();
            $table->string('name')->unique()->index();
            $table->string('email')->unique()->index();
            $table->string('mobile')->unique()->nullable()->index();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('avatar')->nullable();
            $table->string('bio')->nullable();
            $table->integer('notification_count')->unsigned()->default(0);
            $table->text('extend')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
