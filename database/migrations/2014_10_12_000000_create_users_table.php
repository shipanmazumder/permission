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
            $table->bigIncrements('id');
            $table->smallInteger('role_id');
            $table->string('name');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('email')->unique();
            $table->boolean('status')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->index('role_id');
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
