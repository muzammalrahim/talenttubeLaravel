<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOnlineTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_online_tests', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id');
            $table->integer('emp_id');
            $table->integer('jobApp_id');
            $table->integer('test_id');
            $table->string('status');
            $table->integer('current_qid');
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
        Schema::dropIfExists('user_online_tests');
    }
}
