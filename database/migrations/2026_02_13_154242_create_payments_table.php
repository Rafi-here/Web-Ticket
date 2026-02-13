<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained()->onDelete('cascade');
            $table->string('payment_code')->unique();
            $table->string('method'); // ewallet, virtual_account, qris, transfer_bank
            $table->string('provider')->nullable(); // gopay, ovo, dana, bca, mandiri
            $table->decimal('amount', 10, 2);
            $table->string('status')->default('pending'); // pending, success, failed, expired
            $table->json('payment_details')->nullable();
            $table->json('payment_proof')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expired_at');
            $table->timestamps();

            $table->index(['ticket_id', 'status']);
            $table->index('payment_code');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
