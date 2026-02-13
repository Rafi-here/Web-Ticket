<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_code')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('showtime_id')->constrained()->onDelete('cascade');
            $table->json('seats');
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            $table->string('payment_method')->nullable();
            $table->string('status')->default('pending'); // pending, paid, expired, used
            $table->string('qr_code')->nullable();
            $table->timestamp('expired_at');
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('used_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index('ticket_code');
            $table->index('expired_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
