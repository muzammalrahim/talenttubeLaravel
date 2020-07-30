<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_data', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('experience');
            $table->string('type');
            $table->integer('country');
            $table->integer('state');
            $table->integer('city');
            $table->integer('vacancies');
            $table->text('salary');
            $table->text('gender');
            $table->text('age');
            $table->text('questions');
            $table->dateTime('expiration');
            $table->string('code');
            $table->timestamps();
            $table->unsignedbigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs_data');
    }
}
