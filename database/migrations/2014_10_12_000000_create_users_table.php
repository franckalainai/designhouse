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
            $table->string('name')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('tagline')->nullable();
            $table->text('about')->nullable();
            $table->point('location')->nullable();
            $table->string('formatted_address')->nullable();
            $table->boolean('available_to_hire')->default(false);
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at');
            $table->string('password')->nullable();
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
