<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            if (!Schema::hasColumn('tickets', 'booking_code')) {
                $table->string('booking_code')->unique()->after('id');
            }
            if (!Schema::hasColumn('tickets', 'expired_at')) {
                $table->timestamp('expired_at')->nullable()->after('qr_code');
            }
            if (!Schema::hasColumn('tickets', 'paid_at')) {
                $table->timestamp('paid_at')->nullable()->after('expired_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            //
        });
    }
};
