<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cinemas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->text('address');
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->json('facilities')->nullable(); // [parkir, foodcourt, etc]
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cinemas');
    }
};
