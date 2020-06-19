<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_answers', function (Blueprint $table) {
            $table->id();

            $table->unsignedbigInteger('question_id');
            $table->foreign('question_id')->references('id')->on('jobs_questions')->onDelete('cascade');

            $table->unsignedbigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedbigInteger('application_id');
            $table->foreign('application_id')->references('id')->on('jobs_applications')->onDelete('cascade');

            $table->string('answer');

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
        Schema::dropIfExists('jobs_answers');
    }
}
