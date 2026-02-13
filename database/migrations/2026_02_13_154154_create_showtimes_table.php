<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('showtimes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_id')->constrained()->onDelete('cascade');
            $table->foreignId('cinema_id')->constrained()->onDelete('cascade');
            $table->date('show_date');
            $table->time('show_time');
            $table->decimal('price', 10, 2);
            $table->integer('available_seats')->default(50);
            $table->json('seat_layout')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('showtimes');
    }
};
