<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('poster');
            $table->string('genre');
            $table->integer('duration'); // in minutes
            $table->string('rating_age')->nullable(); // SU, 13+, 17+, 21+
            $table->text('synopsis');
            $table->string('status')->default('now_playing'); // now_playing, coming_soon
            $table->foreignId('category_id')->constrained();
            $table->string('trailer_url')->nullable();
            $table->string('director')->nullable();
            $table->string('cast')->nullable();
            $table->date('release_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('films');
    }
};
