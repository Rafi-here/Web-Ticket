<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('poster')->nullable();
            $table->string('category'); // Konser, Festival, Musik, dll
            $table->integer('duration')->nullable(); // dalam menit
            $table->date('event_date');
            $table->time('event_time');
            $table->string('venue'); // Nama tempat
            $table->string('city');
            $table->text('address')->nullable();
            $table->text('description');
            $table->string('status')->default('upcoming'); // upcoming, ongoing, ended, cancelled
            $table->json('artists')->nullable(); // daftar artis
            $table->string('age_rating')->nullable(); // SU, 13+, 17+, 21+
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
};