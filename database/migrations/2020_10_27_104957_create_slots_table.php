<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slots', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->char('starttime', 10);
            $table->char('endtime', 10);
            $table->unsignedBigInteger('interview_id');
            $table->integer('maximumnumberofinterviewees');
            $table->integer('numberofintervieweesbooked');
            $table->boolean('is_housefull');
            $table->foreign('interview_id')->references('id')->on('interviews')
            ->onDelete('cascade');
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
        Schema::dropIfExists('slots');
    }
}
