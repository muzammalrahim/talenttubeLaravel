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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('surname');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->integer('country');
            $table->integer('state');
            $table->integer('city');
            $table->integer('age');
            $table->integer('bday');
            $table->integer('bmonth');
            $table->integer('byear');
            $table->string('statusText');

            $table->string('company');
            $table->string('industry_experience');
            $table->string('recentJob');
            $table->string('qualification');
            $table->string('qualificationType');
            $table->string('salaryRange');

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
