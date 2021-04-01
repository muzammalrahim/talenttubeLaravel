<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FbRemAcc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_rem_acc', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedbigInteger('user_id');
            $table->string('user_name');
            $table->string('user_email');
            $table->string('reason');
            $table->string('statusText')->nullable();
            $table->string('company')->nullable();
            $table->string('recentJob')->nullable();
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
        Schema::dropIfExists('fb_rem_acc');

    }
}
