<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_interviews', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('emp_id');
            $table->integer('temp_id');
            $table->string('url');
            $table->string('status');
            $table->string('hide');
            $table->integer('jobApp_id');
            $table->string('interview_type');
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
        Schema::dropIfExists('user_interviews');
    }
}
