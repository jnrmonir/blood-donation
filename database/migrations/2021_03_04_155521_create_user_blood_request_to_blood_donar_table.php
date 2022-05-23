<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBloodRequestToBloodDonarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_blood_request_to_blood_donar', function (Blueprint $table) {
            $table->id();
            $table->integer('blood_request_id');
            $table->integer('blood_donar_id');
            $table->text('message')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('user_blood_request_to_blood_donar');
    }
}
