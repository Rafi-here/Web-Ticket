<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ticket_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->string('name'); // VIP, CAT 1, FESTIVAL, EARLY BIRD, dll
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('quantity'); // total tiket tersedia
            $table->integer('available')->nullable(); // sisa tiket
            $table->integer('max_per_order')->default(5); // maksimal pembelian per order
            $table->json('benefits')->nullable(); // keuntungan untuk kategori ini
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ticket_categories');
    }
};
