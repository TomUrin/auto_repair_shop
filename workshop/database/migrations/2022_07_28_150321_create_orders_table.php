<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workshop_id');
            $table->foreign('workshop_id')->references('id')->on('workshops');
            $table->unsignedBigInteger('mechanic_id');
            $table->foreign('mechanic_id')->references('id')->on('mechanics');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('date', 12);
            $table->string('time', 10);
            $table->unsignedTinyInteger('status')->default(1);
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
        Schema::dropIfExists('orders');
    }
};
