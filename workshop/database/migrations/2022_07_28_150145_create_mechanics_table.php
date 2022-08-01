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
        Schema::create('mechanics', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('surname', 50);
            $table->string('image_path', 200)->nullable();
            $table->unsignedBigInteger('workshop_id');
            $table->foreign('workshop_id')->references('id')->on('workshops');
            $table->decimal('rating', 10, 2);
            $table->integer('rate_count');
            $table->decimal('avrRating', 10, 2);
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
        Schema::dropIfExists('mechanics');
    }
};
