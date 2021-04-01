<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOnlineTestAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_online_test_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('emp_id');
            $table->integer('userTest_id');
            $table->integer('question_id');
            $table->integer('users_answer');
            $table->string('status');

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
        Schema::dropIfExists('user_online_test_answers');
    }
}
