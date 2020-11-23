<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_id');
            $table->string('title');
            $table->string('companyname');
            $table->string('positionname');
            $table->string('uniquedigits');
            $table->string('url');
            // $table->string('employeremail');
            // $table->string('employerpassword');
            $table->text('instruction');
            $table->string('additionalmanagers')->nullable();
            // $table->integer('numberofslots')->nullable();
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
        Schema::dropIfExists('interviews');
    }
}
